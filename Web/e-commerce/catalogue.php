<!DOCTYPE html>
<html>
    <head>
        <title>The Catalogue</title>
        <link href="catalogue_style.css" type="text/css" rel="stylesheet">
        <script type="text/javascript">
        function viewProductDetail(el)
        {
            let xhr = new XMLHttpRequest();

            xhr.open('GET', 'get_product_details.php/?productId=' + el.id);

            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4)
                {
                    if (xhr.status == 200)
                    {
                        let productDetails = xhr.responseText.split(',');

                        let descNode = document.getElementById('product_description');
                        let priceNode = document.getElementById('product_price');

                        descNode.innerHTML = productDetails[1];
                        priceNode.innerHTML = productDetails[2];
                    }
                    else
                    {
                        alert('Something went wrong with the product detail request. Sorry! Try again another time.');
                    }
                }
                else
                {
                    //console.log('still getting the details...');
                }
            }

            xhr.send();
        }
        </script>
    </head>
    <body>
        <h2>The Anvil N' Stuff Catalogue</h2>
        <div class="view_products">
            <label for="product_select">Select a product. View the details. Then add it to your cart!</label>
            <select id="product_select">
                <?php
                require_once '../MySQL_Form/database.php';
                $pwdfilepath = '/var/www/site_credentials/mysql_web_pwd';
                $db = new Database('web', $pwdfilepath);

                $con = $db->getdbconnection();

                $sql =
                "
                SELECT 
                    `name`,
                    `productId`
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
                    $productId = $row['productId'];
                    echo "<option id='$productId' onclick='viewProductDetail(this)'>$productName</option>";
                }

                $sqlResult->free();

                $con->close();
                ?>
            </select>
            <div id="product_details">
                <p id="product_description"></p>
                <p id="product_price"></p>
            </div>
        </div>
        <div id="view_cart">
        </div>
    </body>
</html>
