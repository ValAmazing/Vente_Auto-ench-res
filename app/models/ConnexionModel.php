<?php

/**
 * models/connexion.php -  Connexion
 * Cette classe modélise une entrée de la table connexion de la base de donnée.
 */

/**
 * Modèle Contact
 */
class ConnexionModel
{

    /* Propriétés */
    public $id;
    protected $email;
    public $mdp;
    public $nom;
    protected $dbh;


    /**
     * Constructeur
     */
    public function __construct($id, $email, $mdp, $nom, $dbh)
    {
        /* Nettoyage des données */
        $this->id = $id;
        $this->email = filter_var($email, FILTER_SANITIZE_STRING);
        $this->mdp = filter_var($mdp, FILTER_SANITIZE_STRING);
        $this->nom = $nom;
        $this->dbh = $dbh;
    }


    /**
     * Récupération de contact par email
     */
    public static function get_by_email($dbh, $email)
    {
        //Requête à la base de données pour récupérer dans la table users les utilisateurs par leur mail. 
        $query = $dbh->prepare("SELECT * FROM users WHERE email=?");
        $query->execute([$email]);
        $user = $query->fetch();

        //si l'utilisateur n'existe pas en BDD le requête échoue. 
        if (!$user) {
            return false;
        }
        //Sinon création d'une instance avec les données de la BDD
        return new ConnexionModel($user['id'], $user['email'], $user['mdp'], $user['nom'], $dbh);
    }
}
