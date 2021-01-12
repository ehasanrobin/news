<?php
include("config.php");

     $post_id = $_REQUEST['id'];
     $cat_id = $_REQUEST['catId'];
     $sql1 = "SELECT * FROM post WHERE post_id={$post_id};";
     $result1 =mysqli_query($connect,$sql1) or die("Query failed.");
     $row = mysqli_fetch_array($result1);
     unlink('upload/'.$row['post_img']);

    $sql = "DELETE FROM post WHERE post_id={$post_id};";
    $sql .= "UPDATE category SET post = post-1 WHERE category_id={$cat_id}";
    $result = mysqli_multi_query($connect,$sql) or die("Query failed.");
    if($result == true){
        header("location: http://localhost/news/admin/post.php");
    }
?>