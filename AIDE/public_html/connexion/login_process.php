<?php
session_start();

define('ENCRYPTION_KEY', 'BrillAuto68SuperKeyAES256!!'); // 32 caractères
define('ENCRYPTION_IV', 'BrillAutoInitVect');            // 16 caractères

function decryptPassword($encryptedPassword) {
    return openssl_decrypt($encryptedPassword, 'AES-256-CBC', ENCRYPTION_KEY, 0, ENCRYPTION_IV);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = new mysqli("127.0.0.1", "", "", "");

    if ($conn->connect_error) {
        http_response_code(500);
        echo "error:Erreur de connexion à la base de données.";
        exit();
    }

    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    $stmt = $conn->prepare("SELECT id, username, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows === 1) {
        $stmt->bind_result($id, $user, $encryptedPassword);
        $stmt->fetch();

        $decryptedPassword = decryptPassword($encryptedPassword);

        if (trim($decryptedPassword) === trim($password)) {
            $_SESSION['user_id'] = $id;
            $_SESSION['username'] = $user;
            echo "success:/index.php"; // ou autre redirection
        } else {
            http_response_code(401);
            echo "error:Mot de passe incorrect.";
        }
    } else {
        http_response_code(401);
        echo "error:Nom d'utilisateur introuvable.";
    }

    $stmt->close();
    $conn->close();
}
?>
