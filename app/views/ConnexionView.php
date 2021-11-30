<?php


/**
 * views/Connexion.php - ConnexionView
 * Cette vue permet d'afficher la page de connexion.
 */


include_once __DIR__ . "/../views/AbstractView.php";

/**
 * Vue Home
 */
class ConnexionView extends AbstractView
{
    /* Propriétés */
    protected $message; // 

    /**
     * Contructeur
     * Ce constructeur prend en paramètre une valeur booléenne contenant le résultat du traitement
     * des informations du formulaire de connexion. 
     * 
     */
    public function __construct($message)
    {


        $this->message = $message; // Assignation de la valeur du message dans la propriété message
    }


    /**
     * Affichage de la page de connexion
     */
    public function render()
    { ?>

        <!DOCTYPE html>
        <html>

        <head>
            <meta charset="utf-8">
            <title>Boilerplate MVC PHP</title>
            <link rel="stylesheet" type="text/css" href="assets/styles/styles.css" />
        </head>
        <?php include_once __DIR__ . "/../views/NavBarre.php"; // IMPORT DE LA NAVE BARRE  
        ?>

        <body>
            <div class="connexionContainer">

                <h1>
                    Connexion
                </h1>
                <!-- Si il y a bien une valeur en paramètre alors affichage de celle ci  -->
                <?php if (isset($this->message)) {
                    echo $this->message;
                } ?>
                <!--Formulaire de connexion -->
                <form class="connexionForm" action=" " method="POST">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required />

                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required />

                    <button class="btnConnexion">Se connecter</button>
                    <a class="inscription" href="<?= $this->base_url() ?>inscription">Pas de compte ? Inscrivez vous !</a>
                </form>
            </div>
        </body>

        </html>

<?php
    }
} ?>