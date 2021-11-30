<?php 
include_once __DIR__ . "/../core/Database.class.php";
include_once __DIR__ . "/../models/InscriptionModel.php"; // Modèle Contact
include_once __DIR__ . "/../views/InscriptionView.php";


class InscriptionController {


    public function render()
    {
        $inscription_view = new InscriptionView(null); // Création d'une instance
        $inscription_view->render(); // Appel de la méthode de rendu (affichage)
    }


    public function process_inscription_form()
    {
        /**
         * Validation des données
         */

        /* Cette variable indique si les données sont validées */
        $data_validated = true;

        /* Validation de l'adresse email */
        if (filter_var($_POST["email"], FILTER_VALIDATE_EMAIL) === false) {
            $data_validated = false; // Insertion impossible car email invalide
        }


        if ($data_validated) {

            /* Création de la connexion vers la base de données */
            $dbh = Database::createDBConnection();

            /* Création d'un nouvel objet contact à partir du modèle */
            $inscription = new InscriptionModel(null, $_POST["nom"], $_POST["prenom"], $_POST["email"], $_POST["mdp"], $dbh);

            /* Insertion en base de données */
            $result = $inscription->insert();
        }

        $inscription_view = new InscriptionView($result); // création d'une instance
        $inscription_view->render(); // appel de la méthode d'affichage
    
}
}

?>