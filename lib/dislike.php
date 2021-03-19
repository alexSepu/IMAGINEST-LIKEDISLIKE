<?php
    require_once 'connexiopersistent.php';
    require_once 'session.php';
    switch($_POST["type"])
    {
        case 'like':$type = true;break;
        case 'dislike':$type = false;break;
    }
    session_start();
    $photo = getIdpost($_POST["namePhoto"],$db);
    $select = getLikeDislike($_SESSION["id"],$photo["idPost"],$db);
    if($select == 0)
    {
        setLikeDislike($_SESSION['id'],$photo["idPost"],$type,$db);
        updatePost($photo["idPost"],$type,$db);
    }
    else
    {
        if($select["likeDislike"]!= $type)
        {
            updateToPost($_SESSION['id'],$photo["idPost"],$type,$db);
            updatePost($photo["idPost"],$type,$db);
        }
    }
    $row = getDiferentPhoto($photo["idPost"],$db);
    $user = getUser($row["idUser"],$db);
    $like = getLikeDislike($row["idUser"],$row["idPost"],$db);
    if($like == false) $next = 2;
    else
    {
        switch($like["likeDislike"])
        {
           case 1:$next = 1;break;
           case 0:$next = 0;break;
        }
    }
    
    $return_arr = array(
        'photo'=> $row["namePhoto"],
        'description' => $row["description"], 
        "likes" => $row["likes"],
        "dislikes" => $row["dislikes"],
        "date" => $row["datePost"],
        "user" => $user["username"],
        "rating"=>rating($row["likes"],$row["dislikes"]),
        "next" => $next,
    );

    echo json_encode($return_arr);
 ?>