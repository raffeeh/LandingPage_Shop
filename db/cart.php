<?php
session_start();

$data = json_decode(file_get_contents("php://input"), true);
$_SESSION['cart'] = $data;

header('Content-Type: application/json');
echo json_encode(['status' => 'success']);
?>
