<?php
require 'config.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendrier de Réservations - BrillAuto68</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <div class="container">
        <h1>Calendrier de Réservations</h1>
        <div class="calendar-header">
            <button id="prev-week"><i class="fas fa-chevron-left"></i></button>
            <h2 id="week-dates"></h2>
            <button id="next-week"><i class="fas fa-chevron-right"></i></button>
        </div>
        <div class="calendar">
            <div class="time-slot">
                <div class="time-label"></div>
                <?php
                // Heures d'ouverture (7h à 20h)
                for ($hour = 7; $hour <= 20; $hour++) {
                    echo "<div class='time-label'>" . sprintf("%02d:00", $hour) . "</div>";
                }
                ?>
            </div>
            <div class="days" id="calendar-days"></div>
        </div>
        <div id="reservation-form-container" class="hidden">
            <form id="reservation-form">
                <input type="hidden" id="selected-date" name="date">
                <input type="hidden" id="selected-time" name="time">
                <label for="title">Titre:</label>
                <input type="text" id="title" name="title" required>
                <label for="price">Prix (€):</label>
                <input type="number" id="price" name="price" step="0.01" required>
                <label for="customer_name">Nom du Client:</label>
                <input type="text" id="customer_name" name="customer_name" required>
                <label for="customer_phone">Téléphone:</label>
                <input type="text" id="customer_phone" name="customer_phone" required>
                <label for="customer_email">Email:</label>
                <input type="email" id="customer_email" name="customer_email">
                <label for="vehicle_type">Type de Véhicule:</label>
                <input type="text" id="vehicle_type" name="vehicle_type" required>
                <label for="service_type">Type de Service:</label>
                <input type="text" id="service_type" name="service_type" required>
                <label for="notes">Notes:</label>
                <textarea id="notes" name="notes"></textarea>
                <button type="submit">Enregistrer la Réservation</button>
                <button type="button" id="cancel-reservation">Annuler</button>
            </form>
        </div>
        <div id="reservation-details" class="hidden">
            <h3>Détails de la Réservation</h3>
            <p id="detail-title"><strong>Titre:</strong> <span></span></p>
            <p id="detail-time"><strong>Heure:</strong> <span></span></p>
            <p id="detail-price"><strong>Prix:</strong> <span></span></p>
            <p id="detail-customer"><strong>Client:</strong> <span></span></p>
            <p id="detail-phone"><strong>Téléphone:</strong> <span></span></p>
            <p id="detail-email"><strong>Email:</strong> <span></span></p>
            <p id="detail-vehicle"><strong>Véhicule:</strong> <span></span></p>
            <p id="detail-service"><strong>Service:</strong> <span></span></p>
            <p id="detail-notes"><strong>Notes:</strong> <span></span></p>
            <button id="edit-reservation">Modifier</button>
            <button id="delete-reservation">Supprimer</button>
            <button id="close-details">Fermer</button>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="script.js"></script>
</body>
</html>
