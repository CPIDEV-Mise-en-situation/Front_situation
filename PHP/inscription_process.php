<?php
include "./config.php";

session_start();

$password = password_hash(trim($_POST['password']), PASSWORD_DEFAULT);
$name = trim($_POST['name']);
$surname = trim($_POST['surname']);
$location = trim($_POST['location']);
$email = trim($_POST['email']);

try {
    // Vérifier si l'utilisateur existe déjà
    $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->execute([$email]); // Tableau de valeurs pour PDO
    if ($stmt->rowCount() > 0) {
        http_response_code(400);
        echo "error:Email déjà utilisé.";
        exit;
    }

    // Insertion de l'utilisateur
    $stmt = $pdo->prepare("INSERT INTO users (password, name, surname, email, location) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$password, $name, $surname, $email, $location]);

    $_SESSION['email'] = $email;
    echo "success:/index.php";

} catch (PDOException $e) {
    http_response_code(500);
    echo "error:Erreur lors de l'inscription : " . $e->getMessage();
}

?>