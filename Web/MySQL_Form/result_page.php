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


        $pwdfilepath = '/var/www/site_credentials/mysql_web_pwd';

        $playerEditor = new PlayerDataEditor('web', $pwdfilepath);

        if ($query_type == 'insert')
        {
            if (!PostValidation::year_dash($birthday))
            {
                echo 'post validation failed, i need to figure out how to format dates into the yyyy-mm-dd format (for the MySQL DATE type)';
                throw new Exception('birthday was posted using an unhandled format');
            }

            $saltedHash = password_hash($password, PASSWORD_DEFAULT);

            $playerEditor->add_new_player($firstname, $lastname, $email, $birthday, $saltedHash);

            echo <<<HEREDOC
<h2>Nice! You've Successfully Added A New Player.</h2>
<p>To review, here is what your new player looks like. Remember, you can always rename the player.</p>
<p><b>First Name: </b>$firstname</p>
<p><b>Last Name: </b>$lastname</p>
<p><b>E-mail: </b>$email</p>
<p><b>Birthday: </b>$birthday</p>
HEREDOC;
        }

        if ($query_type == 'update')
        {
            if (!PostValidation::year_dash($birthday))
            {
                echo 'post validation failed, i need to figure out how to format dates into the yyyy-mm-dd format (for the MySQL DATE type)';
                throw new Exception('birthday was posted using an unhandled format');
            }

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
            
            if (!empty($lastname)) // opt to search by last name when possible
            {
                $searchData = $playerEditor->search_player_by_last_name($lastname);
            }
            else
            {
                $searchData = $playerEditor->search_player_by_first_name($firstname);
            }

            $searchfname = $searchData[0];
            $searchlname = $searchData[1];
            $searchemail = $searchData[2];
            $searchbday = $searchData[3];

            if (empty($searchfname) && empty($searchlname))
            {
                echo '<h2>Sorry, it does not look like your search returned any results!</h2>';
                exit;
            }

            echo <<<HEREDOC
<h2>Nice! You've Found Some Results!</h2>
<p><b>First Name: </b>$searchfname</p>
<p><b>Last Name: </b>$searchlname</p>
<p><b>E-mail: </b>$searchemail</p>
<p><b>Birthday: </b>$searchbday</p>
<p>* only the first match is being displayed</p>
HEREDOC;
        }
    ?>
    </body>
</html>
