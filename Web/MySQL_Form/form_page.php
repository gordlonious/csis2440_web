<!DOCTYPE html>
<html>
    <head>
        <meta charset="US-ASCII">
        <title>MySQL Form</title>
        <link rel="stylesheet" type="text/css" href="form_style.css">
        <script>
            function validateFirstLast()
            {
                let firstNameInput = document.getElementById("first_name");
                let lastNameInput = document.getElementById("last_name");

                if (firstNameInput.value == "" || lastNameInput.value == "")
                {
                    alert("You must provide your name.");
                    return false;
                }

                let namePattern = /^[a-zA-Z]+$/;

                let fnameMatch = namePattern.test(firstNameInput.value);

                let lnameMatch = namePattern.test(lastNameInput.value);

                if (!fnameMatch || !lnameMatch)
                {
                    alert("You must only use letters to spell your name."); 
                    return false;
                }
       
                return true;
            }

            function submitValidPlayerForm()
            {
                let namesAreValid = validateFirstLast();

                if (namesAreValid)
                {
                    let playerForm = document.getElementById("playerForm");
                    playerForm.submit();
                }
            }
        </script>
    </head>
    <body>
        <h2>Add, Update, or Search for a Player!</h2>
        <form action="result_page.php" method="post" id="playerForm">
            <table>
                <tr>
                    <td><label for="first_name">First Name</label></td>
                    <td><input type="text" id="first_name" name="first_name"></td>
                </tr>
                <tr>
                    <td><label for="last_name">Last Name</label></td>
                    <td><input type="text" id="last_name"name="last_name"></td>
                </tr>
                <tr>
                    <td><label for="birthday">Birthday</label></td>
                    <td><input type="date" id="birthday" name="birthday"></td>
                </tr>
                <tr>
                    <td><label for="email">Email</label></td>
                    <td><input type="email" id="email" name="email"></td>
                </tr>
                <tr>
                    <td><label for="pwd">Password</label></td>
                    <td><input type="password" id="pwd" name="pwd"</td>
                </tr>
                <tr>
                    <td><label for="insert_radio">Add a new database record</label></td>
                    <td class="radio_td"><input type="radio" name="query_type" value="insert" id="insert_radio" checked="checked"></td>
                </tr>
                <tr> 
                    <td><label for="update_radio">Update an existing database record</label></td>
                    <td class="radio_td"><input type="radio" name="query_type" value="update" id="update_radio"></td>
                </tr>
                <tr>
                    <td><label for="search_radio">Search for an existing database record</label></td>
                    <td class="radio_td"><input type="radio" name="query_type" value="search" id="search_radio"></td>
                </tr>
                <tr class="submit_row">
                    <td></td>
                    <td><input type="button" value="Submit Query" onclick="submitValidPlayerForm()"></td>
                </tr>
            </table>
        </form>
        <ul class="helptext">
            <li>You may only update first and last name fields to a new value. Please provide the original birthdate, email, and password for verification.</li>
            <br>
            <li>Searching is based on first and last name.</li>
    </body>
</html>
