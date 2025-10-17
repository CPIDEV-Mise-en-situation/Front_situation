<?php
$host = '127.0.0.1'; // Adresse du serveur
$dbname = ''; // Nom de la base de données
$username = ''; // Nom d'utilisateur
$password = ''; // Mot de passe

try {
    // Création de la connexion PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);

    // Supprimez ou commentez la ligne suivante
    // echo "Connexion réussie !";
} catch (PDOException $e) {
    // Gestion des erreurs
    echo "Erreur de connexion : " . $e->getMessage();
}
?>
