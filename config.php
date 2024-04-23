<?php

define('DATABASE', [
    'HOST' => 'localhost',
    'DBNAME' => 'bonus',
    'USER_NAME' => 'root',
    'PASSWORD' => ''
]);

session_start();

require_once('classes/Database.php');
require_once('classes/Login.php');
require_once('classes/Kontakt.php');
require_once('classes/QNA.php');
