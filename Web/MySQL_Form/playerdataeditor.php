<?php
require_once __DIR__.'/database.php';

class PlayerDataEditor extends Database
{
    private $mysqli;
    
    public function __construct($user, $pwdfilepath)
    {
        parent::__construct($user, $pwdfilepath);
        $this->mysqli = parent::getdbconnection();
        $this->CreatePlayerTable();
    }

    private function CreatePlayerTable()
    {
        $sql =
        "
        CREATE TABLE IF NOT EXISTS `CSIS2440`.`Player`
        (
            playerId INT NOT NULL AUTO_INCREMENT,
            firstName VARCHAR(100),
            lastName VARCHAR(100),
            email VARCHAR(100),
            birthDate DATE,
            password CHAR(120),
            PRIMARY KEY (playerId)
        )
        ";

        $queryResult = $this->mysqli->query($sql);

        if (!$queryResult)
        {
            echo 'failed to create player table';
            throw new Exception('failed to create table');
        }
    }
}
?>
