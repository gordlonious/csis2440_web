<?php
require_once __DIR__.'/playerdataeditor.php';
require_once __DIR__.'/postvalidation.php';
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
        echo $birthday.'<br>';

        // format validate post data
        //     sanitization should be mostly unnecessary because queries are parameterized
        if (!PostValidation::year_dash($birthday))
        {
            echo 'post validation failed, i need to figure out how to format dates into the yyyy-mm-dd format (for the MySQL DATE type)';
            throw new Exception('birthday was posted using an unhandled format');
        }

        $saltedHash = password_hash($password, PASSWORD_DEFAULT);

        $pwdfilepath = '/var/www/site_credentials/mysql_web_pwd';

        $playerEditor = new PlayerDataEditor('web', $pwdfilepath);

        if ($query_type == 'insert')
        {
            echo 'inserting...'.'<br>';
            $playerEditor->AddNewPlayer($firstname, $lastname, $email, $birthday, $saltedHash);
            echo 'inserted!';
        }
    ?>
    </body>
</html>
