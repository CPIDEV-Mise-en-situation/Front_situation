<?php
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    $id = $data['id'];
    $title = $data['title'];
    $dateTime = $data['date'] . ' ' . $data['time'];
    $price = $data['price'];
    $customer_name = $data['customer_name'];
    $customer_phone = $data['customer_phone'];
    $customer_email = $data['customer_email'];
    $vehicle_type = $data['vehicle_type'];
    $service_type = $data['service_type'];
    $notes = $data['notes'];

    $start_time = date('Y-m-d H:i:s', strtotime($dateTime));
    $end_time = date('Y-m-d H:i:s', strtotime($dateTime . ' +1 hour'));

    $stmt = $pdo->prepare("
        UPDATE reservations
        SET title = ?, start_time = ?, end_time = ?, price = ?,
            customer_name = ?, customer_phone = ?, customer_email = ?,
            vehicle_type = ?, service_type = ?, notes = ?
        WHERE id = ?
    ");
    $stmt->execute([
        $title, $start_time, $end_time, $price,
        $customer_name, $customer_phone, $customer_email,
        $vehicle_type, $service_type, $notes, $id
    ]);

    echo json_encode(['success' => true]);
    exit;
}
?>
