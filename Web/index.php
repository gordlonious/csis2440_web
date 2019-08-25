<!DOCTYPE html>
<html>
    <head>
        <style>
            @import url(index_style.css);
        </style>
    </head>
    <body>
        <div class="top_container">
            <img src="anarchy.jpg" id="anarchyjpg">
        </div>
        <div class="flex_container">
            <nav>
                <ul>
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
                    echo "<p> HELLO WORLD </p>";
                    echo date('D F Y');
                ?>
            </div>
        </div>
    </body>
</html>
