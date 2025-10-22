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
            <h2>Bienvenue à la mairie de <br/>Verdun !</h2>
        </div>

        <div class="form">
            <h1>Connexion: </h1>
<<<<<<< HEAD
            <form action="">
                <label for="email">Mail</label>
                <input type="email" name="email" id="email" class="textBox"/>
                <label for="mdp">Mot de passe</label>
                <input type="password" name="password" id="password" class="textBox"/>
=======
            <form id="loginForm" action="./connexion_process.php" method="post">
                <label for="mail">Mail</label>
                <input type="email" name="mail" id="mail" class="textBox"/>
                <label for="mdp">Mot de passe</label>
                <input type="password" name="mdp" id="password" class="textBox"/>
                <div class="buttonDiv">
                    <input type="submit" value="Connexion" class="button"/>
                </div>
>>>>>>> c96685489fd374afc145b67144eb9c9b5b5786af
            </form>
        </div>

        <div id="liens">
            <a href="./inscription.php">Pas encore inscrit ? S'inscrire</a>
        </div>
    </body>
</html>