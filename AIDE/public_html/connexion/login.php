<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Brillauto68</title>
    <link rel="stylesheet" href="./css/login.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200">
</head>
<body>
    <section>
        <div class="register">
            <form id="loginForm" action="./login_process.php" method="post">
                <h1>Connexion</h1>
                <label for="lname">Nom:</label>
                <input type="text" name="username" id="username" placeholder="Username" required><br>
                <label for="password">Mot de passe:</label>
                <div class="password-wrapper">
                    <input type="password" name="password" id="password" placeholder="Password" required><br>
                    <span class="toggle-password">👁️‍🗨️</span>
                </div>
                <input class="button" type="submit" value="Se Connecter">
                <a href="./register.php">Créer un compte client</a> <br>
                <a href="../index.php">Retour à l'acceuil</a>
            </form>

            <div id="successNotification" style="display:none;"></div>
            <div id="errorNotification" style="display:none;"></div>
        </div>
    </section>

    <script>
        var passwordField = document.getElementById('password');
        var togglePasswordButton = document.querySelector('.toggle-password');
      
        togglePasswordButton.addEventListener('click', function() {
          if (passwordField.type === 'password') {
            passwordField.type = 'text';
            togglePasswordButton.textContent = '👁️';
          } else {
            passwordField.type = 'password';
            togglePasswordButton.textContent = '👁️‍🗨️';
          }
          togglePasswordButton.classList.toggle('rotate');
        });
    </script>

    <script src="./js/login.js"></script>
</body>
</html>
