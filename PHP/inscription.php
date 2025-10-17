<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Connexion</title>
        <link rel="stylesheet" href="../CSS/connexion_inscription.css">
    </head>
    <body>
        <div class="head">
            <img src="IMG/drapeau_de_lorraine.png" alt="Drapeau de la Lorraine" id="logoLorraine"/>
            <div id="headLogo">
                <img src="IMG/logo_republique_francaise.png" alt="Logo de la république"/>
                <img src="IMG/logo.png" alt="Logo du site" id="logo"/>
            </div>
            <h2>Bienvenue à la mairie de <br/>Pont-à-Mousson !</h2>
        </div>

        <div class="form">
            <h1>Inscription: </h1>
            <form action="">
                <div class="infos">
                    <div class="divInfos">
                        <label for="nom">Nom</label>
                        <input type="text" name="nom" id="nom" class="textBox"/>
                    </div>
                    <div class="divInfos">
                        <label for="prenom">Prénom</label>
                        <input type="text" name="prenom" id="prenom" class="textBox"/>
                    </div>
                </div>
                <label for="adresse">Adresse</label>
                <input type="text" name="adresse" id="adresse" class="textBox"/>
                <label for="mail">Mail</label>
                <input type="email" name="mail" id="mail" class="textBox"/>
                <label for="mdp">Mot de passe</label>
                <input type="password" name="mdp" id="mdp" class="textBox"/>
            </form>
        </div>
        <div class="buttonDiv">
            <input type="button" value="Inscription" class="button"/>
        </div>
    </body>
</html>