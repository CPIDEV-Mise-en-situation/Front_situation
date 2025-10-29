<?php
require_once __DIR__ . '/config.php';
session_start();

$success = "";
$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['nom']);
    $surname = trim($_POST['prenom']);
    $location = trim($_POST['adresse']);
    $email = filter_var(trim($_POST['mail']), FILTER_VALIDATE_EMAIL);
    $password = trim($_POST['mdp']);

    if (!$email || empty($password) || empty($name) || empty($surname) || empty($location)) {
        $error = "Tous les champs sont obligatoires.";
    } else {
        // Vérifier si l'utilisateur existe déjà
        $stmt = $pdo->prepare("SELECT id FROM users WHERE email = :email");
        $stmt->execute(['email' => $email]);

        if ($stmt->fetch()) {
            $error = "Cet email est déjà utilisé.";
        } else {
            // Hash du mot de passe
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // Insertion de l'utilisateur
            $stmt = $pdo->prepare("
                INSERT INTO users (name, surname, location, email, password, isadmin)
                VALUES (:name, :surname, :location, :email, :password, 0)
            ");

            $successInsert = $stmt->execute([
                'name' => $name,
                'surname' => $surname,
                'location' => $location,
                'email' => $email,
                'password' => $hashedPassword
            ]);

            if ($successInsert) {
                // Connexion immédiate après inscription (optionnel)
                $_SESSION['id'] = $pdo->lastInsertId();
                $_SESSION['name'] = $name;
                $_SESSION['surname'] = $surname;
                $_SESSION['email'] = $email;
                $_SESSION['location'] = $location;
                $_SESSION['isadmin'] = 0;

                // Redirection
                header('Location: ../index.php');
                exit;
            } else {
                $error = "Une erreur est survenue lors de l'inscription.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Connexion</title>
        <link rel="stylesheet" href="../CSS/connexion-inscription.css">
    </head>
    <body>
        <div class="head">
            <img src="../IMG/drapeau_de_lorraine.png" alt="Drapeau de la Lorraine" id="logoLorraine"/>
            <div id="headLogo">
                <img src="../IMG/logo_republique_francaise.png" alt="Logo de la république"/>
                <img src="../IMG/logo.png" alt="Logo du site" id="logo"/>
            </div>
            <label for="adresse">Adresse</label>
            <input type="text" name="adresse" id="adresse" class="textBox" required />
            <label for="mail">Mail</label>
            <input type="email" name="mail" id="mail" class="textBox" required />
            <label for="mdp">Mot de passe</label>
            <input type="password" name="mdp" id="password" class="textBox" required />
            <div class="buttonDiv">
                <input type="submit" value="Inscription" class="button" />
            </div>
        </form>

        <div class="form">
            <h1>Inscription: </h1>
            <form id="inscriptionForm" action="./inscription_process" method="post">
                <div class="infos">
                    <div class="divInfos">
                        <label for="name">Nom</label>
                        <input type="text" name="name" id="name" class="textBox" required/>
                    </div>
                    <div class="divInfos">
                        <label for="surname">Prénom</label>
                        <input type="text" name="surname" id="surname" class="textBox" required/>
                    </div>
                </div>
                <label for="location">Adresse</label>
                <input type="text" name="location" id="location" class="textBox" required/>
                <label for="email">Mail</label>
                <input type="email" name="email" id="email" class="textBox" required/>
                <label for="password">Mot de passe</label>
                <input type="password" name="password" id="password" class="textBox" required/>
                <div class="buttonDiv">
                    <input type="submit" value="Inscription" class="button"/>
                </div>
            </form>
        </div>

