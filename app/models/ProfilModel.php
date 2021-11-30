<?php


class ProfilModel
{
    /**
     * Propriétés
     */
    public $id;
    public $nom;
    public $prenom;
    public $email;
    public $mdp;
    public $dbh;



    /**
     * Contructeur
     */
    public function __construct($id, $nom, $prenom, $email, $mdp, $dbh)

    {
        /**
         * Nettoyage
         */
        $this->id = $id;
        $this->nom = filter_var($nom, FILTER_SANITIZE_STRING);
        $this->prenom = filter_var($prenom, FILTER_SANITIZE_STRING);
        $this->email = filter_var($email, FILTER_SANITIZE_STRING);
        $this->mdp = filter_var($mdp, FILTER_SANITIZE_STRING);
        $this->dbh = $dbh;
    }

    /**
     * Get
     */
    public function __get($property)
    {
        if ($property !== "dbh") {
            return $this->$property;
        }
    }

    /**
     * Set
     */
    public function __set($property, $value)
    {
        if ($property !== "dbh") {
            $this->$property = $value;
        }
    }

    /**
     * Récupération des données utilisateur grâce à son id stocké dans $_SESSION
     */
    public static function fetchProfil($dbh)
    {
        //Requête SQL SELECT
        $query = $dbh->prepare("SELECT * FROM users WHERE id=?");
        $query->execute([$_SESSION['id']]);
        $posts = $query->fetch();

        //Création d'une instance avec les données de la BDD
        return new ProfilModel($_SESSION['id'], $posts['nom'], $posts['prenom'], $posts['email'], $posts['mdp'], $dbh);
    }

    /**
     * Modification du profil utilisateur grâce à son id stocké dans $_SESSION
     */
    public function update()
    {
        //Requête SQL UPDATE
        $query = $this->dbh->prepare("UPDATE users SET nom=?,prenom=?,email=?,mdp=? WHERE id=?");
        return $query->execute([$this->nom, $this->prenom, $this->email, password_hash($this->mdp, PASSWORD_BCRYPT), $_SESSION['id']]);
    }
}
