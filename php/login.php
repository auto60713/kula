<?php session_start(); 

include("mysql_connect.php");

if(isset($_POST['id'])&&isset($_POST['pw'])) {

    $id = $_POST['id'];
    $pw = $_POST['pw'];

    $sql = "SELECT pw FROM member where id='".trim($id)."'";
    $result = mysql_query($sql);
    
    if (mysql_num_rows($result) > 0) {

        $row = mysql_fetch_assoc($result);

        if( $pw == $row["pw"] ){

            $_SESSION['id'] = $id;
            echo "success";
        }
        else echo "密碼錯誤";
        
    }
    else echo "查無此帳號";
    
}

            
?>
