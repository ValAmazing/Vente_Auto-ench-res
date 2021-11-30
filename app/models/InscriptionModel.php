<?php

/**
 * models/inscription.php - Modèle Contact
 * Cette classe modélise une entrée de la table users de la base de donnée.
 */

/**
 * Modèle Inscription
 */
class InscriptionModel
{

    /* Propriétés */
    protected $id;
    protected $nom;
    protected $prenom;
    protected $email;
    protected $mdp;
    protected $dbh;


    /**
     * Constructeur
     */
    public function __construct($id, $nom, $prenom, $email, $mdp, $dbh)
    {
        /* Nettoyage des données */
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
     * Insertion dans la base de données
     */
    public function insert()
    {
        //Requête SQL INSERT INTO
        $query = $this->dbh->prepare("INSERT INTO users (nom, prenom, email, mdp) VALUES (?,?,?,?)");
        return $query->execute([$this->nom, $this->prenom, $this->email, password_hash ($this->mdp, PASSWORD_BCRYPT)]);
    }

}
