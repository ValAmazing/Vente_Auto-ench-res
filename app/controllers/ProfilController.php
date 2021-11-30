<?php

include_once __DIR__ . "/../core/Database.class.php";
include_once __DIR__ . "/../models/ProfilModel.php"; 
include_once __DIR__ . "/../views/ProfilView.php";


class ProfilController
{

    public function render()
    {    /* Création de la connexion vers la base de données */
        $dbh = Database::createDBConnection();
        /* appel des fonction static du model pour les attribuer a nos tableau  */
        $posts = ProfilModel::fetchProfil($dbh);
        $profilPosts = ProductModel::fetchPersonalPost($dbh);

        $profil_view = new ProfilView (null,$posts,$profilPosts); // Création d'une instance
        $profil_view-> render(); // Appel de la méthode de rendu (affichage)
      

    }

   

    public function process_update_profil()
{
    /* Création de la connexion vers la base de données */
    $dbh = Database::createDBConnection();
    /*instanciation de l'objet ProfilModel et récupération des donnée renvoyé par le formulaire de la view pourles transmettre à notre modele */
    $profil = new ProfilModel (null, $_POST["nom"], $_POST["prenom"], $_POST["email"], $_POST["mdp"], $dbh);
    /* appel de la méthode update qui vient du model */
    $result = $profil ->update();

    $profil_view = new ProfilView ($result,null,null); // Création d'une instance
    $profil_view -> render(); // Appel de la méthode de rendu (affichage)
    header('location:/mvc/profil'); //redirection vers la page profil de l'utilisateur pour afficher sa modification visuellement
    
}

}
?>