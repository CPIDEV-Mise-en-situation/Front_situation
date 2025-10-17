<?php
session_start();
header('Content-Type: application/json');

// Debug (à désactiver en production)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Vérification de la session
if (!isset($_SESSION['user_id']) || !isset($_SESSION['username'])) {
    echo json_encode(['error' => 'Non autorisé - Session invalide']);
    exit;
}

// Vérification de la méthode
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['error' => 'Méthode non autorisée']);
    exit;
}

// Récupération des données
$json = file_get_contents('php://input');
$data = json_decode($json, true);

if (json_last_error() !== JSON_ERROR_NONE) {
    echo json_encode(['error' => 'Données JSON invalides']);
    exit;
}

// Validation des données
$required = ['review', 'rating', 'service_type'];
foreach ($required as $field) {
    if (empty($data[$field])) {
        echo json_encode(['error' => 'Le champ '.$field.' est requis']);
        exit;
    }
}

// Validation de la note
if (!is_numeric($data['rating']) || $data['rating'] < 1 || $data['rating'] > 5) {
    echo json_encode(['error' => 'La note doit être entre 1 et 5']);
    exit;
}

try {
    // Connexion DB
    $pdo = new PDO(
        'mysql:host=localhost;dbname=',
        '',
        '',
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]
    );

    // Insertion de l'avis
    $stmt = $pdo->prepare("INSERT INTO reviews 
                          (user_id, username, review_text, rating, service_type) 
                          VALUES (?, ?, ?, ?, ?)");
    
    $success = $stmt->execute([
        $_SESSION['user_id'],
        $_SESSION['username'],
        htmlspecialchars($data['review']),
        (int)$data['rating'],
        htmlspecialchars($data['service_type'])
    ]);

    echo json_encode(['success' => $success]);

} catch (PDOException $e) {
    echo json_encode(['error' => 'Erreur DB: ' . $e->getMessage()]);
}
?>