<?php
session_start();

require_once __DIR__ . '/config.php';

$reqUsers = $pdo->prepare("SELECT * FROM users");
$reqUsers->execute();
$users = $reqUsers->fetchAll(PDO::FETCH_ASSOC);

$user_id = $_SESSION['id'];
$user_name = $_SESSION['nom'];
$user_surname = $_SESSION['prenom'];

$reqReservation = $pdo->prepare("SELECT * FROM reserver WHERE id_user = $user_id");
$reqReservation->execute();
$reservation = $reqReservation->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/index.css">
    <link rel="stylesheet" href="../CSS/footer.css">
    <link rel="stylesheet" href="../CSS/header.css">
    <link rel="stylesheet" href="../CSS/profil.css">
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
                    <li><a href="shoplist.php">Produit</a></li>
                    <?php 
                    
                    if (isset($user_id)) {
                        echo '<li><a href="profil.php">Profil</a></li>';
                        echo '<li><a href="logout.php">Déconnexion</a></li>';
                    } else {
                        echo '<li><a href="connexion.php">Connexion</a></li>';
                    }

                    ?>
                </ul>
            </div>
        </nav>
    </header>

    <div class="profilContainer">
        <div class="userName">
            <p class="firstLetterUppercase"><?= $user_name ?></p>
            <p class="firstLetterUppercase"><?= $user_surname ?></p>
        </div>
        <p>Vos commandes :</p>

        <div>
            <table border="1" cellspacing="0" cellpadding="8">
                <thead>
                    <tr>
                        <th>user_id</th>
                        <th>product_id</th>
                        <th>product_title</th>
                        <th>desc_</th>
                        <th>status</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                        if (!empty($reservation)) {
                            foreach ($reservation as $item) {
                                echo '<tr>';
                                echo '<td>' . htmlspecialchars($item['id_user']) . '</td>';
                                echo '<td>' . htmlspecialchars($item['id_product']) . '</td>';
                                echo '<td>' . htmlspecialchars($item['title_products']) . '</td>';
                                echo '<td>' . nl2br(htmlspecialchars($item['desc_'])) . '</td>';
                                echo '<td>' . htmlspecialchars($item['status']) . '</td>';
                                echo '</tr>';
                            }
                        } else {
                            echo '<tr><td colspan="5">Aucune réservation trouvée.</td></tr>';
                        }
                        ?>
                </tbody>
            </table>
        </div>
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