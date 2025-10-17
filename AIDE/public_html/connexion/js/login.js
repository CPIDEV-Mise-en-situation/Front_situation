document.getElementById("loginForm").addEventListener("submit", function(event) {
    event.preventDefault();

    var formData = new FormData(this);
    var successNotification = document.getElementById("successNotification");
    var errorNotification = document.getElementById("errorNotification");

    successNotification.textContent = "";
    errorNotification.textContent = "";

    var xhr = new XMLHttpRequest();
    xhr.open("POST", "login_process.php", true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            console.log("Réponse du serveur: " + xhr.responseText);

            if (xhr.status === 200) {
                var response = xhr.responseText;
                if (response.startsWith("success:")) {
                    var redirectPath = response.split(":")[1];

                    successNotification.textContent = "🔔 | ✅ Connexion réussie!";
                    successNotification.style.display = "block";
                    successNotification.style.backgroundColor = "#d4edda";
                    successNotification.style.color = "#155724";
                    successNotification.style.padding = "10px";
                    successNotification.style.borderRadius = "4px";
                    successNotification.style.marginBottom = "10px";

                    setTimeout(function() {
                        successNotification.style.display = "none";
                        window.location.href = redirectPath;
                    }, 2000);
                } else if (response.startsWith("error:")) {
                    var errorMessage = response.split(":")[1];

                    errorNotification.textContent = errorMessage;
                    errorNotification.style.display = "block";
                    errorNotification.style.backgroundColor = "#f8d7da";
                    errorNotification.style.color = "#721c24";
                    errorNotification.style.padding = "10px";
                    errorNotification.style.borderRadius = "4px";
                    errorNotification.style.marginBottom = "10px";

                    setTimeout(function() {
                        errorNotification.style.display = "none";
                    }, 10000);
                }
            } else {
                errorNotification.textContent = "Une erreur est survenue lors de la connexion.";
                errorNotification.style.display = "block";
                setTimeout(function() {
                    errorNotification.style.display = "none";
                }, 10000);
            }
        }
    };
    xhr.send(formData);
});
