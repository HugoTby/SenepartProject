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
    public function seConnecter($email, $pass)
    {

        //$newpass = hash('sha256', $pass);
        //$newpass = password_verify($pass, PASSWORD_DEFAULT);
        $requete = "SELECT * FROM `user` 
        WHERE
        `email` = '" . $email . "'
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

    public function CreateNewUser($email, $pass, $nom)
    {
        $requete = "SELECT * FROM user 
        WHERE
        `email` = '" . $email . "';";
        $result = $GLOBALS["pdo"]->query($requete);
        if ($result->rowCount() > 0) {
            $tab = $result->fetch();
            $this->id_ = $tab['id'];
            $this->nom_ = $tab['nom'];
            $this->email_ = $tab['mail'];
        } else {
            $requete = "INSERT INTO `user`(`nom`, `email`, `password`) 
            VALUES('$nom', '$email','$pass');";
            $result = $GLOBALS["pdo"]->query($requete);
            $this->id_ = $GLOBALS["pdo"]->lastInsertId();
            $this->nom_ = $nom;
            $this->email_ = $email;
            $this->seConnecter($email, $pass);
        }
    }

    public function isConnect()
    {
        if (isset($_SESSION['id'])) {
            $sql = "SELECT * FROM `user` 
            WHERE `id` = '" . $_SESSION['id'] . "'";
            $resultat = $GLOBALS["pdo"]->query($sql);
            if ($tab = $resultat->fetch()) {
                $this->email_ = $tab['email'];
                $this->id_ = $tab['id'];
                return true;
            }
        } else {
            return false;
        }
    }
}
