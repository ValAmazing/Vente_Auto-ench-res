<?php

/**
 * controllers/NotFound.php - Controleur NotFound
 * Ce contrôleur contient une unique méthode appelée lors qu'aucune route ne correspond.
 * Il affiche alors une page d'erreur avec un code de réponse 404.
 */

/* Namespace */

/* Imports */
include_once __DIR__ . "/../views/NotFoundView.php";


/**
 * Controleur NotFound
 */
class NotFoundController
{

    /**
     * Affichage de la page par défaut
     */
    public function render()
    {
        http_response_code(404); // Code de réponse 404
        $not_found_view = new NotFoundView(null); // Création d'une instance
        $not_found_view->render(); // Appel de la méthode de rendu (affichage)
    }
}
