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

        // format validate post data
        //     sanitization should be mostly unnecessary because queries are parameterized
        if (!PostValidation::year_dash($birthday))
        {
            echo 'post validation failed, i need to figure out how to format dates into the yyyy-mm-dd format (for the MySQL DATE type)';
            throw new Exception('birthday was posted using an unhandled format');
        }

        $pwdfilepath = '/var/www/site_credentials/mysql_web_pwd';

        $playerEditor = new PlayerDataEditor('web', $pwdfilepath);

        if ($query_type == 'insert')
        {
            $saltedHash = password_hash($password, PASSWORD_DEFAULT);

            $playerEditor->add_new_player($firstname, $lastname, $email, $birthday, $saltedHash);

            echo <<<HEREDOC
<h2>Nice! You've Successfully Added A New Player.</h2>
<p>To review, here is what your new player looks like. Remember, you can always go back and edit this information.</p>
<p><b>First Name: </b>$firstname</p>
<p><b>Last Name: </b>$lastname</p>
<p><b>E-mail: </b>$email</p>
<p><b>Birthday: </b>$birthday</p>
HEREDOC;
        }

        if ($query_type == 'update')
        {
            // I'm not sure how to make this both secure and useful... get the hash based on birthday and email?
            $hashToVerify = $playerEditor->get_hash($birthday, $email);

            $passwordMatch = password_verify($password, $hashToVerify);

            if (!passwordMatch)
            {
                echo '<h2>Some of the information you entered was incorrect. Remember, you must provide the original birthday, email, and password for the player.</h2>';
                throw new Exception('Some of the information entered was incorrect');
            }

            echo 'updating...'.'<br>';
            $playerEditor->update_existing_player($firstname, $lastname, $birthday, $hashToVerify);
            echo 'updated!';
        }
    ?>
    </body>
</html>
