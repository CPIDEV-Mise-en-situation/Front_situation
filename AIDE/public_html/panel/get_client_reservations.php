<?php
session_start();
header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['error' => 'Non autorisé']);
    exit;
}

try {
    $pdo = new PDO('mysql:host=localhost;dbname=', '', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $pdo->prepare("
        SELECT DISTINCT r.*, ts.start_time, ts.end_time
        FROM reservations r
        JOIN time_slots ts ON r.time_slot = ts.start_time
        WHERE r.user_id = ?
    ");
    $stmt->execute([$_SESSION['user_id']]);
    $reservations = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($reservations);
} catch (PDOException $e) {
    echo json_encode(['error' => 'Erreur de base de données : ' . $e->getMessage()]);
}
?>
