<?php session_start(); 
header("Location:../profile.html" )
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Title of the document</title>
</head>

<body>
<?php

include("mysql_connect.php");

$id = $_POST['id'];
$pw = $_POST['pw'];
$name = $_POST['name'];
if(isset($_POST['signature'])) $signature = $_POST['signature'];
else $signature = "";

if($id != null && $pw != null && $name != null){

    //註冊
    if($_POST['mode']=="register"){
	
        $sql = "insert into member (id, pw, name, signature) values ('$id', '$pw', '$name', '$signature')";
        if(mysql_query($sql)){

            $_SESSION['id'] = $id;
            echo '註冊成功 自動登入中..';
        }
    }
    else {   

    //修改資料
        $sql = "update member set pw='$pw',name='$name',signature='$signature' where id='$id'";
        if(mysql_query($sql)){

            echo '修改成功';
        }

    }
}

?>
</body>

</html> 