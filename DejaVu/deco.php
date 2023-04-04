<?php
session_start(); // Démarrer la session si elle n'a pas encore été démarrée

// Détruire toutes les variables de session
$_SESSION = array();

// Supprimer le cookie de session
if (isset($_COOKIE[session_name()])) {
    setcookie(session_name(), '', time() - 42000, '/');
}

// Détruire la session
session_destroy();

// Rediriger l'utilisateur vers la page de connexion
header('Location: index.php');
exit;
?>