document.getElementById("registerForm").addEventListener("submit", function(event) {
    event.preventDefault(); // Empêcher la soumission par défaut du formulaire

    var formData = new FormData(this); // Récupérer les données du formulaire
    var successNotification = document.getElementById("successNotification");
    var errorNotification = document.getElementById("errorNotification");

    // Effacer les notifications actuelles
    successNotification.textContent = "";
    errorNotification.textContent = "";
    successNotification.style.display = "none";
    errorNotification.style.display = "none";

    var xhr = new XMLHttpRequest();
    xhr.open("POST", "register_process.php", true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                if (xhr.responseText.trim() === "success") {
                    successNotification.textContent = "🔔 |  ✅ Inscription réussie!";
                    successNotification.style.display = "block";
                    setTimeout(function() {
                        window.location.href = "./login.php";
                    }, 2000); // Rediriger vers la page de connexion après 2 secondes
                } else {
                    errorNotification.textContent = xhr.responseText; // Afficher le message d'erreur
                    errorNotification.style.display = "block";
                    setTimeout(function() {
                        errorNotification.style.display = "none";
                    }, 10000); // Afficher la notification d'erreur pendant 10 secondes
                }
            } else if (xhr.status === 400) {
                errorNotification.textContent = "🔔 |  ❌ Ce nom d'utilisateur est déjà pris."; // Afficher une notification en cas d'erreur HTTP 400
                errorNotification.style.display = "block";
                document.getElementById("errorNotification").style.backgroundColor = "#f8d7da";
                document.getElementById("errorNotification").style.color = "#721c24";
                document.getElementById("errorNotification").style.padding = "10px";
                document.getElementById("errorNotification").style.borderRadius = "4px";
                document.getElementById("errorNotification").style.marginBottom = "10px";
                setTimeout(function() {
                    errorNotification.style.display = "none";
                }, 10000); // Afficher la notification d'erreur pendant 10 secondes
            }
        }
    };
    xhr.send(formData);
});