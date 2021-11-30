<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

/**
 * index.php - Point d'entrée de l'application
 * Ce fichier défini les routes et les méthodes des controleurs qui dervont être appelées
 */

/* Imports */
require_once __DIR__ . "/core/Router.class.php"; // Routeur 
include_once __DIR__ . "/controllers/NotFoundController.php"; // Controlleur NotFound
include_once __DIR__ . "/controllers/ConnexionController.php"; //Controller Connexion
include_once __DIR__ . "/controllers/EncheresController.php"; //Controller Encheres
include_once __DIR__ . "/controllers/AccueilController.php"; //Controller Accueil
include_once __DIR__ . "/controllers/ProfilController.php"; //Controller Profil
include_once __DIR__ . "/controllers/InscriptionController.php"; //Controller Inscription




/*********************/
/*      Requête      */
/*********************/
$method = $_SERVER['REQUEST_METHOD']; // Récupération du verbe
$uri = $_GET['uri']; // Récuépération de l'URI



/*********************/
/*       Router      */
/*********************/

/* Création du routeur */
$router = new Router($uri, $method);



/*********************/
/*       Routes      */
/*********************/

/**Création des Routes */
$connexionController = new ConnexionController();
$inscriptionController = new InscriptionController();
$encheresController = new EncheresController();
$profilController = new ProfilController();
$productsController = new ProductsController();

/*** Home ***/
$router->get("/home", [$productsController, 'render']);
$router->post("/home", [$productsController, 'process_post_annonce']);

/***Details ***/
$router->get("/details", [$encheresController, 'render']);
$router->post("/details", [$encheresController, 'process_encheres']);
$router->get("/details", [$productsController, 'render']);


/***Profil ***/
$router->post("/profil", [$profilController, 'process_update_profil']);
$router->get("/profil", [$profilController, 'render']);

/***Connexion ***/
$router->post("/connexion", [$connexionController, 'process_credentials']);
$router->get("/connexion", [$connexionController, 'render']);

/***Inscription ***/
$router->get("/inscription",  [$inscriptionController, 'render']);
$router->post("/inscription", [$inscriptionController, 'process_inscription_form']);

/*** Route par défaut ***/
$router->default([new NotFoundController(), 'render']);
/*********************/



/***************************************/
/* Recherche de routes correspondantes */
/***************************************/

/* Démarrage du routeur */
$router->start();
