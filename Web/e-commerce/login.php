<!DOCTYPE HTML>
<html>
	<head>
		<title>E-Commerce Login</title>
        <script>
            function submitLogin()
            {
                let loginForm = document.getElementById('login_form');
                loginForm.submit();
            }

            function submitSignup()
            {
                let signupForm = document.getElementById('signup_form');
                signupForm.submit();
            }

            function revealSignup()
            {
                let signupForm = document.getElementById('signup_form');
                signupForm.removeAttribute('hidden');
            }
        </script>
	</head>
    <body>
        <form action="catalogue.php" id="login_form">
            <label for="uname_input">Username:</label>
            <input type="text" name="uname_input"/>
            <label for="pwd_input">Password:</label>
            <input type="password" name="pwd_input"/>
            <input type="button" onclick="submitLogin()" value="Login"/>
        </form>
        <p>Don't have an account yet? <button onclick="revealSignup()">Click here to signup!</button></p>
        <form action="login.php" id="signup_form" hidden>
            <label for="new_uname_input">Username:</label>
            <input type="text" name="new_uname_input"/>
            <label for="new_pwd_input">Password:</label>
            <input type="password" name="new_pwd_input"/>
            <input type="button" onclick="submitSignup()" value="Signup"/>
        </form>
    </body>
</html>
