<?php
require_once '../MySQL_Form/database.php';

class CreateAccount extends Database
{
    private $mysql;

    function __construct($user, $pwdfilepath)
    {
        parent::__construct($user, $pwdfilepath);

        $this->mysql = parent::getdbconnection();

        $this->create_commerce_user_table();
    }

    private function create_commerce_user_table()
    {
        $sql =
        "
            CREATE TABLE IF NOT EXISTS `CSIS2440`.`CommerceUser`
            (
                commerceUserId INT NOT NULL AUTO_INCREMENT,
                commerceUsername VARCHAR(255),
                commercePwdHash CHAR(255),
                PRIMARY KEY (commerceUserId)
            );
        ";

        $sqlResult = $this->mysql->query($sql);

        if (!$sqlResult)
        {
            echo "ERROR WITH CREATE ACCOUNT TABLE";
        }
    }

    public function insert_commerce_user($user, $pwd)
    {
        $pwdHash = password_hash($pwd, PASSWORD_DEFAULT);

        $sql = 
        "
            INSERT INTO `CSIS2440`.`CommerceUser`
            (
                commerceUsername,
                commercePwdHash
            )
            VALUES
            (
                ?,
                ?
            );
        ";

        $stmnt = $this->mysql->prepare($sql);

        if (!$stmnt)
        {
            echo "ERROR WITH PREPARING CREATE ACCOUNT STATEMENT";
        }

        $bindResult = $stmnt->bind_param("ss", $user, $pwdHash);

        if (!$bindResult)
        {
            echo "ERROR WITH CREATE ACCOUNT BINDING";
        }

        $executionResult = $stmnt->execute();

        if (!$executionResult)
        {
            echo "ERROR WITH CREATE ACCOUNT INSERT";
        }
    }
}
?>
