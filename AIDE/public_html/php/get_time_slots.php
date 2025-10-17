<?php
header('Content-Type: application/json');

try {
    $pdo = new PDO('mysql:host=localhost;dbname=u912352917_reservations', 'u912352917_brillautoadmin', '200125KevMonica');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (!isset($_GET['date']) || !isset($_GET['categorie']) || empty($_GET['date']) || empty($_GET['categorie'])) {
        echo json_encode(['error' => 'Les paramètres date et catégorie sont requis.']);
        exit;
    }

    $date = $_GET['date'];
    $categorie = $_GET['categorie'];

    $durations = [
        'Nettoyage Extérieur' => 120, // 2 heures
        'Nettoyage Intérieur' => 150, // 2 heures 30 minutes
        'Pack Complet' => 210 // 3 heures 30 minutes
    ];

    if (!isset($durations[$categorie])) {
        echo json_encode(['error' => 'Catégorie de service inconnue.']);
        exit;
    }

    $duration = $durations[$categorie];

    // Récupérer les créneaux réservés pour la date et la catégorie spécifiées
    $stmt = $pdo->prepare("SELECT start_time, end_time FROM time_slots WHERE reservation_date = :date AND status = 'reserved'");
    $stmt->bindParam(':date', $date);
    $stmt->execute();
    $reservedSlots = $stmt->fetchAll(PDO::FETCH_ASSOC);


    $availableSlots = [];
    $startTime = strtotime('08:00:00');
    $endTime = strtotime('19:00:00');

    while ($startTime + $duration * 60 <= $endTime) {
        $slotStart = date('H:i:s', $startTime);
        $slotEnd = date('H:i:s', $startTime + $duration * 60);

        // Vérifier si le créneau chevauche la pause déjeuner
        $lunchStart = strtotime('12:00:00');
        $lunchEnd = strtotime('13:30:00');
        $currentStart = strtotime($slotStart);
        $currentEnd = strtotime($slotEnd);

        if ($currentStart < $lunchEnd && $currentEnd > $lunchStart) {
            $startTime = $lunchEnd;
            continue;
        }

        $isReserved = false;
        foreach ($reservedSlots as $reservedSlot) {
            $reservedStart = strtotime($reservedSlot['start_time']);
            $reservedEnd = strtotime($reservedSlot['end_time']);

            if ($currentStart < $reservedEnd && $currentEnd > $reservedStart) {
                $isReserved = true;
                break;
            }
        }

        if (!$isReserved) {
            $availableSlots[] = [
                'start_time' => $slotStart,
                'end_time' => $slotEnd,
                'status' => 'available'
            ];
        }

        $startTime += 30 * 60; // Incrément de 30 minutes
    }

    echo json_encode($availableSlots);

} catch (PDOException $e) {
    echo json_encode(['error' => 'Erreur de connexion à la base de données : ' . $e->getMessage()]);
}
?>
