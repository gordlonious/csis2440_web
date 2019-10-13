<!DOCTYPE html>
<html>
    <head>
        <meta charset="US-ASCII">
        <title>MySQL Form</title>
        <link rel="stylesheet" type="text/css" href="form_style.css">
    </head>
    <body>
        <h2>Add, Update, or Search for a Player!</h2>
        <form action="result_page.php" method="post">
            <table>
                <tr>
                    <td><label for="first_name">First Name</label></td>
                    <td><input type="text" id="first_name"></td>
                </tr>
                <tr>
                    <td><label for="last_name">Last Name</label></td>
                    <td><input type="text" id="last_name"></td>
                </tr>
                <tr>
                    <td><label for="birthday">Birthday</label></td>
                    <td><input type="date" id="birthday"></td>
                </tr>
                <tr>
                    <td><label for="email">Email</label></td>
                    <td><input type="email" id="email"></td>
                </tr>
                <tr>
                    <td><label for="pwd">Password</label></td>
                    <td><input type="password" id="pwd"></td>
                </tr>
                <tr>
                    <td><label for="insert_radio">Add a new database record</label></td>
                    <td class="radio_td"><input type="radio" name="query_type" id="insert_radio" checked="checked"></td>
                </tr>
                <tr> 
                    <td><label for="update_radio">Update an existing database record</label></td>
                    <td class="radio_td"><input type="radio" name="query_type" id="update_radio"></td>
                </tr>
                <tr>
                    <td><label for="search_radio">Search for an existing database record</label></td>
                    <td class="radio_td"><input type="radio" name="query_type" id="search_radio"></td>
                </tr>
            </table>
        </form>
    </body>
</html>
