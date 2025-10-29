<?php
    include "./config.php";
    session_start();

    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    try {
    // Préparer la requête pour récupérer l'utilisateur par email ou username
    $stmt = $pdo->prepare("SELECT id, password, name, surname, isadmin FROM users WHERE email = ?");
    $stmt->execute([$email]);

    // Vérifier si l'utilisateur existe
    if ($stmt->rowCount() === 1) {
        $user = $stmt->fetch(PDO::FETCH_ASSOC); // tableau associatif

        // Vérifier le mot de passe
        if (password_verify($password, $user['password'])) {
            // Mot de passe correct : créer la session
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['email'] = $email;
            $_SESSION['name'] = $user['name'];
            $_SESSION['surname'] = $user['surname'];
            $_SESSION['admin'] = $user['isadmin'];

            header("Location: ../index.php");
            exit;
        } else {
            http_response_code(401);
            echo "error:Mot de passe incorrect.";
        }
    } else {
        http_response_code(401);
        echo "error:Nom d'utilisateur introuvable.";
    }

} catch (PDOException $e) {
    http_response_code(500);
    echo "error:Erreur lors de la connexion : " . $e->getMessage();
}
?>