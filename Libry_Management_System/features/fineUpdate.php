<?php
require_once('../config/db.php');
require_once('../Session/session.php');
require_login();

header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fine_id = trim($_POST['fine_id'] ?? '');
    $fine_amount = trim($_POST['fine_amount'] ?? '');
    
    // Server-side validation
    if (empty($fine_id) || empty($fine_amount)) {
        echo json_encode(['status' => 'error', 'message' => 'Fine ID and Fine Amount are required.']);
        exit;
    }

    if(strlen($fine_id) > 5 || $fine_id[0] != 'F'){
        echo json_encode(['status' => 'error', 'message' => 'Invalid Fine ID format. Must start with F and be max 5 chars.']);
        exit;
    }

    $fine_val = floatval($fine_amount);
    if ($fine_val < 2 || $fine_val > 500) {
        echo json_encode(['status' => 'error', 'message' => 'Fine amount must be between 2 and 500 LKR.']);
        exit;
    }

    // Check if fine_id exists
    $fineCheck = $conn->prepare("SELECT fine_id FROM fine WHERE fine_id = ?");
    $fineCheck->bind_param("s", $fine_id);
    $fineCheck->execute();
    if ($fineCheck->get_result()->num_rows === 0) {
        echo json_encode(['status' => 'error', 'message' => 'Fine record not found.']);
        exit;
    }
    $fineCheck->close();

    // Update fine
    $date_modified = date('Y-m-d h:i:sa');
    
    $stmt = $conn->prepare("UPDATE fine SET fine_amount = ?, fine_date_modified = ? WHERE fine_id = ?");
    $stmt->bind_param("sss", $fine_amount, $date_modified, $fine_id);
    
    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'Fine updated successfully.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to update fine: ' . $conn->error]);
    }
    
    $stmt->close();
    $conn->close();
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
}
?>
