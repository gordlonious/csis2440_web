<!DOCTYPE HTML>
<html>
	<head>
        <meta charset="US-ASCII">
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
        <style>
            h2 {
                text-align: center;
            }

            form > input {
                display: block;
                margin-bottom: 10px;
            }

            body > form {
                margin: auto;
                width: 200px;
            }

            body > p {
                text-align: center;
            }

            input[type="button"] {
                width: 75px;
                height: 25px;
            }

            button {
                background: none;
                border-style: solid;
                border-width: 1px;
                border-color: black;
            }
        </style>
	</head>
    <body>
        <h2>The Anvil N' Stuff Store</h2>
        <form action="catalogue.php" id="login_form">
            <label for="uname_input">Username:</label>
            <input type="text" id="uname_input"/>
            <label for="pwd_input">Password:</label>
            <input type="password" id="pwd_input"/>
            <input type="button" onclick="submitLogin()" value="Login"/>
        </form>
        <p>Don't have an account yet? <button onclick="revealSignup()">Click here to signup!</button></p>
        <form action="login.php" id="signup_form" hidden>
            <label for="new_uname_input">New Username:</label>
            <input type="text" name="new_uname_input"/>
            <label for="new_pwd_input">New Password:</label>
            <input type="password" name="new_pwd_input"/>
            <input type="button" onclick="submitSignup()" value="Signup"/>
        </form>
    </body>
</html>
