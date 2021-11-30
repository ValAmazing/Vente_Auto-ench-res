<?php

class DetailsView extends AbstractView
{
  /**
   * Propriétés
   */
  protected $result;
  protected $posts;
  protected $encheres;



  /**
   * Constructeur
   */
  public function __construct($posts, $result, $encheres)
  {
    /**
     * Assignation des valeurs dans les propriétés
     */
    $this->posts = $posts;
    $this->result = $result;
    $this->encheres = $encheres;
  }

  /**
   * Rendu de la page
   */
  public function render()
  { ?>


    <?php

    //Attribution du paramètre passé en URL pour enchérir sur l'annonce affiché
    $key = $_GET["id"];
    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" type="text/css" href="assets/styles/styles.css" />
      <title>Document</title>
    </head>

    <body>


      <?php include_once __DIR__ . "/../views/NavBarre.php"; // IMPORT DE LA NAVE BARRE  
      ?>
      <!--AFFICHAGE PROFIL -->
      <h1>Voici le details de l'annonce : </h1>
      <h2><?= $this->posts->titre ?></h2>
      <p>Model :<?= $this->posts->model ?> Puissance : <?= $this->posts->puissance ?> chevaux</p>
      <p>Marque :<?= $this->posts->marque ?> Année : <?= $this->posts->annee ?></p>
      <p>Description :<?= $this->posts->description ?></p>
      <p>Mise de départ :<?= $this->posts->prix_depart ?> Fin de l'enchère le : <?= $this->posts->date_fin ?></p>


      <form action="<?= $this->base_url() ?>details?id=<?= $key ?>" method="POST">
        <!--Création de conditions pour notifier à l'utilisateur si son enchère est bien enregistrée ou non  -->
        <?php if (!isset($this->result) && !empty($_SESSION['id'])) {
          echo 'Placez votre enchère';
        } else if (empty($_SESSION['id'])) {
          echo 'Veuillez vous connecter pour enchérir';
        } else if ($this->result === true) {
          echo 'Votre enchère à était prise en compte !';
        } else {
          echo 'erreure';
        }
        ?>
        <br>
        <!--Form enchère -->
        <label for="enchere">Votre enchère :</label>
        <input type="number" name="enchere" id="enchere" required>

        <button type="submit">Enchérir</button>
      </form>

      <p>La liste des enchères :</p>
      <?php
      $id_produit = $_GET['id'];
      ?>
      <!--foreach pour affichage des enchères de tous les utilisateurs sur ce post  -->
      <?php if (is_array($this->encheres) || is_object($this->encheres)) {
        foreach ($this->encheres as $enchere) { ?>
          <?= $enchere->nom; ?><p> a enchérit pour un montant de: <?= $enchere->montant_enchere; ?> € </p>
        <?php } ?>
      <?php } ?>



    </body>

    </html>
<?php
  }
}
?>