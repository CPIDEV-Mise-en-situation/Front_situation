<!DOCTYPE html>
<html lang="fr" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="BrillAuto68 - Nettoyage automobile professionnel en Alsace">
    <title>BrillAuto68 | Nettoyage Auto Premium</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Lexend:wght@500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./css/index.css">
    <link rel="icon" href="./img/favicon.ico" type="image/x-icon">
</head>
<body>
    <!-- Theme Toggle -->
    <button class="theme-toggle" aria-label="Changer de thème">
        <i class="fas fa-moon"></i>
    </button>
    <!-- Phone Float Button -->
    <a href="tel:+33764193222" class="phone-float" target="_blank" aria-label="Nous contacter">
        <i class="fas fa-phone"></i>
    </a>
    <div class="cursor-follower"></div>
    <div class="top-section">
        <header class="container">
            <nav class="navbar">
                <div class="logo-container">
                    <img src="./img/logo.png" alt="BrillAuto68 Logo" class="logo" loading="lazy">
                </div>
            </nav>
            <div class="hero-content">
                <h1 class="hero-title">
                    <span class="text-reveal">Votre véhicule</span>
                    <span class="text-reveal">mérite le meilleur</span>
                </h1>
                <div class="scroll-indicator">
                    <div class="scroll-line"></div>
                    <span>Découvrir nos services</span>
                </div>
            </div>
        </header>
    </div>
    <main>
        <section class="services-section container">
            <div class="section-header">
                <h2 class="section-title">
                    <span class="title-reveal">Nos Prestations</span>
                    <div class="section-underline"></div>
                </h2>
            </div>
            <div class="services-grid">
                <!-- Service Extérieur -->
                <div class="service-card visible">
                    <div class="service-image">
                        <img src="./img/kevcar3.png" alt="Nettoyage Extérieur Premium" loading="lazy">
                    </div>
                    <div class="service-content">
                        <div class="service-header">
                            <h3>Nettoyage Extérieur : Sur Demande</h3>
                            <div class="info-trigger">
                                <i class="fas fa-circle-info info-icon"></i>
                                <div class="info-tooltip">
                                    <h4>Nettoyage Extérieur</h4>
                                    <ul>
                                        <li>Premier Lavage</li>
                                        <li>Second Lavage avec Shampoing Moussant</li>
                                        <li>Néttoyage, Dégraissage des jantes et pneus</li>
                                        <li>Séchage microfibre sans traces</li>
                                    </ul>
                                    <div class="tooltip-price">Sur Demande</div>
                                </div>
                            </div>
                        </div>
                        <p class="service-description">Redonnez un éclat neuf à votre carrosserie avec notre traitement professionnel</p>
                        <button class="cta-button" data-service="exterieur">
                            Contactez-moi
                        </button>
                    </div>
                </div>
                <!-- Service Intérieur -->
                <div class="service-card visible">
                    <div class="service-image">
                        <img src="./img/kevcar2.png" alt="Nettoyage Intérieur Complet" loading="lazy">
                    </div>
                    <div class="service-content">
                        <div class="service-header">
                            <h3>Nettoyage Intérieur</h3>
                            <div class="info-trigger">
                                <i class="fas fa-circle-info info-icon"></i>
                                <div class="info-tooltip">
                                    <h4>Nettoyage Intérieur Complet</h4>
                                    <ul>
                                        <li>Aspiration profonde des sièges et tapis</li>
                                        <li>Nettoyage des plastiques et tableau de bord</li>
                                        <li>Traitement anti-odeurs</li>
                                        <li>Protection des surfaces</li>
                                    </ul>
                                    <div class="tooltip-price">A Partir de 35€ Offre de Lancement</div>
                                </div>
                            </div>
                        </div>
                        <p class="service-description">Un intérieur impeccable pour un confort optimal</p>
                        <button class="cta-button" data-service="interieur">
                            Contactez-moi
                        </button>
                    </div>
                </div>
                <!-- Service Optique -->
                <div class="service-card visible">
                    <div class="service-image">
                        <img src="./img/offreoptique.png" alt="Nettoyage Intérieur Complet" loading="lazy">
                    </div>
                    <div class="service-content">
                        <div class="service-header">
                            <h3>Rénovation Optique Ternis</h3>
                            <div class="info-trigger">
                                <i class="fas fa-circle-info info-icon"></i>
                                <div class="info-tooltip">
                                    <h4>Rénovation Optique</h4>
                                    <ul>
                                        <li>Nettoyage des optiques</li>
                                        <li>Pose de Protection autour de l'optique</li>
                                        <li>Ponçage de(s) optique(s)</li>
                                        <li>Polisage de(s) optique(s)</li>
                                    </ul>
                                    <div class="tooltip-price">A Partir de 10€</div>
                                </div>
                            </div>
                        </div>
                        <p class="service-description">Optiques Termis ? Contre Visite ? Découvrez notre forfait Rénovation Optiques !</p>
                        <button class="cta-button" data-service="interieur">
                            Contactez-moi
                        </button>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <!-- Contact Modal -->
    <div class="modal-overlay" id="contactModal">
        <div class="modal-container">
            <button class="modal-close">
                <i class="fas fa-times"></i>
            </button>
            <div class="modal-content">
                <h2 class="modal-title">Contactez-nous</h2>
                <div class="contact-info">
                    <p><strong>Email :</strong> brillauto68@gmail.com</p>
                    <p><strong>Téléphone :</strong> 07 64 19 32 22</p>
                </div>
            </div>
        </div>
    </div>
    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-brand">
                    <img src="./img/logo.png" alt="BrillAuto68 Logo" class="footer-logo" loading="lazy">
                    <p class="footer-tagline">Nettoyage automobile professionnel en Alsace</p>
                </div>
                <div class="footer-section">
                    <h3>Services</h3>
                    <ul>
                        <li><a href="#">Rénovation Optique Ternis</a></li>
                        <li><a href="#">Nettoyage Extérieur : Sur Demande</a></li>
                        <li><a href="#">Nettoyage Intérieur</a></li>
                        <li><a href="#">Nettoyage Cuir</a></li>
                        <li><a href="#">Nettoyage Alcantara</a></li>
                        <li><a href="#">Nettoyage Moquette</a></li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h3>Contact</h3>
                    <ul>
                        <li><a href="tel:+33764193222">07 64 19 32 22</a></li>
                        <li><a href="mailto:contact@brillauto68.fr">brillauto68@gmail.com</a></li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h3>Informations</h3>
                    <ul>
                        <li><a href="page-footer/cgv.html">Condition Général de Vente</a></li>
                        <li><a href="#">Mentions légales</a></li>
                        <li><a href="#">Politique de confidentialité</a></li>
                    </ul>
                </div>
            </div>
            <div class="footer-bottom">
                <p>© 2025 BrillAuto68. Tous droits réservés.</p>
            </div>
        </div>
    </footer>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Theme Toggle
            const themeToggle = document.querySelector('.theme-toggle');
            themeToggle.addEventListener('click', () => {
                const currentTheme = document.documentElement.getAttribute('data-theme');
                document.documentElement.setAttribute('data-theme', currentTheme === 'dark' ? 'light' : 'dark');
                themeToggle.innerHTML = currentTheme === 'dark' ? '<i class="fas fa-sun"></i>' : '<i class="fas fa-moon"></i>';
                localStorage.setItem('theme', currentTheme === 'dark' ? 'light' : 'dark');
            });
            if (localStorage.getItem('theme')) {
                const savedTheme = localStorage.getItem('theme');
                document.documentElement.setAttribute('data-theme', savedTheme);
                themeToggle.innerHTML = savedTheme === 'dark' ? '<i class="fas fa-moon"></i>' : '<i class="fas fa-sun"></i>';
            }
            // Custom Cursor
            const cursor = document.querySelector('.cursor-follower');
            document.addEventListener('mousemove', (e) => {
                cursor.style.left = `${e.clientX}px`;
                cursor.style.top = `${e.clientY}px`;
            });
            // Text Reveal Animation
            const revealElements = document.querySelectorAll('.text-reveal, .title-reveal');
            revealElements.forEach(el => el.classList.add('visible'));
            // Modal Management
            const modal = document.getElementById('contactModal');
            const ctaButtons = document.querySelectorAll('.cta-button');
            const modalClose = document.querySelector('.modal-close');
            ctaButtons.forEach(button => {
                button.addEventListener('click', () => {
                    const service = button.getAttribute('data-service');
                    document.querySelector('.modal-title').textContent =
                        service === 'exterieur' ? 'Demande pour Nettoyage Extérieur' : 'Demande pour Nettoyage Intérieur';
                    modal.classList.add('active');
                    document.body.style.overflow = 'hidden';
                });
            });
            modalClose.addEventListener('click', () => {
                modal.classList.remove('active');
                document.body.style.overflow = '';
            });
        });
    </script>
</body>
</html>
        