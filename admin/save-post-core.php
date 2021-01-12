<?php
include("config.php");
if(isset($_FILES["fileToUpload"])){
    $error = array();

    $file_name = $_FILES["fileToUpload"]["name"];
    $file_size = $_FILES["fileToUpload"]["size"];
    $file_tmp = $_FILES["fileToUpload"]["tmp_name"];
    $file_type = $_FILES["fileToUpload"]["type"];
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
    if(empty($error) === true){

        move_uploaded_file($file_tmp,$target);
    }else{
        print_r($error);
        die();
    }

}
session_start();
$title = mysqli_real_escape_string($connect,$_REQUEST["post_title"]);
$description = mysqli_real_escape_string($connect,$_REQUEST["postdesc"]);
$category = mysqli_real_escape_string($connect,$_REQUEST["category"]);
$date = date("d M Y ");
$author = $_SESSION["user_id"];


$sql = "INSERT INTO post(title,description, category,post_date,author,post_img) 
        VALUES ('{$title}','{$description}',{$category},'{$date}',{$author},'$new_name');";

$sql .= "UPDATE category set post = post +1 WHERE category_id = {$category}";

if(mysqli_multi_query($connect,$sql)){

    header("location: http://localhost/news/admin/post.php");

}else{
    echo "<div class='alert alert-danger'>Query failed.</div>";
}

?>