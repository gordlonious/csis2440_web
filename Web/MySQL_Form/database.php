<?php
class Database
{
    private $host;
    private $dbname;
    private $username;
    private $pwd;

    function __construct($user, $pwdfilepath)
    {
       $this->username = $user;
       $this->host = '127.0.0.1';
       $this->dbname = 'CSIS2440';
       $this->getpwd($pwdfilepath);
    }

    private function getpwd($pwdfilepath)
    {
        try
        {
            $fp = fopen($pwdfilepath, 'rb');

            $line = fgets($fp);

            $this->pwd = trim($line);

            fclose($fp);
        }
        catch (Exception $e)
        {
            echo 'Error trying to parse pwd file';
            throw $e;
        }
    }

    public function getdbconnection()
    {
        $connection = new mysqli($this->host, $this->username, $this->pwd, $this->dbname);

        if ($connection->connect_errno)
        {
            echo 'FAILED TO CONNECT TO DATABASE';
            return;
        }

        return $connection;
    }

    public function getinsecureconnection()
    {
        echo 'getting insecure connection...<br>';
        $connection = new mysqli('127.0.0.1', 'root');
        return $connection;
    }
}
?>
