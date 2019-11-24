<!DOCTYPE HTML>
<html>
	<head>
		<title>E-Commerce Login</title>
        <script>
            function submit()
            {
                let submitButton = document.getElementById('submit_login');
                submitButton.submit();
            }
        </script>
	</head>
    <body>
        <form action="catalogue.php">
            <label for="uname_input">Username:</label>
            <input type="text" name="uname_input"/>
            <label for="pwd_input">Password:</label>
            <input type="password" name="pwd_input"/>
            <input type="button" id="submit_login" onclick="submit()"/>
        </form>
    </body>
</html>
