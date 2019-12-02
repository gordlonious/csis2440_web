<?php
require_once '../MySQL_Form/database.php';

$productId = trim($_GET['productId']);

$pwdfilepath = '/var/www/site_credentials/mysql_web_pwd';

$db = new Database('web', $pwdfilepath);

$con = $db->getdbconnection();

$sql =
"
SELECT
    `name`,
    `description`,
    `price`
FROM `CSIS2440`.`Product`
WHERE `productId` = $productId
";

$sqlResult = $con->query($sql);

$row = $sqlResult->fetch_assoc();

$productName = $row['name'];
$productDescription = $row['description'];
$productPrice = $row['price'];

echo "$productName,$productDescription,$productPrice";

$sqlResult->free();

$con->close();
?>
