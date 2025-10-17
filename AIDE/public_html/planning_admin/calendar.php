<?php
require 'config.php';

// Récupérer les réservations
$stmt = $pdo->prepare("SELECT * FROM reservations");
$stmt->execute();
$reservations = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Formater pour FullCalendar
$events = [];
foreach ($reservations as $reservation) {
    $events[] = [
        'id' => $reservation['id'],
        'title' => $reservation['title'] . " (" . $reservation['customer_name'] . ")",
        'start' => $reservation['start'],
        'end' => $reservation['end'],
        'extendedProps' => [
            'customer_name' => $reservation['customer_name'],
            'customer_phone' => $reservation['customer_phone'],
            'customer_email' => $reservation['customer_email'],
            'vehicle_type' => $reservation['vehicle_type'],
            'service_type' => $reservation['service_type'],
            'notes' => $reservation['notes']
        ]
    ];
}

header('Content-Type: application/json');
echo json_encode($events);
?>
