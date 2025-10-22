<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./CSS/index.css">
    <link rel="stylesheet" href="./CSS/footer.css">
    <link rel="stylesheet" href="./CSS/header.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
    <style>
        /* Style pour la section des partenaires */
        .partners-section {
            padding: 20px;
            background-color: #f8f8f8;
            text-align: center;
        }
        .partners-title {
            margin-bottom: 20px;
            font-size: 1.5em;
            color: #333;
        }
        .partners-swiper {
            max-width: 100%;
            height: auto;
        }
        .partners-swiper .swiper-slide {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100px;
        }
        .partners-swiper img {
            max-height: 80px;
            max-width: 150px;
            object-fit: contain;
        }
    </style>
    <title>Mairie - PAM</title>
</head>
<body>
    <header class="header">
        <img src="./img/logo.png" alt="Logo">
        <button class="hamburger">☰</button>
        <nav class="nav">
            <button class="close-btn">✕</button>
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
        <div class="carousel-container">
            <div class="swiper">
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

    <section class="partners-section">
        <h2 class="partners-title">Nos Partenaires</h2>
        <div class="partners-swiper swiper">
            <div class="swiper-wrapper">
                <div class="swiper-slide"><img src="./IMG/Partenaire/france-lef.png" alt="Partenaire 1"></div>
                <div class="swiper-slide"><img src="./IMG/Partenaire/GIP.png" alt="Partenaire 2"></div>
                <div class="swiper-slide"><img src="./IMG/Partenaire/Grand Est.png" alt="Partenaire 3"></div>
                <div class="swiper-slide"><img src="./IMG/Partenaire/Leader.png" alt="Partenaire 4"></div>
                <div class="swiper-slide"><img src="./IMG/Partenaire/Meuse.png" alt="Partenaire 5"></div>
                <div class="swiper-slide"><img src="./IMG/Partenaire/Mewo.png" alt="Partenaire 6"></div>
                <div class="swiper-slide"><img src="./IMG/Partenaire/prefet.png" alt="Partenaire 7"></div>
                <div class="swiper-slide"><img src="./IMG/Partenaire/UE.png" alt="Partenaire 8"></div>
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </section>

    <footer id="footer">
        <img src="./IMG/logo.png" alt="Logo" id="footer-icon">
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
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="./JS/header.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Carousel des salles
            new Swiper('.carousel-container .swiper', {
                loop: true,
                slidesPerView: 1,
                centeredSlides: true,
                spaceBetween: 30,
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                pagination: {
                    el: '.carousel-container .swiper-pagination',
                    clickable: true,
                },
                autoplay: {
                    delay: 5000,
                },
            });

            // Carousel des partenaires
            new Swiper('.partners-swiper', {
                loop: true,
                slidesPerView: 3, // Affiche 3 logos à la fois
                spaceBetween: 20,
                autoplay: {
                    delay: 3000,
                },
                pagination: {
                    el: '.partners-swiper .swiper-pagination',
                    clickable: true,
                },
                breakpoints: {
                    640: {
                        slidesPerView: 4,
                    },
                    1024: {
                        slidesPerView: 5,
                    },
                },
            });
        });
    </script>
</body>
</html>
