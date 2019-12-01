<?php
require_once '../MySQL_Form/database.php';

$poststr = file_get_contents('php://input');

$xml = simplexml_load_string($poststr);

$pwdfilepath = '/var/www/site_credentials/mysql_web_pwd';

$db = new Database('web', $pwdfilepath);

$con = $db->getdbconnection();

$sql = 
"
SELECT commercePwdHash
FROM `CSIS2440`.`CommerceUser`
WHERE commerceUsername = ?
";

$stmnt = $con->prepare($sql);

if (!$stmnt)
{
    echo "ERROR WITH PREPARING HASH QUERY";
    http_response_code(500);
}

$bindParamResult = $stmnt->bind_param("s", $xml->uname);

if (!$bindParamResult)
{
    echo "ERROR WITH HASH QUERY BINDING";
    http_response_code(500);
}

$executionResult = $stmnt->execute();

if (!$executionResult)
{
    echo "ERROR WITH HASH QUERY EXECUTION";
    http_response_code(500);
}

$bindHashResult = $stmnt->bind_result($pwdHashResult);

if (!$bindHashResult)
{
    echo "ERROR WITH HASH RESULT BINDING";
    http_response_code(500);
}

$fetchResult = $stmnt->fetch();

if ($fetchResult)
{
    if (!password_verify($xml->pwd, $pwdHashResult))
    {
        http_response_code(401);
    }
}
else
{
    echo "PROBLEM WITH HASH FETCH OPERATION";
    http_response_code(500);
}
?>
