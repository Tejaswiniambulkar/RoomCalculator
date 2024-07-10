<?php
session_start();

$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['totalCost']) && isset($data['roomSelections'])) {
    $_SESSION['totalCost'] = $data['totalCost'];
    $_SESSION['roomSelections'] = $data['roomSelections'];
    echo json_encode(['status' => 'success']);
} else {
    echo json_encode(['status' => 'error']);
}
?>
