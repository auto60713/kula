<?php session_start(); 
//此php檢查SESSION是否登入中

if(isset($_SESSION["id"])) echo "login";
?>
