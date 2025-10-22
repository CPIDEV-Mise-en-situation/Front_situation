<?php
include "./config.php";

session_start();

$password = password_hash(trim($_POST['password']), PASSWORD_DEFAULT);
$nom = trim($_POST['nom']);
$prenom = trim($_POST['prenom']);
$adresse = trim($_POST['adresse']);
$mail = trim($_POST['mail']);

// Vérification si l'utilisateur existe
$stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
$stmt->bind_param("s", $mail);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    http_response_code(400);
    echo "error:Nom d'utilisateur déjà utilisé.";
} else {
    $stmt = $conn->prepare("INSERT INTO users (password, nom, prenom, mail, adresse) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $password, $nom, $prenom, $mail, $adresse);

    if ($stmt->execute()) {
        $_SESSION['mail'] = $mail;
        echo "success:/index.php"; // ou une autre page après inscription
    } else {
        http_response_code(500);
        echo "error:Erreur lors de l'inscription.";
    }
}

$stmt->close();
$conn->close();

?>