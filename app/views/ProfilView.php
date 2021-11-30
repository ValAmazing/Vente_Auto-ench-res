<?php

include_once __DIR__ . "/../views/AbstractView.php";

class ProfilView extends AbstractView
{
    /**
     * Propriétés
     */
    protected $posts;
    protected $result;
    public $profilPosts;

    /**
     * Constructeur
     */
    public function __construct($result, $posts, $profilPosts)

    {
        // Si la variable $result n'est pas nulle
        if (isset($result)) {
            $this->result = $result;
        }
        //Assignation des valeurs dans les propriétés
        $this->posts = $posts;
        $this->profilPosts = $profilPosts;
    }
    /**
     * Rendu de la page
     */
    public function render()
    {
?>
        <!DOCTYPE html>

        <html>

        <head>
            <meta charset="utf-8">
            <title>Inscription Auto-Enchères</title>

            <link rel="stylesheet" type="text/css" href="assets/styles/styles.css" />
        </head>

        <body>
            <?php include_once __DIR__ . "/../views/NavBarre.php"; // IMPORT DE LA NAVE BARRE 
            ?>

            <!--Affichage du profil utilisateur -->
            <div id="mainContainer">
                <p>Nom: <?= $this->posts->nom ?></p>
                <p>Prenom: <?= $this->posts->prenom ?></p>
                <p>Email: <?= $this->posts->email ?></p>

                <?php
                // Si édition du profil réattribution de la valeur dans $_SESSION
                $_SESSION['nom'] = $this->posts->nom;
                //Conditions de validation du formulaire
                if (!isset($this->result)) { ?>
                    <p>
                        Edition du profil
                    </p>
                <?php } else if ($this->result === true) {
                ?>
                    <p>Votre modification a bien été enregistrée.</p>
                <?php } else { ?>
                    <p>Une erreur s'est produite, veuillez réessayer.</p>
                <?php } ?>
                <!--Form Edition Profil -->
                <form action="<?= $this->base_url() ?>profil" method="POST">
                    <label for="nom">Prénom:</label>
                    <input type="text" id="nom" name="nom" required />

                    <label for="prenom">Nom:</label>
                    <input type="text" id="prenom" name="prenom" required />

                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required />

                    <label for="mdp">Mot de passe:</label>
                    <input type="password" id="mdp" name="mdp" required />

                    <button type="submit">Valider</button>
                </form>
            </div>
            <?php
            /**
             * Boucle sur le tableau profilPosts pour afficher 
             * tous les posts de l'utilisateur sur son profil
             */
            if (is_array($this->profilPosts) || is_object($this->profilPosts)) {
                foreach ($this->profilPosts as $profilPost) { ?>
                    <?php
                    /**
                     * Création de parametre pou déterminer le temps restant pour enchérir sur une annonce
                     */
                    date_default_timezone_set("Europe/Paris");
                    $today = time();
                    $fin = strtotime($profilPost->date_fin);
                    $countdownHeure = date("H:i", round(($fin - $today)));
                    $countdownJour = round(($fin - $today) / 86400);
                    $key = $profilPost->id; ?>
                    <!--Affichage des posts  -->
                    <div class="Post_container">
                        <a href="<?= $this->base_url() ?>details?id=<?= $key ?>">
                            <h1><?= $profilPost->titre ?> </h1>
                        </a>
                        <p><?= $profilPost->model . " " . $profilPost->marque ?></p>
                        <p><?= $profilPost->annee . " • " . $profilPost->puissance . "ch" ?> </p>
                        <p> <?= "Prix de départ: " . $profilPost->prix_depart . "€" ?> </p>

                        <?php
                        //Conditions d'affichage si il reste du temps pour enchérir ou non 
                        if ($countdownJour >= 0 && $countdownHeure >= 0) { ?>
                            <p> <?= $countdownJour . "Jours" . $countdownHeure . " heures restantes" ?> </p>
                    </div>
                <?php } else { ?>
                    <p>Temps écoulé !</p>
                <?php } ?>

        <?php }
            }
        ?>
        </body>

        </html>
<?php
    }
} ?>