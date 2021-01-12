<?php include "header.php";
if($_SESSION["user_role"] == 0){
    header("location: http://localhost/news/admin/post.php");
}

if(isset($_REQUEST["save"])){
    include("config.php");

   $category = $_REQUEST["cat"];
  

    $sql = "SELECT category_name FROM category WHERE category_name ='$category'";
    $result = mysqli_query($connect,$sql) or die("Query failed.");
    if(mysqli_num_rows($result) > 0){
        echo "<p style='color:red;font-size:20px;font-weight:bold;text-align:center;'>category name already exsist</p>";
    }else{
       $sql1 = "INSERT INTO category (category_name) VALUES ('{$category}')";
        $result1 = mysqli_query($connect,$sql1) or die("insert query failed.");
        if($result1 == true){
            header("location: http://localhost/news/admin/category.php");
        }

    }


}



?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="admin-heading">Add New Category</h1>
              </div>
              <div class="col-md-offset-3 col-md-6">
                  <!-- Form Start -->
                  <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" autocomplete="off">
                      <div class="form-group">
                          <label>Category Name</label>
                          <input type="text" name="cat" class="form-control" placeholder="Category Name" required>
                      </div>
                      <input type="submit" name="save" class="btn btn-primary" value="Save" required />
                  </form>
                  <!-- /Form End -->
              </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; ?>
