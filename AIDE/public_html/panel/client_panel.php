<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ./connexion/login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Client</title>
    <link rel="stylesheet" href="client_panel.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <div class="dashboard-container">
        <aside class="sidebar">
            <h2> Panel Client</h2>
            <ul>
                <li><a href="#" id="reservations-link">🏷️ Mes Réservations</a></li>
                <li><a href="#" id="reviews-link">📝 Mes Avis</a></li>
            </ul>
        </aside>
        <main class="main-content">
            <h1>👋 Bienvenue, <?php echo isset($_SESSION['username']) ? htmlspecialchars($_SESSION['username']) : 'Invité'; ?></h1>
            <section id="reservations-section" class="hidden">
                <h2>📜 Liste de vos Réservations</h2>
                <table>
                    <thead>
                        <tr>
                            <th>🪪 Nom</th>
                            <th>📧 Email</th>
                            <th>🗓️ Date</th>
                            <th>⏰ Heure</th>
                            <th>📂 Catégorie</th>
                            <th>👕 Type de Tissu</th>
                            <th>🔎 Statut</th>
                            <th>🫵 Action</th>
                        </tr>
                    </thead>
                    <tbody id="reservations-table">
                    </tbody>
                </table>
            </section>
            <section id="reviews-section" class="hidden">
                <h2>📝 Ajouter un Avis</h2>
                <form id="review-form">
                    <label for="service-type">Service:</label>
                    <select id="service-type" name="service-type" required>
                        <option value="">Choisissez un service</option>
                        <option value="Nettoyage Extérieur">Nettoyage Extérieur</option>
                        <option value="Nettoyage Intérieur">Nettoyage Intérieur</option>
                        <option value="Pack Complet">Pack Complet</option>
                    </select>

                    <label>Note:</label>
                    <div class="star-rating">
                        <i class="far fa-star" data-value="1"></i>
                        <i class="far fa-star" data-value="2"></i>
                        <i class="far fa-star" data-value="3"></i>
                        <i class="far fa-star" data-value="4"></i>
                        <i class="far fa-star" data-value="5"></i>
                        <input type="hidden" id="rating" name="rating" required>
                    </div>

                    <label for="review-text">Votre Avis:</label>
                    <textarea id="review-text" name="review-text" required></textarea>
                    <button type="submit">Envoyer</button>
                </form>

                <div id="user-reviews">
                    <h3>📜 Vos Avis Postés</h3>
                    <div id="reviews-list"></div>
                </div>
            </section>
        </main>
    </div>

    <!-- Popup de détails de réservation -->
    <div id="reservation-details-popup" class="popup hidden">
        <div class="popup-content"></div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.1.1/crypto-js.min.js"></script>
    <script src="client_panel.js"></script>
</body>
</html>
