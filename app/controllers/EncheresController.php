<?php
include_once __DIR__ . "/../core/Database.class.php";
include_once __DIR__ . "/../models/EncheresModel.php"; // Modèle Enchere
include_once __DIR__ . "/../views/DetailsView.php";


class EncheresController
{


    public function render()
    {
        /*Définition des variable pour récupérer l'id du post en méthode GET  */
        $key = $_GET["id"];
        $id_produit = $_GET['id'];
        /* Création de la connexion vers la base de données */
        $dbh = Database::createDBConnection();
        /* appel des fonction static du model pour les attribuer a nos tableau  */
        $encheres = EncheresModel::fetchEncheres($dbh, $id_produit);
        $posts = ProductModel::fetchPostsById($dbh, $key);

        $encheres_view = new DetailsView($posts, null, $encheres); // Création d'une instance
        $encheres_view->render(); // Appel de la méthode de rendu (affichage)

    }


    public function process_encheres()
    {
        /* Création de la connexion vers la base de données */
        $dbh = DataBase::CreateDBConnection();
        /*récupération des donnée renvoyé par le formulaire de la view pourles transmettre à notre modele */
        if (!empty($_SESSION['id'])) {
            $encheres = new EncheresModel(null, null, null, null, null, null, $_GET['id'], $_SESSION['id'], $_POST['enchere'], $dbh);

            $result = $encheres->insert();
            //self call de la fonction render pour affichage propre après submit du form
            self::render();
        } else {

            self::render();
        }
    }
}
