<?php session_start();

    include("mysql_connect.php");

    $cover = $_FILES["photo"];  
    $cover_length = count($_FILES["photo"]["name"]);
    $userid= trim($_SESSION['id']);   

    //不存在的話就創建upload資料夾
    $Upload_folder = "user/".$userid."/";
    if (!is_dir("../".$Upload_folder)) mkdir("../".$Upload_folder);

    $all_photo_no = "";

for ($i=0; $i<$cover_length; $i++) { 
      
    if($cover["error"][$i]>0)echo "err,上傳失敗";   
    else{   
        
        // Get the extension name by uploaded filename   
        $extName = substr( $cover["name"][$i],strrpos($cover["name"][$i],".") );   
      
        // only jpg or png file name ( or custom by yourself)   
        if($extName==".jpg" or $extName==".jpeg" or $extName==".png") {   

//上傳大頭照
            if($_POST['mode']=="face"){

                if( move_uploaded_file($cover["tmp_name"][$i], "../".$Upload_folder.$userid.$extName) ){ 

                    $sql = "update member set photo='".$Upload_folder.$userid.$extName."' where id='$userid'";
                    mysql_query($sql);
                    
                    echo $Upload_folder.$userid.$extName.",";    
                } 
                else echo "err,上傳失敗";   
            }
            else{
//文章照片
                $file_name = $Upload_folder.time().$i.$extName;
                if( move_uploaded_file($cover["tmp_name"][$i], "../".$file_name) ){  

                    $sql = "insert into photo (author,article_title,photo_path) values ('$userid','塗鴉牆','$file_name')";
                    if(mysql_query($sql)){

                        //回傳照片編號
                        $photo_no = mysql_insert_id();

                        echo $file_name.",";
                        $all_photo_no .= $photo_no;
                        if($i!=$cover_length-1) $all_photo_no .= "/";
                    }
                } 
                else echo "err,上傳失敗";   
            }
            
        } 
        else echo "err,只支援jpg或png檔";   
       
           
    } 
}
echo $all_photo_no;
?>