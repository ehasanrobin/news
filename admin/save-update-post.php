<?php
include("config.php");
if(empty($_FILES['new-image']['name'])){
    $new_name = $_REQUEST['old-image'];
   

}else{

    $error = array();

    $file_name = $_FILES["new-image"]["name"];
    $file_size = $_FILES["new-image"]["size"];
    $file_tmp = $_FILES["new-image"]["tmp_name"];
    $file_type = $_FILES["new-image"]["type"];
    $file_ext = end(explode(".",$file_name));
    $extensions = array("jpeg","jpg","png");

    if(in_array($file_ext,$extensions) === false){

        $error[] = "this extension file is not allowed , please choose jpeg or png file"; 

    }
    if($file_size > 2097152){
        $error[] = "file size should be llower than 2 mb";
    }
    $new_name = time(). "-".basename($file_name);
    $target = "upload/".$new_name;
    $image_name = $new_name


    if(empty($error) === true){

        move_uploaded_file($file_tmp,$target);
    }else{
        print_r($error);
        die();
    }
}
$post_id = $_REQUEST["post_id"];
$title = mysqli_real_escape_string($connect,$_REQUEST["post_title"]);
$description = mysqli_real_escape_string($connect,$_REQUEST["postdesc"]);
$category = mysqli_real_escape_string($connect,$_REQUEST["category"]);

  $sql = "UPDATE post SET title ='$title',description = '$description',category =$category,post_img ='$image_name'
    WHERE post_id ={$post_id};";
    if($_REQUEST["old_category"] != $_REQUEST["category"]){
        $sql .= "UPDATE category SET post = post-1 WHERE category_id={$_REQUEST["old_category"]};";
        $sql .= "UPDATE category SET post = post+1 WHERE category_id={$_REQUEST["category"]};";
    }
 
 $result = mysqli_multi_query($connect,$sql) or die("query failed.");

 if($result == true){
     header("location: http://localhost/news/admin/post.php");
 }else{
     echo "Query failed.";
 }


?>