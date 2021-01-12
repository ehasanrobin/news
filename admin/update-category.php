<?php include "header.php";
if($_SESSION["user_role"] == 0){
    header("location: http://localhost/news/admin/post.php");
}

if(isset($_REQUEST["sumbit"])){
    include("config.php");

   $category_id = $_REQUEST["cat_id"];
   $category = $_REQUEST["cat_name"];
  

    $sql = "SELECT category_name FROM category WHERE category_name ='$category'";
    $result = mysqli_query($connect,$sql) or die("Query failed.");
    if(mysqli_num_rows($result) > 0){
        echo "<p style='color:red;font-size:20px;font-weight:bold;text-align:center;'>category name already exsist</p>";
    }else{
         $sql1 = "UPDATE category SET category_name =' $category' WHERE category_id ='$category_id'";
         $result1 = mysqli_query($connect,$sql1) or die("Query failed.");
  
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
                  <h1 class="adin-heading"> Update Category</h1>
              </div>
              <div class="col-md-offset-3 col-md-6">
              <?php 
              include ("config.php");
              $c_id = $_REQUEST["cid"];
              $sql1 = "SELECT * FROM category WHERE category_id ='$c_id'";
              $result1 = mysqli_query($connect,$sql1) or die("Query failed.");
            
                  if(mysqli_num_rows($result1) > 0){
                     while($row = mysqli_fetch_array($result1)){
                
                ?>
                  <form action="<?PHP $_SERVER['PHP_SELF']; ?>" method ="POST">
                      <div class="form-group">
                          <input type="hidden" name="cat_id"  class="form-control" value="<?php echo $row['category_id']; ?>" placeholder="">
                      </div>
                      <div class="form-group">
                          <label>Category Name</label>
                          <input type="text" name="cat_name" class="form-control" value="<?php echo $row['category_name']; ?>"  placeholder="" required>
                      </div>
                      <input type="submit" name="sumbit" class="btn btn-primary" value="Update" required />
                  </form>
                  <?php }
                            }
                            ?>
                </div>
              </div>
            </div>
          </div>
<?php include "footer.php"; ?>
