<?php


namespace App;


use PDO;

/**
 * La classe App défini les fondamentaux de l'application (connexion base de données, routeur, ...).
 * Elle implémente le patron singleton.
 * {@link https://apprendre-php.com/tutoriels/tutoriel-45-singleton-instance-unique-d-une-classe.html}
 * @remarks Pour fonctionner correctement, la classe a besoin que le fichier app/config/config.php existe et corresponde
 * au fichier config.sample.php en remplaçant les valeurs par défaut fournies.
 * @package App
 */
class App
{
    /**
     * @var App
     */
    private static $instance;

    /**
     * @var PDO connexion entre PHP et le serveur de base de données
     */
    private $db;

    /**
     * App constructor.
     */
    private function __construct()
    {
        $this->db = new PDO(
            CONFIG['db.driver'] . ':host=' . CONFIG['db.host'] . ';' . 'dbname=' . CONFIG['db.name'],
            CONFIG['db.user'],
            CONFIG['db.password'],
            CONFIG['pdo.config']
        );
    }

    /**
     * @return App instance courante de l'application
     */
    public static function getInstance(): App
    {
        if (!static::$instance) {
            static::$instance = new App();
        }
        return static::$instance;
    }

    /**
     * @return PDO connexion entre PHP et le serveur de base de données
     */
    public function getDb(): PDO
    {
        return $this->db;
    }
}
