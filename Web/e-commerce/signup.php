<?php
require_once 'CreateAccount.php';

$poststr = file_get_contents('php://input');

$xml = simplexml_load_string($poststr);

$pwdfilepath = '/var/www/site_credentials/mysql_web_pwd';

$accountCreator = new CreateAccount('web', $pwdfilepath);

$accountCreator->insert_commerce_user($xml->uname, $xml->pwd);
?>
