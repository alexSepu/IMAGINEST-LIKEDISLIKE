<?php
    $cadena_connexio = 'mysql:dbname=imaginest;host=localhost:5306';
    $usuari = 'root';
    $passwd = '';
    try{
        //Ens connectem a la BDs
        $db = new PDO($cadena_connexio, $usuari, $passwd, array(PDO::ATTR_PERSISTENT=>true));
    }catch(PDOException $e){
        echo 'Error amb la BDs: ' . $e->getMessage();
    }