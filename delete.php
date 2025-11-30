<?php
include 'config/database.php';

$id = $_GET['id'];

try {
    $sql = "DELETE FROM users WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
    
    header("Location: read.php?deleted=1");
    exit();
} catch(PDOException $e) {
    die("Error: " . $e->getMessage());
}
?>