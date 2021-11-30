<?php
    include_once __DIR__ . "/../core/Database.class.php"; //import database
    include_once __DIR__ . "/../models/ProductsModel.php"; //import product model
    include_once __DIR__ . "/../views/AccueilView.php"; // import product view
    include_once __DIR__ . "/../views/DetailsView.php";
    include_once __DIR__ . "/../views/ProfilView.php";


    class ProductsController
    {
        public function render() // Création de la fonction de rendu 
        {
            
            $dbh = Database::createDBConnection(); //appel de la data base
            $posts = ProductModel::fetchAllPosts($dbh); // 
            $accueil_view = new ProductView($posts,null); // Création d'une instance
            $accueil_view->render(); // appel de la fonction de rendu 
            
        }

        public function process_post_annonce() // création de la fonction de post des annonces
        {

            $dbh = Database::createDBConnection(); // appel de la data base

            /**Création d'une instance avec la récupération des données des inputs */
            $accueil_controller = new ProductModel(null, $_SESSION['id'], $_POST['prix_depart'], $_POST['date_fin'], $_POST['model'], $_POST['marque'], $_POST['puissance'], $_POST['annee'], $_POST['description'],$_POST['titre'],$dbh);

            /**Insertion des données dans la base de donnée */
            $result = $accueil_controller->insert();
        

        $accueil_view = new ProductView(null,$result);// Création d'une instance
        $accueil_view->render();// appel de la focntion de rendu 
        header('location:/mvc/home');
    }

    

    
}
?>