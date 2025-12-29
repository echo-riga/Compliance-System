<?php
include 'includes/dbcon.php';

$response = array();  

$sql = "SELECT fullname FROM users";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $fullname = array();
    while ($row = $result->fetch_assoc()) {
        $fullname[] = $row["fullname"];
    }

    $response['status'] = 'success';
    $response['data'] = $fullname;

} else {
    $response['status'] = 'error';
    $response['message'] = 'No records found';
}

header('Content-Type: application/json');
echo json_encode($response);
?>
