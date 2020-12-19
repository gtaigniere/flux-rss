<?php


namespace App\Manager;


use PDO;

class DbManager
{
    /**
     * @var PDO
     */
    protected $db;

    /**
     * DbManager constructor.
     * @param PDO $db
     */
    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

}
