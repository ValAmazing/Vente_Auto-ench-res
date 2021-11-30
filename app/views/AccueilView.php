<?php
//Appel de la séssion pour vérifier si l'utilisateur est connecté 
session_start();

// Importation de AbstractView qui permet de faire la redirection une fois la requête du formulaire envoyée
include_once __DIR__ . "/../views/AbstractView.php";

class ProductView extends AbstractView
{
    protected $posts;
    protected $result;

    public function __construct($posts, $result)
    {
        $this->posts = $posts;
        // Si la variable $result n'est pas nulle
        if (isset($result)) {
            $this->result = $result; // Assignation de la valeur du résultat dans la propriété résultat
        }
    }
    //fonction render qui permet l'affichage de son contenu
    public function render()

    { ?>

        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <link rel="stylesheet" type="text/css" href="assets/styles/styles.css" />
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Document</title>
        </head>

        <body>
            <?php include_once __DIR__ . "/../views/NavBarre.php"; // IMPORT DE LA NAVE BARRE 
            ?>
            <!--Création de conditions pour notifier a l'utilisateur si sont post est bien enregistrer ou non  -->
            <?php if (!isset($this->result) && !empty($_SESSION['id'])) { ?>
                <p>Si vous souhaitez partager une annonce cela ce passe içi</p>
            <?php } else if ($this->result === true) { ?>
                <p>Félicitation voiture est mise aux enchères</p>
            <?php } else if (empty($_SESSION['id'])) { ?>
                <p>Veuillez vous connecter ou vous inscrire pour poster une annonce</p>
            <?php } else { ?>
                <p> Une erreure s'est produite, veuillez réessayer ! </p>
            <?php } ?>

            <!--FORM post annonce -->
            <form action="<?= $this->base_url() ?>home" method="POST">
                <label for="titre">Titre de votre annonce</label>
                <input type="text" name="titre" id="titre">

                <label for="prix_depart">Prix de départ des enchères</label>
                <input type="number" name="prix_depart" id="prix_depart">

                <label for="date_fin">Date de fin d'enchères souhaitez</label>
                <input type="date" name="date_fin" id="date_fin">

                <label for="model">Model de votre véhicule</label>
                <input type="text" name="model" id="model">

                <label for="marque">Marque de votre véhicule</label>
                <input type="text" name="marque" id="marque">

                <label for="puissance">Puissance de votre véhicule</label>
                <input type="number" name="puissance" id="puissance">

                <label for="annee">Année de votre véhicule</label>
                <input type="text" name="annee" id="annee">

                <label for="description">Listez les options de votre véhicule</label>
                <input type="text" name="description" id="description">

                <button type="submit">Valider</button>
            </form>


            <?php if (is_array($this->posts) || is_object($this->posts)) {
                foreach ($this->posts as $key => $post) { // parcours du tableau pour afficher tous les posts présents dans notre tableau post 
                    /**
                     * Création de parametre pou déterminer le temps restant pour enchérir sur une annonce
                     */
                    date_default_timezone_set("Europe/Paris");
                    $today = time();
                    $fin = strtotime($post->date_fin);
                    $countdownHeure = date("H:i", round(($fin - $today)));
                    $countdownJour = round(($fin - $today) / 86400);
                    $key = $post->id;

                    echo $key;
            ?>
                    <!--rendu visuel des annonces -->
                    <div class="Post_container">
                        <a href="<?= $this->base_url() ?>details?id=<?= $key ?>">
                            <h1><?= $post->titre ?> </h1>
                        </a>
                        <p><?= $post->model . " " . $post->marque ?></p>
                        <p><?= $post->annee . " • " . $post->puissance . "ch" ?> </p>
                        <p> <?= "Prix de départ: " . $post->prix_depart . "€" ?> </p>
                        <?php if ($countdownJour >= 0 && $countdownHeure >= 0) { ?>
                            <p> <?= $countdownJour . "Jours" . $countdownHeure . " heures restantes" ?> </p>
                    </div>
                <?php } else { ?>
                    <p>Temps écoulé !</p>
                <?php } ?>
            <?php } ?>
        </body>

        </html>
<?php
            }
        }
    }
?>