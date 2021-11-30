<?php

/**
 * models/encheres.php -  Connexion
 * Cette classe modélise une entrée de la table connexion de la base de donnée.
 */

class EncheresModel
{
    /**
     * Propriétés
     */
    public $id;
    public $nom;
    public $prenom;
    public $email;
    public $mdp;
    public $id2;
    public $id_produit;
    public $id_user;
    public $montant_enchere;
    public $dbh;

    /**
     * Constructeur
     */
    public function __construct($id, $nom, $prenom, $email, $mdp, $id2, $id_produit, $id_user, $montant_enchere, $dbh)
    {

        /**
         * Données du construct
         */
        $this->id = $id;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->email = $email;
        $this->mdp = $mdp;
        $this->id2 = $id2;
        $this->id_produit = $id_produit;
        $this->id_user = $id_user;
        $this->montant_enchere = filter_var($montant_enchere, FILTER_SANITIZE_STRING); // Nettoyage données
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
     * Method insert qui ajoute une enchère dans la BDD
     */
    public function insert()
    {
        //Requête SQL INSERT INTO
        $query = $this->dbh->prepare("INSERT INTO encheres (id_produit, id_user, montant_enchere) VALUES (?,?,?)");
        return $query->execute([$_GET['id'], $_SESSION['id'], $this->montant_enchere]);
    }
    /**
     * Jointure pour récupérer les enchères par produits et par Utilisateurs
     */
    public static function fetchEncheres($dbh)
    {
        //Requêtes SQL INNERJOIN 
        $query = $dbh->prepare("SELECT  encheres.*, users.*, products.* FROM encheres INNER JOIN users ON users.id = encheres.id_user INNER JOIN products ON products.id = encheres.id_produit WHERE id_produit=?");
        $query->execute([$_GET['id']]);
        $results = $query->fetchAll(PDO::FETCH_ASSOC);

        $encheres = [];

        //parcours du tableau pour insérer les données retourné par la base de données dans un array
        foreach ($results as $result) {
            array_push($encheres, new EncheresModel($result['id'], $result['nom'], $result['prenom'], $result['email'], $result['mdp'], $result['id'], $result['id_produit'], $result['id_user'], $result['montant_enchere'], $dbh));
        }
        return $encheres;
    }
}
