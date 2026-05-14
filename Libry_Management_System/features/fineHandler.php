<?php
require_once('../config/db.php');

header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fine_id = trim($_POST['fine_id'] ?? '');
    $member_id = trim($_POST['member_id'] ?? '');
    $book_id = trim($_POST['book_id'] ?? '');
    $fine_amount = trim($_POST['fine_amount'] ?? '');
    
    // Server-side validation
    if (empty($fine_id) || empty($member_id) || empty($book_id) || empty($fine_amount)) {
        echo json_encode(['status' => 'error', 'message' => 'All fields are required.']);
        exit;
    }

    $fine_val = floatval($fine_amount);
    if ($fine_val < 2 || $fine_val > 500) {
        echo json_encode(['status' => 'error', 'message' => 'Fine amount must be between 2 and 500 LKR.']);
        exit;
    }

    // Check if book exists
    $bookCheck = $conn->prepare("SELECT book_id FROM book WHERE book_id = ?");
    $bookCheck->bind_param("s", $book_id);
    $bookCheck->execute();
    if ($bookCheck->get_result()->num_rows === 0) {
        echo json_encode(['status' => 'error', 'message' => 'Book ID does not exist.']);
        exit;
    }
    $bookCheck->close();

    // Check if member exists
    $memberCheck = $conn->prepare("SELECT member_id FROM member WHERE member_id = ?");
    $memberCheck->bind_param("s", $member_id);
    $memberCheck->execute();
    if ($memberCheck->get_result()->num_rows === 0) {
        echo json_encode(['status' => 'error', 'message' => 'Member ID does not exist.']);
        exit;
    }
    $memberCheck->close();

    // Check if fine_id already exists
    $fineCheck = $conn->prepare("SELECT fine_id FROM fine WHERE fine_id = ?");
    $fineCheck->bind_param("s", $fine_id);
    $fineCheck->execute();
    if ($fineCheck->get_result()->num_rows > 0) {
        echo json_encode(['status' => 'error', 'message' => 'Fine ID already exists.']);
        exit;
    }
    $fineCheck->close();

    // Insert fine
    $date_modified = date('Y-m-d h:i:sa');
    
    $stmt = $conn->prepare("INSERT INTO fine (fine_id, book_id, member_id, fine_amount, fine_date_modified) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $fine_id, $book_id, $member_id, $fine_amount, $date_modified);
    
    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'Fine assigned successfully.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to assign fine: ' . $conn->error]);
    }
    
    $stmt->close();
    $conn->close();
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
}
?>
