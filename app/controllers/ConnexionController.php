<?php

/**
 * controllers/Connexion.php - Controleur connexion
 * Ce controleur regroupe les méthodes de la page connexion.
 */

/* Namespace */

/* Imports */
include_once __DIR__ . "/../core/Database.class.php"; // Utilitaire de connexion à la base de données
include_once __DIR__ . "/../models/ConnexionModel.php"; // Modèle Contact
include_once __DIR__ . "/../views/ConnexionView.php"; // Vue CONNEXION

/**
 * Controleur connexion
 */
class ConnexionController
{

    /**
     * Affichage de la page connexion
     */
    public function render()
    {
        $connexion_view = new ConnexionView(null); // Création d'une instance
        $connexion_view->render(); // Appel de la méthode de rendu (affichage)
    }

    /**
     * Traitement du formulaire de connexion
     */
    public function process_credentials()
    {
        //Récupération des données "email" et "password" dans des variables
        $email = $_POST['email'];
        $mdp = $_POST['password'];



        // Création de la variable permettant la connexion à la base de donnée
        $dbh = Database::createDBConnection();

        //Récupération de l'utilisateur par l'email
        $user = ConnexionModel::get_by_email($dbh, $email);
        /**
         * Attribution de l'id et du nom de l'utilisateur à $_SESSION,
         * qui va nous permettre de les utiliser durant toute la navigation de l'utilisateur connecté.
         */
        $_SESSION['id'] = $user->id;
        $_SESSION['nom'] = $user->nom;


        // Affichage des conditions 
        // Si il y a bien un utilisateur et que le password saisi correspond en hash, au password en hash de la base de donnée 
        if ($user && password_verify($mdp, $user->mdp)) {
            // alors redirection vers page d'acceuil
            session_start();
            header("location:/mvc/home");
        } else {
            // sinon nouvel affichage de la page avec message erreur
            $connexion_view = new ConnexionView("Email ou mot de passe incorrect.");
            $connexion_view->render();
        }
    }
}
