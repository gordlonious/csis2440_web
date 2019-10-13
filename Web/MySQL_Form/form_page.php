<!DOCTYPE html>
<html>
    <head>
        <meta charset="US-ASCII">
        <title>MySQL Form</title>
    </head>
    <body>
        <form action="result_page.php" method="post">
            <label for="first_name">First Name</label>
            <input type="text" id="first_name">

            <label for="last_name">Last Name</label>
            <input type="text" id="last_name">

            <label for="birthday">Birthday</label>
            <input type="date" id="birthday">

            <label for="email">Email</label>
            <input type="email" id="email">

            <label for="pwd">Password</label>
            <input type="password" id="pwd">

            <label for="insert_radio">Add a new database record</label>
            <input type="radio" name="query_type" id="insert_radio" checked="checked">

            <label for="update_radio">Update an existing database record</label>
            <input type="radio" name="query_type" id="update_radio">

            <label for="search_radio">Search for an existing database record</label>
            <input type="radio" name="query_type" id="search_radio">
        </form>
    </body>
</html>
