<?php
require_once __DIR__.'/database.php';

class PlayerDataEditor extends Database
{
    public function __construct($user, $pwdfilepath)
    {
        parent::__construct($user, $pwdfilepath);
    }
}
?>
