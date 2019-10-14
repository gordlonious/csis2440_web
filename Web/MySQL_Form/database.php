<?php
class Database
{
    private $host;
    private $dbname;
    private $username;
    private $pwd;

    __construct($user, $pwdfilepath)
    {
       $this->username = $user;
       $this->host = '127.0.0.1';
       $this->dbname = 'CSIS2440';
       getpwd($pwdfilepath);
    }

    private function getpwd($pwdfilepath)
    {
        $fp = fopen($pwdfilepath, 'rb');

        $line = fgets($fp);

        $this->pwd = trim($line);

        fclose($fp);
    }

    public getdbconnection()
    {
        $connection = new mysqli($this->host, $this->username, $this->pwd, $this->dbname);

        if ($connection->connect_errno)
        {
            echo 'FAILED TO CONNECT TO DATABASE';
            return;
        }

        return $connection;
    }
}
?>
