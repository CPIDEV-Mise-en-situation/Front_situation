<?php
    session_start();
    session_unset(); // supprime toutes les variables de session
    session_destroy(); // détruit la session
    header("Location: /Front_situation/index.php"); // redirection après déconnexion
    exit;
?>