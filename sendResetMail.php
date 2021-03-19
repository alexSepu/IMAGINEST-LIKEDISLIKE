<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once 'lib/session.php';
    require_once 'lib/connexiopersistent.php';
    $mail = $_POST["name"];
    $code = hash('sha256', rand());
    $select = verifyUser($mail, $db);
    $res = $select->rowCount();
    if ($res != 0) {
        $row = $select->fetch(PDO::FETCH_ASSOC);
        if ($row["active"] == 1) {
            updateResetCode($row["mail"], $db, $code);
            $link = "http://localhost/ExerciciLoginRegister/resetPassword.php?code=" . strval($code) . "&mail=" . $row["mail"] . "";
            $usermail = $row["mail"];
            require_once 'lib/correuReset.php';
            header("Location:index.php");
        }
        else
        {
            echo'<script type="text/javascript"> alert("You have to verify your account"); </script>';
        } 
    }
    else
    { 
        echo '<script type="text/javascript"> alert("There aren t users with this email/username "); </script>';
        header("Location:register.php");
    }
}
