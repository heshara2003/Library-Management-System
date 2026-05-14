<?php
require_once('../config/db.php');
require_once('../Session/session.php');
require_login(); // Assuming this is defined in session.php to protect access

if (isset($_GET['id'])) {
    $fine_id = $_GET['id'];

    $stmt = $conn->prepare("DELETE FROM fine WHERE fine_id = ?");
    $stmt->bind_param("s", $fine_id);

    if ($stmt->execute()) {
        header("Location: assign_fine.php?msg=deleted");
    } else {
        header("Location: assign_fine.php?error=" . urlencode("Failed to delete: " . $conn->error));
    }
    
    $stmt->close();
} else {
    header("Location: assign_fine.php");
}

$conn->close();
?>
