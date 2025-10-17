<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require '../vendor/autoload.php';

function generateKeyAndIV() {
    $key = openssl_random_pseudo_bytes(32);
    $iv = openssl_random_pseudo_bytes(16);
    return ['key' => $key, 'iv' => $iv];
}

function encrypt($data, $key, $iv) {
    return openssl_encrypt($data, 'AES-256-CBC', $key, 0, $iv);
}

session_start();

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['error' => 'User ID not set in session']);
    exit();
}

try {
    $pdo = new PDO('mysql:host=localhost;dbname=u912352917_reservations', 'u912352917_brillautoadmin', '200125KevMonica');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo json_encode(['error' => 'Erreur de connexion : ' . $e->getMessage()]);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $data = json_decode(file_get_contents("php://input"), true);

        if (!isset($data['name'], $data['surname'], $data['address'], $data['phone'],
            $data['email'], $data['date'], $data['categorie'], $data['time-slot'])) {
            echo json_encode(['error' => 'Champs manquants']);
            exit();
        }

        $durations = [
            'Nettoyage Extérieur' => 120,
            'Nettoyage Intérieur' => 150,
            'Pack Complet' => 210
        ];

        if (!isset($durations[$data['categorie']])) {
            echo json_encode(['error' => 'Catégorie de service invalide.']);
            exit();
        }

        $duration = $durations[$data['categorie']];
        $endTime = date('H:i:s', strtotime($data['time-slot']) + $duration * 60);

        $conflictCheck = $pdo->prepare("SELECT COUNT(*) FROM time_slots
            WHERE reservation_date = ?
              AND ((start_time < ? AND end_time > ?) OR (start_time >= ? AND start_time < ?))
              AND status = 'reserved'");
        $conflictCheck->execute([
            $data['date'],
            $endTime, $data['time-slot'],
            $data['time-slot'], $endTime
        ]);

        if ($conflictCheck->fetchColumn() > 0) {
            echo json_encode(['error' => 'Ce créneau est déjà réservé. Veuillez en choisir un autre.']);
            exit();
        }

        $keyAndIV = generateKeyAndIV();
        $key = $keyAndIV['key'];
        $iv = $keyAndIV['iv'];

        $encryptedName = encrypt($data['name'], $key, $iv);
        $encryptedSurname = encrypt($data['surname'], $key, $iv);
        $encryptedAddress = encrypt($data['address'], $key, $iv);
        $encryptedEmail = encrypt($data['email'], $key, $iv);

        $userId = $_SESSION['user_id'];

        $stmt = $pdo->prepare("INSERT INTO reservations (name, surname, address, phone, email,
            reservation_date, time_slot, status, `key`, `iv`, categorie, user_id)
            VALUES (?, ?, ?, ?, ?, ?, ?, 'pending', ?, ?, ?, ?)");
        $stmt->execute([
            $encryptedName, $encryptedSurname, $encryptedAddress,
            $data['phone'], $encryptedEmail, $data['date'],
            $data['time-slot'], base64_encode($key), base64_encode($iv), $data['categorie'], $userId
        ]);

        $insertSlot = $pdo->prepare("INSERT INTO time_slots (reservation_date, start_time, end_time, service_category, status)
            VALUES (?, ?, ?, ?, 'reserved')");
        $insertSlot->execute([$data['date'], $data['time-slot'], $endTime, $data['categorie']]);

        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = '55@gmail.com';
            $mail->Password = 'ltpk slfl tlrs olwo';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;
            $mail->CharSet = 'UTF-8';

            $adminEmail = '@yahoo.com';
            $mail->setFrom('55@gmail.com', 'Thibault');
            $mail->addAddress($adminEmail);
            $mail->isHTML(true);
            $mail->Subject = 'Nouvelle réservation';
            $mail->Body = "Nouvelle réservation par {$data['name']} {$data['surname']} pour le {$data['date']} à {$data['time-slot']}.";
            $mail->send();

            $mail->clearAddresses();
            $mail->addAddress($data['email']);
            $mail->Subject = 'Confirmation de réservation';
            $mail->Body = "Bonjour {$data['name']},<br><br>Votre réservation pour le {$data['date']} à {$data['time-slot']} est confirmée.";
            $mail->send();

            echo json_encode(['success' => true]);
        } catch (Exception $e) {
            echo json_encode(['error' => "Erreur email : " . $mail->ErrorInfo]);
        }

    } catch (PDOException $e) {
        echo json_encode(['error' => 'Erreur DB : ' . $e->getMessage()]);
    }
}
?>
