<?php
header('Content-Type: application/json');
require_once('../Session/session.php');

if (session_status() !== PHP_SESSION_NONE) {
    session_destroy();
    
    // Clear session cookie
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }
    
    echo json_encode(['status' => 'success', 'message' => 'Logged out successfully']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'No active session']);
}
exit;
?>