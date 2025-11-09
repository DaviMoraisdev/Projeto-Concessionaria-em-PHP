<?php

use Dom\Mysql;

    define ('HOST', 'localhost: 3308');
    define('USER', 'root');
    define('PASS', '');
    define('BASE', 'concessionaria2122m');

    $conn = new Mysql(HOST, USER, PASS, BASE);