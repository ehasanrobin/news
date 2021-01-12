<?php 
include "header.php";
if($_SESSION["user_role"] == 0){
    header("location: http://localhost/news/admin/post.php");
}

if(isset($_REQUEST['submit'])){

    include("config.php");
    $user_id = mysqli_real_escape_string($connect,$_REQUEST["user_id"]);
    $fname = mysqli_real_escape_string($connect,$_REQUEST["f_name"]);
    $lname = mysqli_real_escape_string($connect,$_REQUEST["l_name"]);
    $user = mysqli_real_escape_string($connect,$_REQUEST["username"]);
    $password = mysqli_real_escape_string($connect,md5($_REQUEST["password"]));
    $role = mysqli_real_escape_string($connect,$_REQUEST["role"]);

    $sql = " SELECT * FROM user WHERE user_id = '$user'";
    $result =  mysqli_query($connect,$sql) or die("select query failed.");

    if(mysqli_num_rows($result) > 0){

        echo "<p style='color:red;font-weight:bold;text-align:center;>user name already exsist</p>";
         
    }else{
         
    $sql1 = "UPDATE user SET first_name = '{$fname}', last_name = '{$lname}', username = '{$user}', role = '{$role}' WHERE user_id = '{$user_id}'";
        $result1 = mysqli_query($connect,$sql1) or die("insert query failed.");
        if( $result1 == true){

            header("location: {$hostname}admin/users.php");
        }
    }

}


?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="admin-heading">Modify User Details</h1>
              </div>
              <div class="col-md-offset-4 col-md-4">
              <?php
              include("config.php");

              $user_id = $_REQUEST["id"];

              $sql1 = "SELECT * FROM user WHERE user_id = {$user_id}";
              $result1 = mysqli_query($connect,$sql1) or die("Query failed.");
              if(mysqli_num_rows($result1) > 0 ){
                while($row = mysqli_fetch_array($result1)){
              
              ?>
                  <!-- Form Start -->
                  <form  action="<?php $_SERVER['PHP_SELF']; ?>" method ="POST">
                      <div class="form-group">
                          <input type="hidden" name="user_id"  class="form-control" value="<?php echo $row["user_id"]; ?>" placeholder="" >
                      </div>
                          <div class="form-group">
                          <label>First Name</label>
                          <input type="text" name="f_name" class="form-control" value="<?php echo $row["first_name"]; ?>" placeholder="" required>
                      </div>
                      <div class="form-group">
                          <label>Last Name</label>
                          <input type="text" name="l_name" class="form-control" value="<?php echo $row["last_name"]; ?>" placeholder="" required>
                      </div>
                      <div class="form-group">
                          <label>User Name</label>
                          <input type="text" name="username" class="form-control" value="<?php echo $row["username"]; ?>" placeholder="" required>
                      </div>
                      <div class="form-group">
                          <label>passsword</label>
                          <input type="password" name="password" class="form-control" value="<?php echo $row["password"]; ?>" placeholder="" required>
                      </div>
                      <div class="form-group">
                          <label>User Role</label>
                          <select class="form-control" name="role" value="<?php echo $row['role']; ?>">
                          <?php
                          
                          if($row["role"] == 1){
                            echo '<option value="0" >normal User</option>
                            <option value="1" selected>Admin</option>';
                        }else{
                            echo '<option value="0" selected>normal User</option>
                            <option value="1" >Admin</option>';
                          
                        }
                          ?>
                              
                          </select>
                      </div>
                      <input type="submit" name="submit" class="btn btn-primary" value="Update" required />
                  </form>
                  <?php
                  }
                    }
                  
                  ?>
                  <!-- /Form -->
              </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; ?>
