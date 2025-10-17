<?php 

require 'PHP/config.php'

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./CSS/index.css">
    <title>Mairie - PAM</title>
</head>
<body>
    <header class="header">
        <img src="./img/logo.png" alt="icon">
        <button class="hamburger" aria-label="Menu">☰</button>
        <nav id="navigation">
            <div class="nav">
                <ul>
                    <li><a href="">Produit</a></li>
                    <li><a href="">Profil</a></li>
                    <li><a href="">Connexion</a></li>
                </ul>
            </div>
        </nav>
    </header>
    <section id="page">
        <div id="title">
            <h1>MIEUX ÉQUIPÉS POUR MIEUX VOUS ACCOMPAGNER</h1>
        </div>
    </section>
    <footer id="footer">
        <img src="./IMG/logo.png" alt="">
        <div id="contact">
            <ul>
                <li><p>Contact :</p></li>
                <li><a href="">19 place du Duroc</a></li>
                <li><a href="">54700 Pont-à-Monsson - France</a></li>
                <li><a href="">+33 3 83 81 10 68</a></li>
            </ul>
        </div>
        <div id="infos">
            <ul>
                <li><a href="">Mentions légales - Politique de confidentialité</a></li>
                <li><a href="">Accessibilité - Plan du site</a></li>
                <li><a href="">Gestion des cookies</a></li>
            </ul>
        </div>
        <div id="equipe">
            <p>Team CPIDEV</p>
        </div>
    </footer>
    <script src="./JS/script.js"></script>
</body>
</html>
