<?php
    session_start();
    require_once("lib/connexiopersistent.php");
    $sql = "UPDATE users set active = ? where iduser = ?";
    $update = $db -> prepare($sql);
    $update -> execute(array(1,$_SESSION["id"]));
    $_SESSION = array();
    session_destroy();
    header("Location:index.php");
