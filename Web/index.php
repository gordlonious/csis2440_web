<!DOCTYPE html>
<html>
    <head>
        <style>
            @import url(index_style.css);
        </style>
    </head>
    <body>
        <div class="nav_container">
            <nav>
                <ul>
                    <a href="ip address?" id="home">
                        <img src="home.png">
                    </a>
                    <li>
                        <a href="link to assignment 1">Assignment 1</a>
                    </li>
                    <li>
                        <a href="2">Assignment 2</a>
                    </li>
                    <li>
                        <a href="ecommerce">E-Commerce</a>
                    </li>
                </ul>
            </nav>
            <div class="php_container">
                <?php
                    echo "<p>PHP HELLO WORLD </p>";
                    echo date('D F Y');
                ?>
            </div>
        </div>
    </body>
</html>
