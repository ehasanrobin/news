<?php include "header.php";

?>
  <div id="admin-content">
      <div class="container">
         <div class="row">
             <div class="col-md-12">
                 <h1 class="admin-heading">Add New Post</h1>
             </div>
              <div class="col-md-offset-3 col-md-6">
              <?php
                include("config.php");
            
                $sql = " SELECT * FROM settings";
                        
                        $result = mysqli_query($connect,$sql) or die("Query failed.");
                        if(mysqli_num_rows($result) > 0 ){     
                        while($row = mysqli_fetch_array($result)){    
    ?>
                  <!-- Form -->
                  <form  action="save-setting-core.php" method="POST" enctype="multipart/form-data">
                      <div class="form-group">
                          <label for="post_title">Website name</label>
                          <input type="text" name="web_name" value="<?php echo $row["website_name"]; ?>" class="form-control" autocomplete="off" required>
                      </div>
                      <div class="form-group">
                          <label for="exampleInputPassword1">Post image</label>
                          <input type="file" name="logo" required>
                          <img class="logo_img"  src="images/<?php echo $row["logo"]; ?>" height="150px">
                          <input type="hidden" name="old_logo" value="<?php echo $row["logo"]; ?>">
                      </div>
                      <div class="form-group">
                          <label for="exampleInputPassword1">Footer  Description</label>
                          <textarea name="footerdesc" value="" class="form-control" rows="5"  required><?php echo $row["footer_desc"]; ?></textarea>
                      </div>
                      
                      <input type="submit" name="submit" class="btn btn-primary" value="Save" required />
                  </form>
                        <?php
                         }
                        }
                        
                        ?>
                  <!--/Form -->
              </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; ?>