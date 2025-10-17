<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="./css/register.css">
    <meta charset="UTF-8">
    <title>Register</title>
</head>
<body>
    <section>
        <div class="register">
            <div id="successNotification" class="notification success" style="display:none;"></div>
            <div id="errorNotification" class="notification error" style="display:none;"></div>
            <form id="registerForm" action="register_process.php" method="post">
                <h1>Inscription</h1>
                <label for="lname">🪪 Nom:</label>
                <input type="text" name="lastname" placeholder="Nom" required><br>
                <label for="fname">🪪 Prénom:</label>
                <input type="text" name="firstname" placeholder="Prénom" required><br>
                <label for="email">📧 E-mail:</label>
                <input type="email" name="email" placeholder="E-mail" required><br>
                <label for="lname">🪪 Username:</label>
                <input type="text" name="username" id="username" placeholder="Username" required><br>
                <label for="password">🔑 Mot de passe:</label>
                <div class="password-wrapper">
                    <input type="password" id="password" name="password" placeholder="Password" required><br>
                    <span class="toggle-password">👁️‍🗨️</span>
                </div>  
                <input class="button" type="submit" value="S'inscrire">
                <a href="./login.php">🤔 Déjà inscrit ?</a><br>
                <a href="../index.php">↩️ Retour à l'acceuil</a>
            </form> 
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

    <script src="./js/register.js"></script>
</body>
</html>
