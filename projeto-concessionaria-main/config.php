<?php
    define('HOST', 'localhost');
    define('PORT', 3308); 
    define('USER', 'root');
    define('PASS', '');
    define('BASE', 'concessionaria2122m');
    $conn = new mysqli(HOST, USER, PASS, BASE, PORT);
    if ($conn->connect_error) {
        die("Falha na conexão: " . $conn->connect_error);
    }