<?php
session_start();

if (!$_SESSION['isLoggedIn'])
{
    exit("Sorry, you're not authorized to use this page.");
}

if (isset($_GET['cartAction']))
{
    if ($_GET['cartAction'] == 'add')
    {
        $_SESSION['cart'][$_GET['productId']]++;
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>The Catalogue</title>
        <link href="catalogue_style.css" type="text/css" rel="stylesheet">
        <script type="text/javascript">
        function viewProductDetail(el)
        {
            el.setAttribute('selected', true);

            let xhr = new XMLHttpRequest();

            xhr.open('GET', 'get_product_details.php/?productId=' + el.id);

            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4)
                {
                    if (xhr.status == 200)
                    {
                        let productDetails = xhr.responseText.split(',');

                        let descNode = document.querySelector('#product_details > p:first-Child');
                        let priceNode = document.querySelector('#product_details > p:nth-child(2)');
                        let productImgNode = document.querySelector('#product_details > img');

                        productImgNode.src =  "productImages/" + el.id + ".jpg";
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

        function addToCart()
        {
            let productId = document.querySelector("#product_select > option[selected='true']").id;

            let actionString = 'catalogue.php/?productId=' + productId + '&cartAction=add';

            let productIdInput = document.querySelector("#addToCartForm > input:first-child");
            productIdInput.setAttribute('value', productId);

            let cartActionInput = document.querySelector("#addToCartForm > input:nth-child(2)");
            cartActionInput.setAttribute('value', 'add');

            addToCartForm.submit();
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
                <p></p>
                <p></p>
                <img>
            </div>
            <form id="addToCartForm" action="catalogue.php" method="get">
                <input type="hidden" name="productId">
                <input type="hidden" name="cartAction">
                <button type="button" onclick="addToCart()">Add to Cart</button>
            </form>
        </div>
        <hr>
        <div id="view_cart">
            <table>
                <th>Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Line Cost</th>
                <?php
                $pwdfilepath = '/var/www/site_credentials/mysql_web_pwd';
                $db = new Database('web', $pwdfilepath);
                if (isset($_SESSION['cart']))
                {
                    $con = $db->getdbconnection();

                    foreach ($_SESSION['cart'] as $productId => $quantity)
                    {
                        $sql = "SELECT `name`, `price` FROM `CSIS2440`.`Product` WHERE productId = $productId";

                        $sqlResult = $con->query($sql);

                        $row = $sqlResult->fetch_assoc();

                        $name = $row['name'];

                        $price = $row['price'];
                        
                        $line_cost = $quantity * $price;

                        echo "<tr><td>$name</td><td>$price</td><td>$quantity</td><td>$$line_cost</td></tr>";
                    }

                    $con->close();
                }
                else
                {
                    echo "<h4>You have no items in your cart</h4>";
                }
                ?>
            </table>
        </div>
    </body>
</html>
