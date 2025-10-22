<?php
    include "./config.php";
    session_start();

<<<<<<< HEAD
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
            $_SESSION['user_id'] = $id;
            $_SESSION['mail'] = $user;
            echo "success:/index.php"; // ou autre redirection
=======
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    try {
    // Préparer la requête pour récupérer l'utilisateur par email ou username
    $stmt = $pdo->prepare("SELECT id, password FROM users WHERE email = ?");
    $stmt->execute([$email]);

    // Vérifier si l'utilisateur existe
    if ($stmt->rowCount() === 1) {
        $user = $stmt->fetch(PDO::FETCH_ASSOC); // tableau associatif

        // Vérifier le mot de passe
        if (password_verify($password, $user['password'])) {
            // Mot de passe correct : créer la session
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['mail'] = $email;

            header("Location: ../index.php");
            exit;
>>>>>>> Elodie
        } else {
            http_response_code(401);
            echo "error:Mot de passe incorrect.";
        }
    } else {
        http_response_code(401);
        echo "error:Nom d'utilisateur introuvable.";
    }

<<<<<<< HEAD
    $stmt->close();
    $conn->close();
=======
} catch (PDOException $e) {
    http_response_code(500);
    echo "error:Erreur lors de la connexion : " . $e->getMessage();
}
>>>>>>> Elodie
?>