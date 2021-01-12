<?php
if($_SESSION["user_role"] == 0){
    header("location: http://localhost/news/admin/post.php");
}


include("config.php");


$cid = $_REQUEST["cid"];

$sql = " DELETE FROM category WHERE category_id = {$cid}";
$result = mysqli_query($connect,$sql) or die("Query failed");

if($result == true){

    header("location: http://localhost/news/admin/category.php");
}else{
    echo "can't delete";
}
 mysqli_close($connect);


?>