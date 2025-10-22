<?php
// require 'PHP/config.php'
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./CSS/index.css">
    <link rel="stylesheet" href="./CSS/footer.css">
    <link rel="stylesheet" href="./CSS/header.css">
    <title>Mairie - PAM</title>
</head>

<body>
    <header class="header">
        <img src="./img/logo.png" alt="icon">
        <button class="hamburger" aria-label="Ouvrir le menu">☰</button>
        <nav class="nav">
            <button class="close-btn" aria-label="Fermer le menu">✕</button>
            <ul>
                <li><a href="">Produit</a></li>
                <li><a href="">Profil</a></li>
                <li><a href="">Connexion</a></li>
            </ul>
        </nav>
    </header>

    <section id="page">
        <video autoplay muted loop id="background-video">
            <source src="./MEDIA/Vidéo Verdun Meuse2 - Lorraine Tourisme - FR.mp4" type="video/mp4">
        </video>
        <div id="title">
            <h1>MIEUX ÉQUIPÉS POUR MIEUX VOUS ACCOMPAGNER</h1>
        </div> 
    </section>

    <section id="container">
        <div class="maps">
            <iframe src="https://www.google.com/maps/embed?pb=!1m16!1m12!1m3!1d19354.013677588107!2d5.371266467081616!3d49.16168313312668!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!2m1!1sSalle%20des%20F%C3%AAtes%20%C3%A0%20proximit%C3%A9%20de%20Verdun!5e0!3m2!1sfr!2sfr!4v1761120584464!5m2!1sfr!2sfr" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </section>
    <footer id="footer">
        <img src="./IMG/logo.png" alt="" id="footer-icon">
        <div id="contact">
            <ul>
                <li>
                    <p>Contact :</p>
                </li>
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
</body>
<script src="./JS/header.js"></script>

</html>