<?php include "header.php"; ?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-10">
                  <h1 class="admin-heading">All Posts</h1>
              </div>
              <div class="col-md-2">
                  <a class="add-new" href="add-post.php">add post</a>
              </div>
              <div class="col-md-12">
              <?php
              
              include("config.php"); //    data base configaration

              $limit = 5; //off set caculation
  
              if(isset($_REQUEST["page"])){
                $page = $_REQUEST["page"];
              }else{
                $page = 1;
              }
              $offset = ($page -1) * $limit ; 
              if($_SESSION["user_role"] == 1){
                //   select post for user admin
                $sql = "SELECT * FROM post
                     LEFT JOIN category on  post.category = category.category_id
                     LEFT JOIN user on  post.author = user_id
                     ORDER BY post.post_id   DESC LIMIT {$offset},{$limit}";
            }elseif($_SESSION["user_role"] == 0){
                // select post for normal user
                $sql = "SELECT * FROM post
                     LEFT JOIN category on  post.category = category.category_id
                     LEFT JOIN user on  post.author = user_id
                     WHERE post.author = {$_SESSION["user_id"]}
                     ORDER BY post.post_id   DESC LIMIT {$offset},{$limit}";    
            }
              
              $result = mysqli_query($connect,$sql) or die("Query failed.");
              if(mysqli_num_rows($result) > 0 ){

              ?>
                  <table class="content-table">
                      <thead>
                          <th>S.No.</th>
                          <th>Title</th>
                          <th>Category</th>
                          <th>Date</th>
                          <th>Author</th>
                          <th>Edit</th>
                          <th>Delete</th>
                      </thead>
                      <tbody>
                      <?php
                      $serial = $offset + 1;
                      while($row = mysqli_fetch_array($result)){ ?>
                          <tr>
                              <td class='id'><?php echo $serial; ?></td>
                              <td><?php echo $row["title"]; ?></td>
                              <td><?php echo $row["category_name"]; ?></td>
                              <td><?php echo $row["post_date"]; ?></td>
                              <td><?php echo $row["username"]; ?></td>
                              <td class='edit'><a href='update-post.php?id=<?php echo $row["post_id"]; ?>'><i class='fa fa-edit'></i></a></td>
                              <td class='delete'><a href='delete-post.php?id=<?php echo $row["post_id"]; ?>&catId=<?php echo $row["category"]; ?>'><i class='fa fa-trash-o'></i></a></td>
                          </tr>
                          <?php $serial++;
                        
                        } ?>
                          
                      </tbody>
                  </table>
                  <?php   }
                //   show pagination
                  $sql1 = "SELECT * FROM post";
                  $result1 = mysqli_query($connect,$sql1) or die("Query failed.");
                  if(mysqli_num_rows($result1) > 0){

                    $total_records = mysqli_num_rows($result1);
                   
                    $total_pages = Ceil($total_records/ $limit);

                    echo "<ul class='pagination admin-pagination'>";

                    if($page > 1 ){
                        echo "<li><a href=users.php?page=".($page - 1).">prev</a></li>";
                    }
                    for($i = 1; $i <= $total_pages; $i++){
                        if($i == $page){

                            $active = "active";

                        }else{
                            $active = "";
                        }

                        echo '<li class='.$active.'><a href="post.php?page='.$i.'">'.$i.'</a></li>';
                    }
                    if($total_pages > $page ){
                        echo "<li><a href=post.php?page=".($page + 1).">next</a></li>";
                    }
                    
                    echo '</ul>';

                  }
                  
                  ?>
                  
              </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; ?>
