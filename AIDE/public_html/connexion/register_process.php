<?php
session_start();

define('ENCRYPTION_KEY', 'BrillAuto68SuperKeyAES256!!'); // 32 caractères
define('ENCRYPTION_IV', 'BrillAutoInitVect');            // 16 caractères

function encryptPassword($password) {
    return openssl_encrypt($password, 'AES-256-CBC', ENCRYPTION_KEY, 0, ENCRYPTION_IV);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = new mysqli("127.0.0.1", "", "", "");

    if ($conn->connect_error) {
        http_response_code(500);
        echo "error:Erreur de connexion à la base de données.";
        exit();
    }

    $username = trim($_POST['username']);
    $password = encryptPassword(trim($_POST['password']));
    $firstname = trim($_POST['firstname']);
    $lastname = trim($_POST['lastname']);
    $email = trim($_POST['email']);

    // Vérification si l'utilisateur existe
    $stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        http_response_code(400);
        echo "error:Nom d'utilisateur déjà utilisé.";
    } else {
        $stmt = $conn->prepare("INSERT INTO users (username, password, firstname, lastname, email) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $username, $password, $firstname, $lastname, $email);

        if ($stmt->execute()) {
            $_SESSION['username'] = $username;
            echo "success:/dashboard.php"; // ou une autre page après inscription
        } else {
            http_response_code(500);
            echo "error:Erreur lors de l'inscription.";
        }
    }

    $stmt->close();
    $conn->close();
}
?>
