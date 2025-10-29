<?php
session_start();
$user_id = $_SESSION['id'] ?? null;

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./CSS/index.css">
    <link rel="stylesheet" href="./CSS/footer.css">
    <link rel="stylesheet" href="./CSS/header.css">
    <link rel="stylesheet" href="./CSS/root.css">
    <link rel="shortcut icon" href="./IMG/little-logo.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&family=Roboto:wght@300;400&display=swap" rel="stylesheet">
    <title>La Mairie de Verdun</title>
</head>
<body>
    <header class="header">
        <img src="./img/logo.png" alt="Logo">
        <button class="hamburger">☰</button>
        <nav class="nav">
            <button class="close-btn">✕</button>
            <ul>
                <li><a href="PHP/shoplist.php">Produit</a></li>
                <?php 
                
                if (isset($user_id)) {
                    echo '<li><a href="PHP/profil.php">Profil</a></li>';
                    echo '<li><a href="PHP/logout.php">Déconnexion</a></li>';
                } else {
                    echo '<li><a href="PHP/connexion.php">Connexion</a></li>';
                }

                ?>
            </ul>
        </nav>
    </header>

    <!-- Section avec vidéo et titre -->
    <section id="page">
        <video autoplay muted loop id="background-video">
            <source src="./MEDIA/Vidéo Verdun Meuse2 - Lorraine Tourisme - FR.mp4" type="video/mp4">
        </video>
        <div id="title">
            <h1>MIEUX ÉQUIPÉS POUR MIEUX VOUS ACCOMPAGNER</h1>
        </div>

    </section>

    <!-- Conteneur principal avec carousel et carte -->
    <section id="container">
        <div class="carousel-container">
            <div class="swiper">
                <h2>🥳 Nos salles des fêtes</h2>
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="swiper-slide-content">
                            <img src="./IMG/René Cassin.jpg" alt="Salle des Fêtes">
                            <h3>Salle René Cassin</h3>
                            <p class="legend">All. du Pré l'Évêque, 55100 Verdun</p>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="swiper-slide-content">
                            <img src="./IMG/Jeanne d'Arc.jpg" alt="Salle Quartier Nord">
                            <h3>Salle Jeanne d'Arc</h3>
                            <p class="legend">60 Av. de la 42ÈME Division, 55100 Verdun</p>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="swiper-slide-content">
                            <img src="./IMG/Thierville.jpg" alt="Mairie Annexe">
                            <h3>Salle des Fêtes (Thierville-sur-Meuse)</h3>
                            <p class="legend">55840 Thierville-sur-Meuse</p>
                        </div>
                    </div>
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
        <div class="maps">
            <iframe src="https://www.google.com/maps/embed?pb=!1m16!1m12!1m3!1d19354.013677588107!2d5.371266467081616!3d49.16168313312668!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!2m1!1sSalle%20des%20Fêtes%20à%20proximité%20de%20Verdun!5e0!3m2!1sfr!2sfr!4v1761120584464!5m2!1sfr!2sfr" allowfullscreen loading="lazy"></iframe>
        </div>
    </section>

    <!-- Section "À propos" -->
    <section class="about-section">

        <div class="about-content">
            <h2>💬 À propos de nous</h2>
            <p>
                Nous mettons à votre disposition des infrastructures modernes et accessibles pour tous vos événements.
                Nos salles sont équipées pour répondre à vos besoins, que ce soit pour des réunions, des célébrations ou des activités culturelles.
                Situées au cœur de Verdun et ses alentours, elles offrent un cadre idéal pour chaque occasion.
            </p>
        </div>
    </section>

    <!-- <div class="wave-wrapper">
        <svg class="wave" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 120" preserveAspectRatio="none">
            <path d="M0,60 C320,120 640,20 960,70 C1280,120 1440,30 1440,60 L1440,120 L0,120 Z" fill="white"></path>
        </svg>
    </div> -->

    <!-- Séparateur -->
    <section class="separator"></section>

    <!-- Section partenaires -->
    <section class="partners-section">
        <h2 class="partners-title">🤝 Nos Partenaires</h2>
        <div class="partners-swiper swiper">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <div class="partner-card">
                        <img src="./IMG/Partenaire/france-lef.png" alt="Partenaire 1">
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="partner-card">
                        <img src="./IMG/Partenaire/GIP.png" alt="Partenaire 2">
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="partner-card">
                        <img src="./IMG/Partenaire/Grand Est.png" alt="Partenaire 3">
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="partner-card">
                        <img src="./IMG/Partenaire/Leader.png" alt="Partenaire 4">
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="partner-card">
                        <img src="./IMG/Partenaire/Meuse.png" alt="Partenaire 5">
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="partner-card">
                        <img src="./IMG/Partenaire/Mewo.png" alt="Partenaire 6">
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="partner-card">
                        <img src="./IMG/Partenaire/prefet.png" alt="Partenaire 7">
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="partner-card">
                        <img src="./IMG/Partenaire/UE.png" alt="Partenaire 8">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Pied de page -->
    <footer id="footer">
        <div class="contenair">
            <img src="./IMG/logo.png" alt="Logo" id="footer-icon">
            <div id="contact">
                <ul>
                    <li><p>Contact :</p></li>
                    <li><a href="">11 r Prés Poincaré,</a></li>
                    <li><a href="">55100 Verdun</a></li>
                    <li><a href="">+33 03 29 83 44 22</a></li>
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
            </div>
    </footer>

    <!-- SVG pour l'effet de distortion (Liquid Glass) -->
    <svg style="position: absolute; width: 0; height: 0;" aria-hidden="true">
        <defs>
            <filter id="glass-distortion">
                <feTurbulence type="fractalNoise" baseFrequency="0.02 0.05" numOctaves="2" result="noise"/>
                <feDisplacementMap in="SourceGraphic" in2="noise" scale="3" xChannelSelector="R" yChannelSelector="G"/>
            </filter>
        </defs>
    </svg>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="./JS/header.js"></script>
    <script src="./JS/carouselles.js"></script>
</body>
</html>
