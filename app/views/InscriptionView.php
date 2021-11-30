<?php

// Importation de AbstractView qui permet de faire la redirection une fois la requête du formulaire envoyée
include_once __DIR__ . "/../views/AbstractView.php";


class InscriptionView extends AbstractView
{
    /* Propriétés */
    protected $result; // Résultat du stockage des informations du formulaire

    /**
     * Contructeur
     * Ce constructeur prend en paramètre une valeur booléenne contenant le résultat du traitement
     * des informations du formulaire de contact. Si le paramètre est null, la requête reçue
     * n'était pas une soumission de formulaire.
     */
    public function __construct($result)
    {
        // Si la variable $result n'est pas nulle
        if (isset($result)) {
            $this->result = $result; // Assignation de la valeur du résultat dans la propriété résultat
        }
    }
    /**
     * Affichage page
     */
    public function render()
    { ?>

        <!DOCTYPE html>
        <html>

        <head>
            <meta charset="utf-8">
            <title>Inscription Auto-Enchères</title>

            <link rel="stylesheet" type="text/css" href="assets/styles/styles.css" />
        </head>

        <body>
            <?php include_once __DIR__ . "/../views/NavBarre.php"; // import de la navBarre  
            ?>
            <div id="mainContainer">
                <!--Conditions d'inscription valide ou non -->
                <?php if (!isset($this->result)) { ?>
                    <p>
                        Veuillez remplir le formulaire d'inscription
                    </p>
                <?php } else if ($this->result === true) { ?>
                    <p>Votre inscription a bien été enregistrée.</p>
                <?php } else { ?>
                    <p>Une erreur s'est produite, veuillez réessayer.</p>
                <?php } ?>
                <!--Form Inscription -->
                <form action="<?= $this->base_url() ?>inscription" method="POST">
                    <label for="nom">Prénom:</label>
                    <input type="text" id="nom" name="nom" required />

                    <label for="prenom">Nom:</label>
                    <input type="text" id="prenom" name="prenom" required />

                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required />

                    <label for="mdp">Mot de passe:</label>
                    <input type="password" id="mdp" name="mdp" required />

                    <button>Valider</button>
                </form>
            </div>
        </body>

        </html>

<?php  }
} ?>