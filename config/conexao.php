<?php

try {

    @DEFINE('HOST', 'seu_host');
    @DEFINE('BD', 'seu_banco');
    @DEFINE('USER', 'seu_usuario');
    @DEFINE('PASS', 'sua_senha');

    $conect = new PDO('mysql:host=' . HOST . ';dbname=' . BD, USER, PASS);
    $conect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "<strong>ERRO DE PDO = </strong>" . $e->getMessage();
}

