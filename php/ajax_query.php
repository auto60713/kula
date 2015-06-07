<?php session_start(); 
//此php放ajax相關的query


switch ($_POST['mode']) {

    case 1:
    //檢查帳號是否已被註冊
        echo check_id_repeat();
    break;

    case 2:
    //發文
        echo creat_article();
    break;

    case 3:
    //文章照片
        echo photos("art");
    break;

    case 4:
    //所有照片
        echo photos("all");
    break;
  
}


function check_id_repeat(){

    include("mysql_connect.php");

    $sql = "SELECT id FROM member where id='".trim($_POST['id'])."'";
    $result = mysql_query($sql);
    
    if (mysql_num_rows($result) > 0){

         echo "repeat";
    }
    else echo "none";
  
}


function photos($sel){

    include("mysql_connect.php");

    $userid = trim($_SESSION['id']);

    if($sel=="art") $sql = "SELECT photo_path FROM photo where article_no='".trim($_POST['article_no'])."' ORDER BY no DESC";
    else $sql = "SELECT article_title title,photo_path path FROM photo where author='".$userid."' ORDER BY no DESC";

    $result = mysql_query($sql);
    
    if (mysql_num_rows($result) > 0){

        $photos = array();
    
        while($row = mysql_fetch_assoc($result)) {
            $photos[] = $row;
        }
        echo json_encode($photos);
    }
    else echo 0;
  
}

function creat_article(){

    include("mysql_connect.php");

    $photo = str_replace("/",",",$_POST['photo']);
    date_default_timezone_set("Asia/Taipei"); 
    $datetime = date("Y-m-d | g:i a");
    $sql = "insert into article (author,title,datetime,cont) values ('".$_SESSION['id']."','".$_POST['title']."','".$datetime."','".$_POST['cont']."')";

    if(mysql_query($sql)){

        $article = mysql_insert_id();

        $sql = "update photo set article_no='".$article."',article_title='".$_POST['title']."' where no in (".$photo.")";
        mysql_query($sql);
        $sql = "update member set last_art='".$article."' where id = '".$_SESSION['id']."'";
        mysql_query($sql);
    }

}

            
?>
