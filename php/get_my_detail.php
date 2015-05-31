<?php session_start(); 

    //回傳個人資料

    $id = $_SESSION['id'];
    session_write_close();

    include("mysql_connect.php");

    $sql = "SELECT * FROM member where id='".trim($id)."'";
    $result = mysql_query($sql);
    $row = mysql_fetch_assoc($result);

    if($row['photo']==null) $row['photo']='user/default.png';
    echo json_encode($row);

?>
