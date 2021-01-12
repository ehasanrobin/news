<?php include "header.php";
if($_SESSION["user_role"] == 0){
    header("location: http://localhost/news/admin/post.php");
}




?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="admin-heading">Add User</h1>
              </div>
              <div class="col-md-offset-3 col-md-6">
              <?php  
              if(isset($_REQUEST['save'])){

                include("config.php");
            
                $fname = mysqli_real_escape_string($connect,$_REQUEST["fname"]);
                $lname = mysqli_real_escape_string($connect,$_REQUEST["lname"]);
                $user = mysqli_real_escape_string($connect,$_REQUEST["user"]);
                $password = mysqli_real_escape_string($connect,md5($_REQUEST["password"]));
                $role = mysqli_real_escape_string($connect,$_REQUEST["role"]);
            
                $sql = " SELECT username FROM user WHERE username = '$user'";
                $result =  mysqli_query($connect,$sql) or die("select query failed.");
            
                if(mysqli_num_rows($result) > 0){
            
                    echo "<p style='text-transform:uppercase;color:red;font-size:20px;font-weight:bold;text-align:center;'>username already exsist</p>";
                     
                }else{
                     
                    $sql1 = "INSERT INTO user (first_name, last_name, username, password, role)VALUES ('{$fname}','{$lname}','{$user}','$password','$role')";
                    $result1 = mysqli_query($connect,$sql1) or die("insert query failed.");
                    if( $result1 == true){
            
                        header("location: {$hostname}admin/users.php");
                    }
                }
            
            }
            
              
              ?>
                  <!-- Form Start -->
                  <form  action="<?php $_SERVER["PHP_SELF"]; ?>" method ="POST" autocomplete="off">
                      <div class="form-group">
                          <label>First Name</label>
                          <input type="text" name="fname" class="form-control" placeholder="First Name" required>
                      </div>
                          <div class="form-group">
                          <label>Last Name</label>
                          <input type="text" name="lname" class="form-control" placeholder="Last Name" required>
                      </div>
                      <div class="form-group">
                          <label>User Name</label>
                          <input type="text" name="user" class="form-control" placeholder="Username" required>
                      </div>

                      <div class="form-group">
                          <label>Password</label>
                          <input type="password" name="password" class="form-control" placeholder="Password" required>
                      </div>
                      <div class="form-group">
                          <label>User Role</label>
                          <select class="form-control" name="role" >
                              <option value="0">Normal User</option>
                              <option value="1">Admin</option>
                          </select>
                      </div>
                      <input type="submit"  name="save" class="btn btn-primary" value="Save" required />
                  </form>
                   <!-- Form End-->
               </div>
           </div>
       </div>
   </div>
<?php include "footer.php"; ?>
