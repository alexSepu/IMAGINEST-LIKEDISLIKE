<?php
/*session_start();
if ($_SERVER["REQUEST_METHOD"] == "GET"){
    $_SESSION["mail"] = $_GET["mail"];
    $_SESSION["code"] = $_GET["code"];
}*/
if (isset($_GET["mail"])) {
    if (isset($_GET["mail"])) {
        $mail = $_GET["mail"];
    }
    if (isset($_GET["code"])) {
        $code = $_GET["code"];
    }
    $usuari = array($mail,$code);
    setcookie("variablesUsuari", json_encode($usuari), time() + 60 * 30);
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!is_null($_POST["password"]) || !is_null($_POST["verifyPassword"])) {
        require_once 'lib/connexiopersistent.php';
        require_once 'lib/session.php';
        if (isset($_COOKIE["variablesUsuari"])) {
            $variablesUsuari = json_decode($_COOKIE["variablesUsuari"]);
            $select = verifyUser($variablesUsuari[0], $db);
            $row = $select->fetch(PDO::FETCH_ASSOC);
            date_default_timezone_set('Europe/Madrid');
            if ($row["resetPassCode"] === $variablesUsuari[1]) {
                if (strcmp(strtotime(date("Y/m/d H:i:s")),strtotime($row["resetPassExpiry"]))<0) {
                    updatePass($row["mail"], $db, $_POST["password"]);
                    echo '<script type="text/javascript"> alert("Password reset"); </script>';
                    setcookie("parametres", "", time() - 36000 );
                    $usermail = $variablesUsuari[0];
                    require_once 'lib/correuResetConfirm.php';
                    header("Location:index.php");
                } else{echo '<script type="text/javascript"> alert("30 minutes have passed, you cannot reset the password"); </script>';
                    abort($variablesUsuari[0],$db);
                }
                } else{ echo '<script type="text/javascript"> alert("Wrong reset code"); </script>';
                    abort($variablesUsuari[0],$db);
                }
            header("Location:index.php");
        }
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="css/loginRegister.css">
    <title>Home</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>


<body id="body">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4 col-sm-2 col-1">
            </div>
            <div class="col-md-4 col-sm-8 col-10 text-center" id="log">
                <div class="row">
                    <div class="col-12 mb-2">
                        <img style="width:50%" src="img/logo3.png" />
                    </div>
                    <div class="col-12 text-center">
                        <div class="row">
                            <div class="col-1"></div>
                            <div class="col-10 login-form">
                                <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" onsubmit="return controlPassword()">
                                    <div class="form-group">
                                        <input type="password" name="password" class="form-control" id="password" required aria-describedby="emailHelp" placeholder="New password">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="verifypassword" class="form-control" id="verifyPassword" required placeholder="Verify new password">
                                    </div>
                                    <p class="error"></p>
                                    <input type="submit" value="Reset password" class="btn btn-primary col-12 log" />
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-2 col-1"></div>
        </div>
    </div>
</body>
<script src="js/comprobarContrasenya.js"></script>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

</html>