<?php
    session_start();
    session_unset(); // supprime toutes les variables de session
    session_destroy(); // détruit la session
    header("Location:  /mairie/PHP/connexion.php"); // redirection après déconnexion
exit
?>