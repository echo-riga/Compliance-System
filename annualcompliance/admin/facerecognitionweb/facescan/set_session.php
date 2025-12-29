<?php
// set_session.php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Set all session variables from face recognition login
    $_SESSION['users_id'] = $_POST['users_id'] ?? '';
    $_SESSION['type'] = $_POST['type'] ?? '';
    $_SESSION['email'] = $_POST['email'] ?? '';
    $_SESSION['fullname'] = $_POST['fullname'] ?? '';
    $_SESSION['employeeid'] = $_POST['employeeid'] ?? '';
    $_SESSION['firstname'] = $_POST['firstname'] ?? '';
    $_SESSION['lastname'] = $_POST['lastname'] ?? '';
    
    // Verify session was set
    if (isset($_SESSION['users_id']) && !empty($_SESSION['users_id'])) {
        // ✅ FIXED PATH: Redirect to dashboard
        header('Location: ../../dashboard.php');
        exit;
    } else {
        // Session setup failed
        header('Location: ../index.php?error=session_failed');
        exit;
    }
} else {
    // Invalid access
    header('Location: ../index.php');
    exit;
}
?>