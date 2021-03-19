<?php
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $mail = $_GET["mail"];
    $code = $_GET["code"];
    require_once 'lib/connexiopersistent.php';
    require_once 'lib/session.php';
    $row = verifyCode($db, $mail);
    if ($row["activationCode"] === $code) {
        updateActive($db, $mail);
        echo "<div class='modal fade' id='exampleModalCenter' tabindex='-1' role='dialog' aria-labelledby='exampleModalCenterTitle' aria-hidden='true'>
                    <div class='modal-dialog modal-dialog-centered' role='document'>
                      <div class='modal-content'>
                        <div class='modal-header'>
                          <h5 class='modal-title text-center' id='exampleModalLongTitle'>Verify account</h5>
                          <button type='button' class='close' id='close' onclick='on()' data-dismiss='modal' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                          </button>
                        </div>
                        <div class='modal-body text-center'>
                          <p>Active account !</p>
                          <p> Congratulations, your account are active</p>
                        </div>
                        <div class='modal-footer'>
                          <a class='btn btn-primary' href='index.php'>Confirm</a>
                        </div>
                      </div>
                    </div>
                  </div>";
          //header("Location:index.php");
    } else echo '<script type="text/javascript"> alert("Wrong code"); </script>';
}
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
</body>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script>
$(document).ready(function(){
        $("#exampleModalCenter").modal('show');
    });
    function on(){
        window.location.replace('index.php');
    }
</script>
</html>