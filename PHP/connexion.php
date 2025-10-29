<?php
// Connexion à la base de données
require_once __DIR__ . '/config.php';
session_start();

$error = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    if (empty($email) || empty($password)) {
        $error = "Tous les champs sont obligatoires.";
    } else {
        // Vérifier si l'utilisateur existe
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);


        

        if (password_verify($password, $user['password'])) {
            $_SESSION['id'] = $user['id'];
            $_SESSION['nom'] = $user['name'];
            $_SESSION['prenom'] = $user['surname'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['location'] = $user['location'];
            $_SESSION['isadmin'] = $user['isadmin'];


            // Redirection ou message
            header('Location: profil.php');
            exit;
        } else {
            $error = "Email ou mot de passe incorrect.";
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Connexion</title>
        <link rel="stylesheet" href="../CSS/connexion-inscription.css">
    </head>
    <body>
        <div class="head">
            <img src="../IMG/drapeau_de_lorraine.png" alt="Drapeau de la Lorraine" id="logoLorraine"/>
            <div id="headLogo">
                <img src="../IMG/logo_republique_francaise.png" alt="Logo de la république"/>
                <img src="../IMG/logo.png" alt="Logo du site" id="logo"/>
            </div>
        </form>
        <?php if (!empty($error)): ?>
            <div style="color: red; text-align: center;">
                <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>

        <div class="form">
            <h1>Connexion: </h1>
            <form id="loginForm" action="./connexion_process.php" method="post">
                <label for="email">Mail</label>
                <input type="email" name="email" id="email" class="textBox" required/>
                <label for="password">Mot de passe</label>
                <input type="password" name="password" id="password" class="textBox" required/>
                <div class="buttonDiv">
                    <input type="submit" value="Connexion" class="button"/>
                </div>
            </form>
        </div>

</html>