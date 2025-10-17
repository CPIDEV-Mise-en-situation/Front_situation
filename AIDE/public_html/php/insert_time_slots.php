<?php
try {
    $pdo = new PDO('mysql:host=localhost;dbname=reservations_db', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Définir les durées des services en minutes
    $durations = [
        'Nettoyage Extérieur' => 90,
        'Nettoyage Intérieur' => 120,
        'Pack Complet' => 180
    ];

    // Définir la date pour laquelle vous souhaitez insérer des créneaux horaires
    $date = '2023-12-01'; // Remplacez par la date souhaitée

    foreach ($durations as $categorie => $duration) {
        $startTime = strtotime('08:00:00');
        $endTime = strtotime('19:00:00');

        while ($startTime + $duration * 60 <= $endTime) {
            $slotStart = date('H:i:s', $startTime);
            $slotEnd = date('H:i:s', $startTime + $duration * 60);

            // Insérer un créneau horaire
            $insertSlot = $pdo->prepare("INSERT INTO time_slots (reservation_date, start_time, end_time, status, service_category)
                                        VALUES (:date, :start_time, :end_time, 'available', :categorie)");
            $insertSlot->bindParam(':date', $date);
            $insertSlot->bindParam(':start_time', $slotStart);
            $insertSlot->bindParam(':end_time', $slotEnd);
            $insertSlot->bindParam(':categorie', $categorie);

            $insertSlot->execute();

            // Passer au créneau suivant
            $startTime += 30 * 60; // Incrément de 30 minutes
        }
    }

    echo "Créneaux horaires insérés avec succès pour la date $date.";

} catch (PDOException $e) {
    echo "Erreur de connexion à la base de données : " . $e->getMessage();
}
?>
