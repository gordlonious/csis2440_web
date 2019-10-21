<?php
require_once __DIR__.'/database.php';

class PlayerDataEditor extends Database
{
    private $mysqli;
    
    public function __construct($user, $pwdfilepath)
    {
        parent::__construct($user, $pwdfilepath);
        $this->mysqli = parent::getdbconnection();
        $this->create_player_table();
    }

    private function create_player_table()
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

    public function add_new_player($firstName, $lastName, $email, $birthDate, $password)
    {
        $sql =
        "
        INSERT INTO `CSIS2440`.`Player`
        (
            firstName,
            lastName,
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

    public function update_existing_player($firstName, $lastName, $birthDate, $hash)
    {
        $sql =
        "
        UPDATE `CSIS2440`.`Player`
        SET
            firstName = ?,
            lastName = ?
        WHERE
            birthDate = ?
            AND `password` = ?
        ";

        $statement = $this->mysqli->prepare($sql);

        if (!$statement)
        {
            echo 'failed to prepare sql statement';
            throw new Exception('failed to prepare sql statement');
        }
        
        $bindingResult = $statement->bind_param("ssss", $firstName, $lastName, $birthDate, $hash);

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

        // TODO: return a 'whether or not anything actually got updated' flag
    }

    public function get_hash($birthday, $email)
    {
        $sql =
        "
        SELECT `password`
        FROM CSIS2440.Player
        WHERE
            birthDate = ?
            AND email = ?
        ";

        $statement = $this->mysqli->prepare($sql);

        if (!$statement)
        {
            echo 'failed to prepare sql statement';
            throw new Exception('failed to prepare sql statement');
        }
        
        $parameterBindingResult = $statement->bind_param("ss", $birthday, $email); 

        if (!$parameterBindingResult)
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

        $pwd;

        $sqlSelectResult = $statement->bind_result($pwd);

        if (!$sqlSelectResult)
        {
            echo 'failed to bind result to select column';
            throw new Exception('failed to bind result to select column');
        }

        $fetchResult = $statement->fetch();

        if (!isset($fetchResult))
        {
            echo 'The hash could not be found using birthday and email.';
            return false;
        }

        if (!$fetchResult)
        {
            echo 'There was an error fetching the select values.';
            throw new Exception('There was an error fetching the select values');
        }

        return $pwd;
    }
}
?>
