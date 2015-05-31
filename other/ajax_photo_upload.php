<?php session_start();

    $cover = $_FILES["photo"];  
    $userid= trim($_SESSION['id']);   

    //不存在的話就創建upload資料夾
    $Upload_folder = "user/".$userid."/";
    if (!is_dir("../".$Upload_folder)) mkdir("../".$Upload_folder);
      
    if($cover["error"]>0)echo "err1";   
    else{   
        
        // Get the extension name by uploaded filename   
        $extName = substr( $cover["name"],strrpos($cover["name"],".") );   
      
        // only jpg or png file name ( or custom by yourself)   
        if($extName==".jpg" or $extName==".jpeg" or $extName==".png") {   
            if( move_uploaded_file($cover["tmp_name"], "../".$Upload_folder.$userid.$extName) ){  


                include("mysql_connect.php");
                $sql = "update member set photo='".$Upload_folder.$userid.$extName."' where id='$userid'";
                mysql_query($sql);
                    
                echo $Upload_folder.$userid.$extName;    
            } 
            else echo "err2";   
        } 
        else echo "只支援jpg或png檔";   
       
           
    } 


?>