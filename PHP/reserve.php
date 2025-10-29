<?php
session_start();
require_once __DIR__ . '/config.php';

// Vérifie si l'utilisateur est connecté
if (empty($_SESSION['id'])) {
    header('Location: connexion.php');
    exit;
}

// Récupération sécurisée des données du formulaire
$id_user = $_SESSION['id'];
$id_product = $_POST['product_id'] ?? null;
$title = $_POST['title_products'] ?? '';
$desc = $_POST['desc_'] ?? '';

if (empty($id_product)) {
    // Si l’ID du produit est manquant → redirige
    header('Location: shoplist.php');
    exit;
}

// Définir le statut et la date de réservation
$status = 'waiting';
$date_ = date('Y-m-d');

// Prépare et exécute l’insertion
$stmt = $pdo->prepare('
    INSERT INTO reserver (id_user, id_product, title_products, desc_, date_, status)
    VALUES (:id_user, :id_product, :title_products, :desc_, :date_, :status)
');

$stmt->execute([
    'id_user' => $id_user,
    'id_product' => $id_product,
    'title_products' => $title,
    'desc_' => $desc,
    'date_' => $date_,
    'status' => $status
]);

// Redirige vers la page profil ou une page de confirmation
header('Location: profil.php');
exit;
?>
