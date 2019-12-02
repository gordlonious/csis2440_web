<!DOCTYPE html>
<html>
    <head>
        <title>The Catalogue</title>
    </head>
    <body>
        <h3>Please select an item!</h3>
        <select id="product_select">
            <?php
            require_once '../MySQL_Form/database.php';
            $pwdfilepath = '/var/www/site_credentials/mysql_web_pwd';
            $db = new Database('web', $pwdfilepath);

            $con = $db->getdbconnection();

            $sql =
            "
            SELECT `name`
            FROM `CSIS2440`.`Product`
            ";

            $sqlResult = $con->query($sql);

            if (!$sqlResult)
            {
                http_response_code(500);
            }

            foreach ($sqlResult as $row)
            {
                $productName = $row['name'];
                echo "<option>$productName</option>";
            }

            $sqlResult->free();

            $con->close();
            ?>
        </select>
    </body>
</html>
