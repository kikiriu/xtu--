<?php
include '../models/conn.php';

$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['pub_ids']) && !empty($data['pub_ids'])) {
    $pub_ids = $data['pub_ids'];
    $in_clause = implode(',', array_fill(0, count($pub_ids), '?'));

    $stmt = $conn->prepare("DELETE FROM notifications WHERE pub_id IN ($in_clause)");
    $types = str_repeat('i', count($pub_ids)); // Assuming pub_id is integer type
    $stmt->bind_param($types, ...$pub_ids);
    
    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => $stmt->error]);
    }
    
    $stmt->close();
} else {
    echo json_encode(['success' => false, 'error' => '无效的pub_ids']);
}

$conn->close();
?>
