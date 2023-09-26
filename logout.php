<?php
// Démarrage de la session
session_start();

// Destruction de la session
session_destroy();

// Si vous utilisez des cookies pour mémoriser des informations de connexion, supprimez-les également
if (isset($_COOKIE['nom_du_cookie'])) {
    setcookie('nom_du_cookie', '', time() - 3600); // Supprime le cookie
}

// Rediriger l'utilisateur vers la page d'accueil ou de connexion
header("Location: index.php");
exit;
?>
