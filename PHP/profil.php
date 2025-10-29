<?php

require_once __DIR__ . '/config.php';

$reqUsers = $pdo->prepare("SELECT * FROM users");
$reqUsers->execute();
$users = $reqUsers->fetchAll(PDO::FETCH_ASSOC);

session_start();

$user_id = $_SESSION['user_id'];
$user_email = $_SESSION['email'];
$user_admin = $_SESSION['admin'];

if($user_id == null){
    header("Location: ./connexion.php");
    exit;
}

if($user_admin == 1){
    header("Location: ./profil_admin.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/index.css">
    <link rel="stylesheet" href="../CSS/footer.css">
    <link rel="stylesheet" href="../CSS/header.css">
    <link rel="stylesheet" href="../CSS/shopping.css">
    <title>LendMairie</title>
</head>

<body>
    <header class="header">
        <a href="../index.php">
            <img src="../img/logo.png" alt="icon">
        </a>
        <nav id="navigation">
            <div class="nav">
                <ul>
                    <li><a href="">Produit</a></li>
                    <li><a href="">Profil</a></li>
                    <li><a href="logout.php">Déconnexion</a></li>
                </ul>
            </div>
        </nav>
    </header>

    <div>
        <p><?= $user_email ?></p>
        <p><?= $user_id ?></p>
    </div>

    <footer id="footer">
        <img src="../IMG/logo.png" alt="Logo" id="footer-icon">
        <div id="contact">
            <ul>
                <li><p>Contact :</p></li>
                <li><a href="">19 place du Duroc</a></li>
                <li><a href="">54700 Pont-à-Monsson</a></li>
                <li><a href="">+33 3 83 81 10 68</a></li>
            </ul>
        </div>
        <div id="infos">
            <ul>
                <li><a href="">Mentions légales</a></li>
                <li><a href="">Accessibilité</a></li>
                <li><a href="">Gestion des cookies</a></li>
            </ul>
        </div>
        <div id="equipe"><p>Team CPIDEV</p></div>
    </footer>
</body>

</html>