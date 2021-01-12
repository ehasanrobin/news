<div id ="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
            <?php
            include("config.php");
            
            $sql = " SELECT * FROM settings";
                    
                    $result = mysqli_query($connect,$sql) or die("Query failed.");
                    if(mysqli_num_rows($result) > 0 ){     
                    while($row = mysqli_fetch_array($result)){
            
            ?>
                <span><?php echo $row["footer_desc"];?><a href="http://ehasanrobin.netlify.app/">ehasan robin</a></span>
                <?php
                    }
                }
                
                ?>
            </div>
        </div>
    </div>
</div>
</body>
</html>
