<?php
// function disconnect qui permet la session destroy
function  disconnect()
{
    session_destroy();
}
//Si $GET[deco] est true
if (isset($_GET['deco'])) {
    //Alors appel de la fonction disconnect
    disconnect();
    //redirection sur la page connexion 
    header('location:/mvc/connexion');
} else {


?>
    <nav>
        <div class="bienvenu">
            <?php if (!empty($_SESSION['id'])) { ?>
                <h2>Bienvenue: <?= $_SESSION['nom']; ?></h2>
        <?php }
        } ?>
        </div>
        <ul>
            <li>
                <a class="aNav" href="<?= $this->base_url() ?>home">Home</a>
            </li>
            <?php if (isset($_SESSION['id'])) { ?>
                <li>
                    <a class="aNav" href="<?= $this->base_url() ?>profil">Profil</a>
                </li>
            <?php } ?>
            <?php if (!isset($_SESSION['id'])) { ?>
                <li>
                    <a class="aNav" href="<?= $this->base_url() ?>connexion">Connexion</a>
                </li>
            <?php } else { ?>
                <li>
                    <!--Récupération de $GET[deco] passé en paramètre au clic de Deconnexion -->
                    <a class="aNav" href="<?= $this->base_url() ?>connexion?deco=true">Deconnexion</a>
                </li>
            <?php  } ?>
        </ul>
    </nav>