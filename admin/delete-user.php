<?php
if($_SESSION["user_role"] == 0){
    header("location: http://localhost/news/admin/post.php");
}
include("config.php");

$user_id = $_REQUEST["id"];

$sql = " DELETE FROM user WHERE user_id = {$user_id}";
$result = mysqli_query($connect,$sql) or die("Query failed");

if($result == true){

    header("location: {$hostname}admin/users.php");
}else{
    echo "can't delete";
}
 mysqli_close($connect);

?>