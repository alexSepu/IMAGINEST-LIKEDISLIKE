<?php
    function UpdateLastSign($row,$dbU)
    {
        $sql = "UPDATE `users` set lastSignIn = :dateU WHERE iduser = :idU";
        $update = $dbU->prepare($sql);
        $update->execute(array('dateU' => date("Y/m/d H:i:s"), 'idU' => $row['iduser']));
    }
    function verifyUser ($user,$dbU)
    {
        $sql = "SELECT * FROM `users` where mail = :namemail OR username = :namemail";
        $select = $dbU->prepare($sql);
        $select->execute(array('namemail' => $user));
        return $select;
    }
    function verifyUsername ($username, $dbU)
    {
        $sql = "SELECT * FROM users where username = ?";
        $select = $dbU ->prepare($sql);
        $select->execute(array($username));
        return $select;
    }
    function verifyEmail ($email, $dbU)
    {
        $sql = "SELECT * FROM users where mail = ?";
        $select = $dbU->prepare($sql);
        $select->execute(array($email));

        return $select;
    }
    function verifyCode ($dbU, $mail){
        date_default_timezone_set('Europe/Madrid');
        $sql = "SELECT * FROM users WHERE mail = ? AND active = 0";
        $select = $dbU -> prepare($sql);
        $select -> execute(array($mail));
        $row = $select->fetch(PDO::FETCH_ASSOC);

        return $row;
    }
    function updateActive($dbU,$mail)
    {
        date_default_timezone_set('Europe/Madrid');
        $sql = "UPDATE users set active = 1,activationCode = NULL, activationDate = ? where mail = ?";
        $update = $dbU -> prepare($sql);
        $update -> execute(array(date("Y/m/d H:i:s"),$mail));
    }
    function insertUser($dbU,$mail,$username,$pass,$firstName,$lastName,$date,$code)
    {
        $sql = "INSERT INTO users (mail,username,passHash,userFirstName,userLastName,creationDate,active,activationCode) VALUES (?,?,?,?,?,?,0,?)";
        $insert = $dbU->prepare($sql);
        $insert->execute(array($mail,$username, $pass, $firstName, $lastName,$date,$code));
    }
    function updateResetCode($mail, $dbU, $code)
    {
        $sql = "UPDATE users set resetPassCode = ?, resetPassExpiry = DATE_ADD(NOW(),INTERVAL 30 MINUTE),resetPass = 1 where mail = ?";
        $update = $dbU -> prepare($sql);
        $update -> execute(array($code,$mail));
    }
    function updatePass ($mail, $dbU, $pass)
    {
        $sql = "UPDATE users set resetPassCode = null,passHash= ?, resetPassExpiry = null,resetPass = 0 where mail = ?";
        $update = $dbU -> prepare($sql);
        $update -> execute(array(password_hash($pass,PASSWORD_DEFAULT),$mail));
    }
    function abort($mail, $dbU)
    {
        $sql = "UPDATE users set resetPassCode = null,resetPassExpiry = null,resetPass = 0 where mail = ?";
        $update = $dbU -> prepare($sql);
        $update -> execute(array($mail));
    }
    function savePost($img,$comment,$filter,$idUser,$dbU)
    {
        if($filter == 'sepia') $sql = "INSERT INTO post (namePhoto,description, datePost,idUser,likes,dislikes,sepia,gray,invert) values(?,?,?,?,0,0,1,0,0)";
        else if($filter == 'gray') $sql = "INSERT INTO post (namePhoto,description, datePost,idUser,likes,dislikes,sepia,gray,invert) values(?,?,?,?,0,0,0,1,0)";
        else if($filter == 'invert') $sql = "INSERT INTO post (namePhoto,description, datePost,idUser,likes,dislikes,sepia,gray,invert) values(?,?,?,?,0,0,0,0,1)";
        else $sql = "INSERT INTO post (namePhoto,description, datePost,idUser,likes,dislikes,sepia,gray,invert) values(?,?,?,?,0,0,0,0,0)";
        date_default_timezone_set('Europe/Madrid');
        $insert = $dbU -> prepare($sql);
        $insert -> execute(array($img,$comment,date("Y/m/d H:i:s"),intval($idUser)));
    }
    function getHashtag($postName,$desc,$dbU)
    {
        $patron = "/#[^\s#]*/i";
        preg_match_all($patron,$desc,$array,PREG_PATTERN_ORDER);
        for($i=0;$i<count($array[0]);$i++)
        {
            $res =  isHashtag($array[0][$i],$dbU);
            if($res==false)
            {
                saveHashtag($array[0][$i],$dbU);
            }
            $idHashtag=getIdHashtag($array[0][$i],$dbU);
            $idPost=getIdpost($postName,$dbU);
            saveContain($idHashtag["idHashtag"],$idPost["idPost"],$dbU);
        }
    }
    function isHashtag($hashtag,$dbU)
    {
        $sql = "SELECT * from hashtag where nameHashtag = ?";
        $select = $dbU -> prepare($sql);
        $select -> execute(array($hashtag));
        $row = $select->fetch(PDO::FETCH_ASSOC);
        return $row;
    }
    function saveHashtag($hashtag,$dbU)
    {
        $sql = "INSERT INTO hashtag (nameHashtag) values(?)";
        $insert = $dbU -> prepare($sql);
        $insert -> execute(array($hashtag));
    }

    function saveContain($idHashtag,$idPost,$dbU)
    {
        $sql = "INSERT INTO contain (idHashtag,idPost) values(?,?)";
        $insert = $dbU -> prepare($sql);
        $insert -> execute(array(intval($idHashtag),intval($idPost)));
    }

    function getIdHashtag($hashtag,$dbU)
    {
        $sql = "SELECT * from hashtag where nameHashtag = ?";
        $select = $dbU -> prepare($sql);
        $select -> execute(array($hashtag));
        $row = $select->fetch(PDO::FETCH_ASSOC);
        return $row;
    }

    function getIdpost($post,$dbU)
    {
        $sql = "SELECT idPost FROM post WHERE namePhoto = ?";
        $select = $dbU -> prepare($sql);
        $select -> execute(array($post));
        $row = $select->fetch(PDO::FETCH_ASSOC);
        return $row;
    }
    function getPhotoUser($idUser,$dbU)
    {
        $sql = "SELECT * from post where idUser = ? order by datePost DESC LIMIT 1;";
        $select = $dbU -> prepare($sql);
        $select -> execute(array($idUser));
        $row = $select->fetch(PDO::FETCH_ASSOC);
        return $row;
    }

    function getRandomPhotos($postName,$dbU)
    {
        $sql = "SELECT * FROM post WHERE namePhoto <> ? ORDER BY RAND()";
        $select = $dbU -> prepare($sql);
        $select -> execute(array($postName));
        return $select;
    }
    function getUser($idUser,$dbU){
        $sql = "SELECT * from users where iduser = ?";
        $select = $dbU -> prepare($sql);
        $select -> execute(array($idUser));
        $row = $select->fetch(PDO::FETCH_ASSOC);
        return $row;
    }
    function getRandomPhoto($dbU){
        $sql = "SELECT * FROM post  ORDER BY RAND() LIMIT 1";
        $select = $dbU -> prepare($sql);
        $select -> execute(array());
        $row = $select->fetch(PDO::FETCH_ASSOC);
        return $row;
    }

    function getDiferentPhoto($idPhoto,$dbU)
    {
        $sql = "SELECT * from post where idPost != ? order by Rand() LIMIT 1 ";
        $select = $dbU -> prepare($sql);
        $select -> execute(array($idPhoto));
        $row = $select->fetch(PDO::FETCH_ASSOC);
        return $row;
    }
    function getLikeDislike ($idUser,$idPost,$dbU)
    {
        $sql = "SELECT * from toPost where idUser = ? AND idPost = ? LIMIT 1";
        $select = $dbU -> prepare($sql);
        $select -> execute(array($idUser,$idPost));
        $row = $select->fetch(PDO::FETCH_ASSOC);
        return $row;
    }
    function setLikeDislike($idUser,$idPost,$type,$dbU)
    {
        $sql = "INSERT INTO toPost values (?,?,?)";
        $insert = $dbU -> prepare($sql);
        $insert -> execute(array($idUser,$idPost,$type));
    }
    function updatePost($idPost,$type,$dbU)
    {
        if($type==true) $sql = "UPDATE post set likes = likes + 1 where idPost = ?";
        else $sql = "UPDATE post set dislikes = dislikes + 1 where idPost = ?";
        $select = $dbU -> prepare($sql);
        $select -> execute(array($idPost));
    }
    function updateToPost($idUser,$idPost,$type,$dbU)
    {
        $sql = "UPDATE topost set likeDislike = ? where idPost = ? AND idUser = ?";
        $select = $dbU -> prepare($sql);
        $select -> execute(array($type,$idPost,$idUser));
    }
    function getPhotosUser($idUser,$dbU)
    {
        $sql = "SELECT * from post where idUser = ? Order by datePost DESC";
        $select = $dbU -> prepare($sql);
        $select -> execute(array($idUser));
        return $select;
    }
    function rating($likes,$dislikes){
        if($likes == 0) $res = 0;
        else $res = intval(($likes/($likes+$dislikes))*5);
        return $res;
    }
    function printRating($likes,$dislikes)
    {
        if($likes == 0) print0Rating();
        else{
            $rat = rating($likes,$dislikes);
            for($i=1;$i<=$rat;$i++) echo "<i class='fas fa-star fa-lg'></i>";
            for($j=$i;$j<=5;$j++) echo "<i class='far fa-star fa-lg'></i>";
        } 
    }
    function print0Rating(){
        for($j=1;$j<=5;$j++) echo "<i class='far fa-star fa-lg'></i>";
    }
    function printDescription($description,$dbU){
        $desc = explode(" ", $description);
        foreach ($desc as $arr) {
            if ($arr != "") {
                if ($arr[0] === '#'){
                     $hashtag = getIdHashtag($arr,$dbU);
                     echo "<a style='color:#013156' href='postHashTag.php".$hashtag["idHashtag"]."'> $arr </a>";
                }
                else echo "$arr ";
            }
        }
    }
    function getPhotoHashtag($hashtag,$dbU)
    {
        $idHashtag=getIdHashtag($hashtag,$dbU);
        $select=getIdpostContain($idHashtag["idHashtag"],$dbU);
        while($row = $select->fetch(PDO::FETCH_ASSOC))
        {
            $photo=getPhotoById($row['idPost'],$dbU);
            echo "<div class='col-md-3 col-sm-5 col-12 text-justify p-3 mt-4'>
            <img class='userPost' src='pujades/" . $photo['namePhoto'] . ".png'/>";
            echo "<div class='likes col-12'>
                 <div class='row'>
                    <div class='col-6 text-center'>
                        <small>" . $photo["likes"] . " likes <i style='color:green' class='fas fa-thumbs-up fa-lg'></i></small>
                    </div>
                    <div class='col-6 text-center'>
                        <small>" . $photo["dislikes"] . " dislikes <i style='color:red' class='fas fa-thumbs-down fa-lg'></i></small>
                    </div>
                </div>
                </div>
            </div>
            <div class='col-1'></div>";
        }
    }

    function getIdpostContain($idHashtag,$dbU)
    {
        $sql = "SELECT idPost FROM contain WHERE idHashtag = ?";
        $select = $dbU -> prepare($sql);
        $select -> execute(array($idHashtag));
        return $select;
    }
    function getPhotoById($idPost,$dbU)
    {
        $sql = "SELECT * from post where idPost = ? order by datePost DESC LIMIT 1;";
        $select = $dbU -> prepare($sql);
        $select -> execute(array($idPost));
        $row = $select->fetch(PDO::FETCH_ASSOC);
        return $row;
    }
    function getHashtagById($idHashtag,$dbU)
    {
        $sql = "SELECT * from hashtag where idHashtag = ?;";
        $select = $dbU -> prepare($sql);
        $select -> execute(array($idHashtag));
        $row = $select->fetch(PDO::FETCH_ASSOC);
        return $row;
    }
    function getRandomUsers($dbU){
        $sql = "SELECT * from users ORDER BY RAND()";
        $select = $dbU -> prepare($sql);
        $select -> execute();

        return $select;
    }
    
