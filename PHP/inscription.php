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
                <img src="../IMG/logoVerdun.jpg" alt="Logo du site" id="logo"/>
            </div>
            <h2>Bienvenue à la mairie de <br/>Verdun !</h2>
        </div>

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

        <div id="liens">
            <a href="./connexion.php">Déjà inscrit ? Connexion</a>
        </div>
    </body>
</html>