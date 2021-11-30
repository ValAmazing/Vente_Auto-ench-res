            <?php

/**
 * core/Database.class.php - Classe database
 */

/* Namespace */

/* Alias */
//use PDO;

/**
 * Classe base de données
 */
abstract class Database
{

    const ADDRESS = "mysql:dbname=vente_auto;host:localhost";
    const USER = "root";
    const PASSWORD = "";

    /**
     * Création d'un connexion à la base de données
     */
    public static function createDBConnection()
    {
        return new PDO(self::ADDRESS, self::USER, self::PASSWORD);
    }
}
