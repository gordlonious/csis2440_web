<?php
require_once __DIR__.'/playerdataeditor.php';
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


        $pwdfilepath = '/var/www/site_credentials/mysql_web_pwd';

        $playerEditor = new PlayerDataEditor('web', $pwdfilepath);

        if ($query_type == 'insert')
        {
            $saltedHash = password_hash($password, PASSWORD_DEFAULT);

            $playerEditor->add_new_player($firstname, $lastname, $email, $birthday, $saltedHash);

            echo <<<HEREDOC
<h2>Nice! You've Successfully Added A New Player.</h2>
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

            $playerEditor->update_existing_player($firstname, $lastname, $birthday, $hashToVerify);

            echo <<<HEREDOC
<h2>Nice! You've Successfully Updated The Matching Player.</h2>
<p>To review, here is what your updated player looks like. Remember, you can always rename the player.</p>
<p><b>First Name: </b>$firstname</p>
<p><b>Last Name: </b>$lastname</p>
<p><b>E-mail: </b>$email</p>
<p><b>Birthday: </b>$birthday</p>
HEREDOC;
        }

        if ($query_type == 'search')
        {
            if (!isset($lastname) && !isset($firstname))
            {
                echo '<h2>To search, you must either specify a first name or a last name</h2>';
                throw new Exception('user specified unhandled search data');
            }

            $searchData;

            if (!empty($lastname) && !empty($firstname))
            {
                $searchData = $playerEditor->search_player_by_first_name_and_last_name($firstname, $lastname);
            }
            else if (!empty($lastname)) 
            {
                $searchData = $playerEditor->search_player_by_last_name($lastname);
            }
            else
            {
                $searchData = $playerEditor->search_player_by_first_name($firstname);
            }

            if (!isset($searchData))
            {
                echo '<h2>Sorry, your search did not return any results!</h2>';
            }

            echo '<hr>';

            foreach ($searchData as $item)
            {
                echo <<<HEREDOC
<h2>Nice! This player matched your search!</h2>
<p><b>First Name: </b>{$item[0]}</p>
<p><b>Last Name: </b>{$item[1]}</p>
<p><b>E-mail: </b>{$item[2]}</p>
<p><b>Birthday: </b>{$item[3]}</p>
<hr>
HEREDOC;
            }
        }
    ?>
    </body>
</html>
