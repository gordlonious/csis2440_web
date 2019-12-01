<!DOCTYPE HTML>
<html>
	<head>
        <meta charset="US-ASCII">
		<title>E-Commerce Login</title>
        <script>
            function submitLogin()
            {
                let xhr = new XMLHttpRequest();

                let xml = "<login><uname>" + document.getElementById('uname_input').value + "</uname><pwd>" + document.getElementById('pwd_input').value + "</pwd></login>";

                xhr.open('POST', 'verify_login.php');

                xhr.setRequestHeader('Content-Type', 'text/xml');

                xhr.onreadystatechange = function() {
                    if (xhr.readyState == 4)
                    {
                        if (xhr.status == 200)
                        {
                            alert('You have successfully logged in! Feel free to browse our catalogue.');
                            window.location.href = 'catalogue.php';
                        }
                        else
                        {
                            alert('Something went wrong with the login request. The username and password you provided may not have matched anything in our system. Try again or make a new account!');
                        }
                    }
                    else
                    {
                        //console.log('login incomplete');
                    }
                }

                xhr.send(xml);
            }

            function submitSignup()
            {
                let xhr = new XMLHttpRequest();

                let xml = "<signup><uname>" + document.getElementById('new_uname_input').value + "</uname><pwd>" + document.getElementById('new_pwd_input').value + "</pwd></signup>";

                xhr.open('POST', 'signup.php');

                xhr.setRequestHeader('Content-Type', 'text/xml');

                xhr.onreadystatechange = function() {
                    if (xhr.readyState == 4)
                    {
                        if (xhr.status == 200)
                        {
                            alert('Your signup has completed successfully! You can go ahead and login.');
                            hideSignup();
                        }
                        else
                        {
                            alert('Sorry, something went wrong with the signup process. Please try again later or contact a system administrator.');
                        }
                    }
                    else
                    {
                        //console.log('signup incomplete');
                    }
                }
                xhr.send(xml);
            }

            function revealSignup()
            {
                let signupForm = document.getElementById('signup_form');
                signupForm.removeAttribute('hidden');
            }

            function hideSignup()
            {
                let signupForm = document.getElementById('signup_form');
                signupForm.hidden = true;
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
        <form id="login_form">
            <label for="uname_input">Username:</label>
            <input type="text" id="uname_input"/>
            <label for="pwd_input">Password:</label>
            <input type="password" id="pwd_input"/>
            <input type="button" onclick="submitLogin()" value="Login"/>
        </form>
        <p>Don't have an account yet? <button onclick="revealSignup()">Click here to signup!</button></p>
        <form id="signup_form" hidden>
            <label for="new_uname_input">New Username:</label>
            <input type="text" id="new_uname_input"/>
            <label for="new_pwd_input">New Password:</label>
            <input type="password" id="new_pwd_input"/>
            <input type="button" onclick="submitSignup()" value="Signup"/>
        </form>
    </body>
</html>
