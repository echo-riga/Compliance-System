<?php
session_start();

// Set JSON header immediately
header('Content-Type: application/json');

class ProfileController {
    private $apiUrl = "http://localhost:5000/api/register";
    private $pdo;

    public function __construct() {
        $this->initializeDatabase();
    }

    private function initializeDatabase() {
        try {
            include '../config/config.php';
            $connection = new Connection();
            $this->pdo = $connection->conn();
            
            if (!$this->pdo) {
                throw new Exception("Database connection failed");
            }
        } catch (Exception $e) {
            error_log("Database initialization error: " . $e->getMessage());
            $this->pdo = null;
        }
    }

    public function handleRegistration() {
        try {
            // Check if it's a POST request
            if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
                echo json_encode(['success' => false, 'message' => 'Invalid request method']);
                exit();
            }

            // Check database connection
            if (!$this->pdo) {
                echo json_encode(['success' => false, 'message' => 'Database connection failed']);
                exit();
            }

            // Get POST data
            $users_id = $_SESSION['users_id'] ?? 0;
            $firstname = $_POST['firstname'] ?? '';
            $lastname = $_POST['lastname'] ?? '';
            $middlename = $_POST['middlename'] ?? '';
            $address = $_POST['address'] ?? '';
            $email = $_POST['email'] ?? '';
            $contact = $_POST['contact'] ?? '';
            $password = !empty($_POST['password']) ? password_hash($_POST['password'], PASSWORD_DEFAULT) : '';
            $questionnaire = $_POST['questionnaire'] ?? '';
            $answer = $_POST['answer'] ?? '';

            // Validate required fields
            if (empty($firstname) || empty($lastname) || empty($email)) {
                echo json_encode(['success' => false, 'message' => 'Firstname, lastname, and email are required']);
                exit();
            }

            // Get face frames
            $frames = [];
            if (!empty($_POST['face_frames'])) {
                $frames = json_decode($_POST['face_frames'], true);
            }

            if (empty($frames)) {
                echo json_encode(['success' => false, 'message' => 'No face frames captured']);
                exit();
            }

            // Handle file upload
            $img = '';
            if (isset($_FILES['img']) && $_FILES['img']['error'] === UPLOAD_ERR_OK) {
                $img = $this->handleImageUpload($_FILES['img'], "../images/");
            }

            $fullname = $firstname . " " . $lastname;

            // Prepare user data
            $user_data = [
                'users_id' => $users_id,
                'img' => $img,
                'employeeid' => '',
                'fullname' => $fullname,
                'firstname' => $firstname,
                'lastname' => $lastname,
                'middlename' => $middlename,
                'birthdate' => '2000-01-01',
                'address' => $address,
                'contact' => $contact,
                'email' => $email,
                'password' => $password,
                'passwordtxt' => $_POST['password'] ?? '',
                'type' => $_SESSION['type'] ?? 1,
                'status' => 1,
                'code' => '',
                'passphrase' => '',
                'attempt' => 0,
                'questionnaire' => $questionnaire,
                'answer' => $answer,
                'status_of_employment' => ''
            ];

            // Call Python API
            $api_response = $this->callFaceRecognitionAPI($frames, $user_data);

            if ($api_response['success']) {
                // Update database
                $db_success = $this->updateLocalDatabase($user_data, $img);
                
                if ($db_success) {
                    echo json_encode([
                        'success' => true,
                        'message' => 'Profile updated successfully with face recognition!',
                        'action' => $api_response['action'] ?? 'updated'
                    ]);
                } else {
                    echo json_encode([
                        'success' => false,
                        'message' => 'Face registered but database update failed'
                    ]);
                }
            } else {
                // Handle API errors
                if (isset($api_response['http_code']) && $api_response['http_code'] == 409) {
                    echo json_encode([
                        'success' => false,
                        'duplicate_face' => true,
                        'message' => $api_response['message'] ?? 'Face already registered',
                        'similarity' => $api_response['similarity'] ?? 0.85
                    ]);
                } else {
                    echo json_encode([
                        'success' => false,
                        'message' => $api_response['message'] ?? 'Face recognition failed'
                    ]);
                }
            }

        } catch (Exception $e) {
            echo json_encode([
                'success' => false,
                'message' => 'System error: ' . $e->getMessage()
            ]);
        }
        exit();
    }

    private function callFaceRecognitionAPI($frames, $user_data) {
        $payload = [
            'frames' => $frames,
            'user_data' => $user_data
        ];

        $ch = curl_init();
        curl_setopt_array($ch, [
            CURLOPT_URL => $this->apiUrl,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => json_encode($payload),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTPHEADER => [
                'Content-Type: application/json'
            ]
        ]);

        $response = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($response === false) {
            return ['success' => false, 'message' => 'API connection failed'];
        }

        $data = json_decode($response, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            return ['success' => false, 'message' => 'Invalid API response format'];
        }

        $data['http_code'] = $http_code;
        return $data;
    }

    private function updateLocalDatabase($user_data, $img) {
        try {
            if (!$this->pdo) {
                return false;
            }

            $fullname = $user_data['firstname'] . " " . $user_data['lastname'];
            
            // Build the query based on what data we have
            if (empty($img) && empty($user_data['password'])) {
                $sql = "UPDATE users SET fullname=?, firstname=?, lastname=?, middlename=?, address=?, contact=?, email=?, questionnaire=?, answer=? WHERE users_id=?";
                $params = [
                    $fullname, $user_data['firstname'], $user_data['lastname'], $user_data['middlename'],
                    $user_data['address'], $user_data['contact'], $user_data['email'],
                    $user_data['questionnaire'], $user_data['answer'], $user_data['users_id']
                ];
            } else if (!empty($img) && empty($user_data['password'])) {
                $sql = "UPDATE users SET img=?, fullname=?, firstname=?, lastname=?, middlename=?, address=?, contact=?, email=?, questionnaire=?, answer=? WHERE users_id=?";
                $params = [
                    $img, $fullname, $user_data['firstname'], $user_data['lastname'], $user_data['middlename'],
                    $user_data['address'], $user_data['contact'], $user_data['email'],
                    $user_data['questionnaire'], $user_data['answer'], $user_data['users_id']
                ];
            } else if (empty($img) && !empty($user_data['password'])) {
                $sql = "UPDATE users SET fullname=?, firstname=?, lastname=?, middlename=?, address=?, contact=?, email=?, password=?, passwordtxt=?, questionnaire=?, answer=? WHERE users_id=?";
                $params = [
                    $fullname, $user_data['firstname'], $user_data['lastname'], $user_data['middlename'],
                    $user_data['address'], $user_data['contact'], $user_data['email'], $user_data['password'],
                    $user_data['passwordtxt'], $user_data['questionnaire'], $user_data['answer'], $user_data['users_id']
                ];
            } else {
                $sql = "UPDATE users SET img=?, fullname=?, firstname=?, lastname=?, middlename=?, address=?, contact=?, email=?, password=?, passwordtxt=?, questionnaire=?, answer=? WHERE users_id=?";
                $params = [
                    $img, $fullname, $user_data['firstname'], $user_data['lastname'], $user_data['middlename'],
                    $user_data['address'], $user_data['contact'], $user_data['email'], $user_data['password'],
                    $user_data['passwordtxt'], $user_data['questionnaire'], $user_data['answer'], $user_data['users_id']
                ];
            }

            $stmt = $this->pdo->prepare($sql);
            $result = $stmt->execute($params);
            
            return $result;

        } catch (Exception $e) {
            error_log("Database update error: " . $e->getMessage());
            return false;
        }
    }

    private function handleImageUpload($file, $upload_dir) {
        try {
            // Create directory if it doesn't exist
            if (!is_dir($upload_dir)) {
                mkdir($upload_dir, 0755, true);
            }

            $filename = uniqid() . '_' . basename($file['name']);
            $target_path = $upload_dir . $filename;
            
            if (move_uploaded_file($file['tmp_name'], $target_path)) {
                return $filename;
            }
        } catch (Exception $e) {
            error_log("Upload error: " . $e->getMessage());
        }
        return '';
    }
}

// Instantiate and run
$controller = new ProfileController();
$controller->handleRegistration();
?>