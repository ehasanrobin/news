<?php
include("config.php");
if(empty($_FILES['logo']['name'])){
    $file_name = $_REQUEST['old_logo'];
   

}else{

    $error = array();

    $file_name = $_FILES["logo"]["name"];
    $file_size = $_FILES["logo"]["size"];
    $file_tmp = $_FILES["logo"]["tmp_name"];
    $file_type = $_FILES["logo"]["type"];
    $file_ext = end(explode(".",$file_name));
    $extensions = array("jpeg","jpg","png");

    if(in_array($file_ext,$extensions) === false){

        $error[] = "this extension file is not allowed , please choose jpeg or png file"; 

    }
    if($file_size > 2097152){
        $error[] = "file size should be llower than 2 mb";
    }
    if(empty($error) === true){

        move_uploaded_file($file_tmp,"images/".$file_name);
    }else{
        print_r($error);
        die();
    }
}

$title = mysqli_real_escape_string($connect,$_REQUEST["web_name"]);
$description = mysqli_real_escape_string($connect,$_REQUEST["footerdesc"]);


  $sql = "UPDATE settings SET website_name ='$title',logo ='$file_name',footer_desc = '{$description}'";
 $result = mysqli_query($connect,$sql) or die("query failed.");

 if($result == true){
     header("location: http://localhost/news/admin/settings.php");
 }else{
     echo "Query failed.";
 }


?>