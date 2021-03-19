<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once 'lib/session.php';
    require_once 'lib/connexiopersistent.php';
    require_once 'lib/class/post.php';
    date_default_timezone_set('Europe/Madrid');
    $post = new Post(hash("sha256", rand()), 0, 0, 0, date("Y/m/d H:i:s"), $_POST["desc"]);
    move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], 'pujades/' . $post->getPhoto() . '.png');
    savePost($post->getPhoto(), $post->getDescription(),$_POST["filter"], $_SESSION["id"], $db);
    getHashtag($post->getPhoto(), $post->getDescription(), $db);
    header("Location:home.php?post=true");
}
if (!isset($_COOKIE['idioma'])) {
    $idioma = 'en';
} else {
    $idioma = $_COOKIE['idioma'];
}
require_once("./langs/lang-" . $idioma . ".php");
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET["cam"])) $cam = true;
    else if (isset($_GET["upload"])) $upload = true;
}

?>
<!DOCTYPE html>
<html lang="ca">

<head>
    <meta charset="UTF-8"  />
    <link rel="stylesheet" href="css/nav.css">
    <link rel="stylesheet" href="css/post.css">
    <title>Post</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.js"></script>
    <script src="./js/idioma.js"></script>
</head>

<body id="newpublish">
    <nav class="navbar navbar-expand-lg navbar-light fixed-top bg-light text-center" id="top">
        <div class="col-3">
            <a class="navbar-brand float-left" href="home.php"><img width="120" height="40" src="img/LOGOI.png" /></a>
        </div>
        <div class="col-8">
            <div class="dropdown float-right">
                <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-cog fa-lg" style="color:grey"></i>
                </button>
                <div class="dropdown-menu" id="drop" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="./condicionesPolitica/politica.html"><i class="fas fa-copyright"></i>&nbsp;<?php echo $idiomes['POLICY'] ?></a>
                    <a class="dropdown-item" href="./condicionesPolitica/condiciones.html"><i class="fas fa-user-secret"></i>&nbsp;<?php echo $idiomes['CONDITIONS'] ?></a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="mailto:asepulveda2021@educem.net"><i class="fas fa-id-badge"></i>&nbsp;<?php echo $idiomes['CONTACT'] ?></a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="./logout.php"><i class="fas fa-sign-out-alt fa-1x"></i> &nbsp; <?php echo $idiomes['LOGOUT'] ?></a>
                    <div class="dropdown-divider"></div>
                    <li class="dropdown-submenu text-center">
                        <a class="test text-center" style="text-decoration:none;flex-direction:column;color:black;" tabindex="-1" href="#"><i class="fas fa-language"></i>Langs</a>
                        <ul class="dropdown-menu">
                            <div class="col-12 p-2">
                                <div class="row">
                                    <div class="col-3">
                                        <input type="radio" id="cat" name="lang" value="ca">
                                    </div>
                                    <div class="col-9 mt-2">
                                        <label for="cat">Català</label>
                                    </div>
                                </div>


                            </div>
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-3">
                                        <input type="radio" id="es" name="lang" value="es">
                                    </div>
                                    <div class="col-9 mt-2">
                                        <label for="es">Español</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-3">
                                        <input type="radio" id="en" name="lang" value="en">
                                    </div>
                                    <div class="col-9 mt-2">
                                        <label for="en">English</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-3">
                                        <input type="radio" id="it" name="lang" value="it">
                                    </div>
                                    <div class="col-9 mt-2">
                                        <label for="it">Italiano</label>
                                    </div>
                                </div>


                            </div>
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-3">
                                        <input type="radio" id="fr" name="lang" value="fr">
                                    </div>
                                    <div class="col-9 mt-2">
                                        <label for="other">Français</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-3">
                                        <input type="radio" id="al" name="lang" value="al">
                                    </div>
                                    <div class="col-9 mt-2">
                                        <label for="other">Deutsche</label>
                                    </div>
                                </div>
                            </div>
                        </ul>
                    </li>
                </div>
            </div>
        </div>
    </nav>
    <div class="container-fluid">
        <div class="row" style="padding-top:100px">
            <div class="col-md-4 col-10 mx-auto" id="post">
                <div class="col-12 text-center cap">
                    <h4><?php echo $idiomes["POST"] ?></h4>
                    <div class="underline mx-auto"></div>
                </div>
                <form class="p-2" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data">
                    <div class='form-group'>
                        <label id='photoImg' for='img'>
                            <?php echo $idiomes["PHOTO"]; ?>
                        </label>
                        <input type='file' class='form-control' required name='fileToUpload' id='fileToUpload' aria-describedby='emailHelp'>
                    </div>
                    <div class="filter">
                        <input type="radio" id="sepia" name="filter" value="sepia">
                        <label for="male">Sepia</label>
                        <input type="radio" id="gray" name="filter" value="gray">
                        <label for="female">Gray</label>
                        <input type="radio" id="invert" name="filter" value="invert">
                        <label for="other">Invert</label>
                        <input type="radio" id="without" name="filter" value="without">
                        <label for="other">Without</label>
                    </div>
                    <div class="form-group">
                        <label id="postDesc" for="exampleInputPassword1"><?php echo $idiomes["DESCRIPTION"] ?></label>
                        <p><small id="max">150 max</small></p>

                        <input type="text" class="form-control" name="desc" required id="exampleInputPassword1" maxlength="150" placeholder="<?php echo $idiomes["DESCRIPTION"] ?>">
                    </div>
                    <div class="col-12 text-center">
                        <button type="submit" class="btn post"><strong><?php echo $idiomes["PUBLISH"] ?></strong></button>
                    </div>
                </form>
            </div>
            <div class="col-md-5 col-10 mx-auto position-relative pre" id="post">
                <div class="col-12 cap text-center">
                    <h4><?php echo $idiomes["PREVIEW"] ?></h4>
                    <div class="underline mx-auto"></div>
                </div>

                <div class="row view">
                    <div id="preview" style="height:300px" class="text-center mx-1 mt-1 col-12">
                        <img src="img/img.png" id="imgPost" />
                    </div>
                    <div class="alert alert-dark mx-auto mt-1" role="alert">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <nav class="navbar navbar-toggleable-md fixed-bottom navbar-inverse">
        <ul class="navbar-nav col-4">
            <li class="nav-item active">
                <a class="nav-link text-center op" href="post.php" style="color: rgb(38, 38, 38);;"><i class="fas fa-plus-square fa-2x"></i></a>
            </li>
        </ul>
        <a class="navbar-brand active col-4 text-center op" href="home.php" style="color: rgb(38, 38, 38);;"><i class="fas fa-home fa-2x"></i></a>
        <ul class="navbar-nav col-4">
            <li class="nav-item active">
                <a class="nav-link text-center op" href="userPage.php?id=<?php echo $_SESSION['id'] ?>" style="color: rgb(38, 38, 38);;"><i class="fas fa-user fa-2x"></i></a>
            </li>
        </ul>
    </nav>

</body>
<script src="js/post.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
<script>
    $(document).ready(function() {
        $('.dropdown-submenu a.test').on("click", function(e) {
            $(this).next('ul').toggle();
            e.stopPropagation();
            e.preventDefault();
        });
    });
    $('input[name="filter"]').click(function() {
        if(this.value == 'sepia') $('#imgPost').css('filter','sepia(100%)');
        else if(this.value == 'gray') $('#imgPost').css('filter','grayscale(100%)');
        else if(this.value == 'invert') $('#imgPost').css('filter','invert(100%)');
        else if(this.value == 'without') $('#imgPost').css({filter : ''});
})
</script>

</html>