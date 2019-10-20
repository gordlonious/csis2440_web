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

    public function AddNewPlayer($firstName, $lastName, $email, $birthDate, $password)
    {
        $sql =
        "
        INSERT INTO `CSIS2440`.`Player`
        (
            firstName,
            lastname,
            email,
            birthDate,
            password
        )
        VALUES
        (
            ?,
            ?,
            ?,
            ?,
            ?
        )
        ";

        $statement = $this->mysqli->prepare($sql);

        if (!$statement)
        {
            echo 'failed to prepare sql statement';
            throw new Exception('failed to prepare sql statement');
        }
        
        $bindingResult = $statement->bind_param("sssss", $firstName, $lastName, $email, $birthDate, $password);

        if (!$bindingResult)
        {
            echo 'failed to bind sql parameters';
            throw new Exception('failed to bind sql parameters');
        }

        $sqlResult = $statement->execute();

        if (!sqlResult)
        {
            echo 'failed to execute parameterized query';
            throw new Exception('failed to execute parameterized query');
        }
    }
}
?>
