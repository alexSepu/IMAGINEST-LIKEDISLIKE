<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once 'lib/connexiopersistent.php';
    require_once 'lib/session.php';
    $select = verifyUser($_POST["namemail"], $db);
    $res = $select->rowCount();
    if ($res != 0) {
        $row = $select->fetch(PDO::FETCH_ASSOC);
        if ($row["active"] == 1) {
            if (password_verify($_POST["password"], $row["passHash"])) {
                UpdateLastSign($row, $db);
                session_start();
                $_SESSION['id'] = $row['iduser'];
                $_SESSION['username'] = $row['username'];
                $_SESSION['mail'] = $row["mail"];
                $userlog = true;
                header("Location:home.php");
            }
        }
    }
    if (isset($userlog) == false) echo '<script type="text/javascript"> alert("Usuari o contrasenya incorrecte"); </script>';
}
//if(isset($_COOKIE[session_name()])) header("Location:home.php");
/*if (isset($_COOKIE[session_name()])) {
    header("Location:home.php");
}*/
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login Imaginest</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="css/loginRegister.css">
</head>

<body id="body">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2 col-1"></div>
            <div class="col-lg-4 col-md-4 mt-5" id="mockUp">
                <img width="100%" height="100%" src="img/movil.png"/>
            </div>
            <div class="col-lg-4 col-md-8 col-10 text-center mx-auto" id="regis">
                <div class="row">
                    <img class="mb-2 pt-5 pb-5 mx-auto" style="width:50%" src="img/LOGOI.png" />
                    <div class="col-12 text-center">
                        <div class="row">
                            <div class="col-1"></div>
                            <div class="col-10 login-form">
                                <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                                    <div class="form-group">
                                        <input type="text" name="namemail" class="form-control" id="exampleInputEmail1" required aria-describedby="emailHelp" placeholder="Enter email or username">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="password" class="form-control" id="exampleInputPassword1" required placeholder="Password">
                                    </div>
                                    <a style="color:black"  class="forgot" data-toggle="modal" data-target="#exampleModal">Forgot password ?</a>
                                    <input type="submit" value="Sign in" class="btn btn-primary col-12 log" />
                                    <a href="register.php" class="btn btn-outline-primary white-background" id="register">Don't have an account ? Sign up</a>
                                </form>
                                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form method="POST" action="sendResetMail.php">
                                                    <input type="text" name="name" class="form-control" id="exampleInputEmail1" required aria-describedby="emailHelp" placeholder="Enter email or username">
                                                    <input type="submit" value="Send mail ! " class="btn btn-primary" />
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-2 col-1"></div>
        </div>
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script>
    $('.forgot').click(function() {
        $('#exampleModal').modal('show');
    });
</script>

</html>