<?php
require_once __DIR__.'/database.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="US-ASCII">
        <title>MySQL Results</title>
    </head>
    <body>
    <?php
        $firstname = $_POST['first_name'];
        $lastname = $_POST['last_name'];
        $birthday = $_POST['birthday'];
        $email = $_POST['email'];
        $password = $_POST['pwd'];
        $query_type = $_POST['query_type'];

        $pwdfilepath = '/var/www/site_credentials/mysql_root_pwd';

        $db = new Database('root', '');

        $connection = $db->getinsecureconnection();

        echo 'connection created';

    ?>
    </body>
</html>
