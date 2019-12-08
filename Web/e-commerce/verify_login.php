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

if (isset($_SERVER['PHP_AUTH_USER']))
{
    $bindParamResult = $stmnt->bind_param("s", $_SERVER['PHP_AUTH_USER']);
}
else
{
    $bindParamResult = $stmnt->bind_param("s", $xml->uname);
}

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
    if (isset($_SERVER['PHP_AUTH_PW']))
    {
        if (!password_verify($_SERVER['PHP_AUTH_PW'], $pwdHashResult))
        {
            header('HTTP/1.1 401 Unauthorized');
            header('WWW-Authenticate: Basic realm="Access to e-commerce site required."');
            http_response_code(401);
        }
    }
    else
    {
        if (!password_verify($xml->pwd, $pwdHashResult))
        {
            header('HTTP/1.1 401 Unauthorized');
            header('WWW-Authenticate: Basic realm="Access to e-commerce site required."');
            http_response_code(401);
        }
    }
}
else
{
    echo "PROBLEM WITH HASH FETCH OPERATION";
    http_response_code(500);
}
?>
