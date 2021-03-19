<?php 
    setcookie('idioma',$_POST['lang'],time() + (86400 * 30), "/");
    require_once("../langs/lang-".$_POST["lang"].".php");
    echo json_encode($_POST['lang']);
?>