<?php

class User
{

    private $id_;
    private $nom_;
    private $email_;
    private $password_;

    public function __construct($id, $nom, $email)
    {
        $this->id_ = $id;
        $this->nom_ = $nom;
        $this->email_ = $email;
    }

    //fonction pour se connecter à un utilisateur en fonction du nom et prenom
    public function seConnecter($login, $pass)
    {

        //$newpass = hash('sha256', $pass);
        //$newpass = password_verify($pass, PASSWORD_DEFAULT);
        $requete = "SELECT * FROM `user` 
        WHERE
        `email` = '" . $login . "'
        AND
        `password` = '" . $pass . "' ;";

        $result = $GLOBALS["pdo"]->query($requete);
        if ($result->rowCount() > 0) {
            $tab = $result->fetch();
            $_SESSION['Connexion'] = true;
            $_SESSION['id'] = $tab['id'];

            $this->id_ = $tab['id'];
            $this->nom_ = $tab['nom'];
            $this->email_ = $tab['email'];


            return true;
        } else {
            return false;
        }
    }
}
