<?php

session_start();

//api pour modifier le nom et mail du user
try {
    $GLOBALS["pdo"] = new PDO('mysql:host=192.168.64.213;dbname=Lawrence', 'root', 'root');
    $id_utilisateur = $_SESSION['id'];

    // Récupérer le nouveau nom d'utilisateur depuis la requête POST
    $nouveauNom = $_POST['nouveauNom'];
    $nouveauEmail = $_POST['nouveauEmail'];

    // Mettre à jour le nom d'utilisateur dans la base de données
    if ($nouveauNom != NULL) {
        $query = "UPDATE user SET nom = '{$nouveauNom}' WHERE id = {$id_utilisateur}";
        $result = $GLOBALS["pdo"]->query($query);
    } else if ($nouveauEmail != NULL) {
        $query = "UPDATE user SET email = '{$nouveauEmail}' WHERE id = {$id_utilisateur}";
        $result = $GLOBALS["pdo"]->query($query);
    }

    // Vous devez définir $id_utilisateur avec l'ID de l'utilisateur dont vous souhaitez mettre à jour le nom
    // Par exemple, si vous avez une session d'utilisateur connecté, vous pouvez obtenir l'ID de l'utilisateur à partir de là


    echo "Mise à jour du nom d'utilisateur réussie";
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}

// Fermer la connexion à la base de données
$conn = null;
