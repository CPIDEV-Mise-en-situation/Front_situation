<?php
    include "./config.php";
    session_start();

    $mail = trim($_POST['mail']);
    $password = trim($_POST['password']);

    $stmt = $conn->prepare("SELECT id, mail, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $mail);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows === 1) {
        $stmt->bind_result($id, $user, $password);
        $stmt->fetch();

        $decryptedPassword = password_verify($password, $user['password']);

        if (trim($decryptedPassword) === trim($password)) {
            $_SESSION['id'] = $id;
            $_SESSION['mail'] = $user;
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
?>