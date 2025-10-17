<?php
require 'config.php';

// Récupérer les réservations pour la semaine demandée
$weekStart = $_GET['week_start'];
$weekEnd = date('Y-m-d', strtotime($weekStart . ' +7 days'));

$stmt = $pdo->prepare("
    SELECT *
    FROM reservations
    WHERE DATE(start_time) BETWEEN :week_start AND :week_end
    ORDER BY start_time
");
$stmt->execute(['week_start' => $weekStart, 'week_end' => $weekEnd]);
$reservations = $stmt->fetchAll(PDO::FETCH_ASSOC);

header('Content-Type: application/json');
echo json_encode($reservations);
?>
