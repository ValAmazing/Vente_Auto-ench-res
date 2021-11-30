<?php

/**
 * models/accueil.php - Modèle accueil
 * Cette classe modélise une entrée de la table product de la base de donnée && l'affichage des posts
 */
class ProductModel
{
    /**
     * Propriétés
     */
    protected $id;
    protected $id_owner;
    protected $prix_depart;
    protected $date_fin;
    protected $model;
    protected $marque;
    protected $puissance;
    protected $annee;
    protected $description;
    protected $titre;
    protected $dbh;


    /**
     * Constructeur
     */
    public function __construct($id, $id_owner, $prix_depart, $date_fin, $model, $marque, $puissance, $annee, $description, $titre, $dbh)
    {
        /*Nettoyage  */
        $this->id = $id;
        $this->id_owner = filter_var($id_owner, FILTER_SANITIZE_STRING);
        $this->prix_depart = filter_var($prix_depart, FILTER_SANITIZE_STRING);
        $this->date_fin = filter_var($date_fin, FILTER_SANITIZE_STRING);
        $this->model = filter_var($model, FILTER_SANITIZE_STRING);
        $this->marque = filter_var($marque, FILTER_SANITIZE_STRING);
        $this->puissance = filter_var($puissance, FILTER_SANITIZE_STRING);
        $this->annee = filter_var($annee, FILTER_SANITIZE_STRING);
        $this->description = filter_var($description, FILTER_SANITIZE_STRING);
        $this->titre = filter_var($titre, FILTER_SANITIZE_STRING);
        $this->dbh = $dbh;
    }

    /**Get */
    public function __get($property)
    {
        if ($property !== "dbh") {
            return $this->$property;
        }
    }

    /**Set */
    public function __set($property, $value)
    {
        if ($property !== "dbh") {
            $this->$property = $value;
        }
    }

    /**
     * Insertion dans la base de données product
     */
    public function insert()
    {
        //Requête SQL INSERT INTO
        $query = $this->dbh->prepare("INSERT INTO products (id_owner, prix_depart, date_fin, model, marque, puissance, annee, description, titre) VALUES (?,?,?,?,?,?,?,?,?) ");
        return $query->execute([$this->id_owner, $this->prix_depart, $this->date_fin, $this->model, $this->marque, $this->puissance, $this->annee, $this->description, $this->titre]);
    }

    /**
     * Récupération des données stockées dans la base de données
     */
    public static function fetchAllPosts($dbh)
    {
        //Requête SQL SELECT 
        $query = $dbh->prepare("SELECT * FROM products");
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_ASSOC);

        $posts = [];
        //parcours du tableau pour insérer les données retourné par la base de données dans un array
        foreach ($results as $result) {
            array_push($posts, new ProductModel($result['id'], $result['id_owner'], $result['prix_depart'], $result['date_fin'], $result['model'], $result['marque'], $result['puissance'], $result['annee'], $result['description'], $result['titre'], $dbh));
        }

        return $posts;
    }

    /**
     * Récupération des posts par id
     */
    public static function fetchPostsById($dbh)
    {
        //Requête SQL SELECT
        $query = $dbh->prepare("SELECT * FROM products WHERE id=?");
        $query->execute([$_GET['id']]);
        $posts = $query->fetch();

        //si le post n'existe pas en BDD le requête échoue. 
        if (!$posts) {
            return false;
        }
        //Sinon création d'une instance avec les données de la BDD
        return new ProductModel($_GET['id'], $posts['id_owner'], $posts['prix_depart'], $posts['date_fin'], $posts['model'], $posts['marque'], $posts['puissance'], $posts['annee'], $posts['description'], $posts['titre'], $dbh);
    }
    /**
     * Récupération des posts par id_owner pour affichage page profil
     */
    public static function fetchPersonalPost($dbh)
    {
        //Requête SQL SELECT
        $query = $dbh->prepare("SELECT * FROM products WHERE id_owner=?");
        $query->execute([$_SESSION['id']]);
        $resuls = $query->fetchAll(PDO::FETCH_ASSOC);

        $profilPosts = [];
        //parcours du tableau pour insérer les données retourné par la base de données dans un array
        foreach ($resuls as $resul) {
            array_push($profilPosts, new ProductModel($resul['id'], $_SESSION['id'], $resul['prix_depart'], $resul['date_fin'], $resul['model'], $resul['marque'], $resul['puissance'], $resul['annee'], $resul['description'], $resul['titre'], $dbh));
        }

        return $profilPosts;
    }
}
