<?php include("include/function.php") ?>
<?php include("include/db.php") ?>
<?php include("include/admin_header.php") ?>
    <!--header end-->
    <!-- **********************************************************************************************************************************************************
        MAIN SIDEBAR MENU
        *********************************************************************************************************************************************************** -->
    <!--sidebar start-->
    <?php include("include/admin_sidebar.php") ?>
    <!--sidebar end-->
    <!-- **********************************************************************************************************************************************************
        MAIN CONTENT
        *********************************************************************************************************************************************************** -->
    <!--main content start-->
   <?php delete_user() ?>
    <section id="main-content">
      <section class="wrapper">
        <div class="row mt">
          <div class="col-lg-12">
            <div class="form-panel">
              <h4><i class="fa fa-angle-right"></i> Users Table</h4>
              <hr>
              <table class="table">
                <thead>
                  <tr>
                    <th>Id</th>
                    <th>Image</th>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Log In Date</th>
                    <th></th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                $query = "SELECT * FROM users";
                $select_users = mysqli_query($connection, $query );
                while($row = mysqli_fetch_assoc($select_users)) { 
                  $user_id        = $row['user_id'];
                  $user_name         = $row['user_name'];
                  $user_email           = $row['user_email'];
                  $user_image            = $row['user_img'];
                  $user_password         = $row['user_password'];
                  $login_date            = $row['login_date'];
                  ?>
                  <tr>
                  <td><?php echo $user_id  ?></td>
                    <td> <img width="100" src="../image/<?php echo $user_image; ?>" alt=""> </td>
                    <td><?php echo $user_name  ?></td>
                    <td><?php echo $user_email  ?></td>
                    <td><?php echo $login_date  ?></td>
                    <td><a href='manage_users.php?source=edit_user&edit=<?php echo $user_id ?>' class="btn btn-theme">edit</a></td>
                  <td><a href='manage_users.php?delete=<?php echo $user_id ?>'class="btn btn-danger">delete</a></td>
                  </tr>
                <?php }?>
                </tbody>
              </table>
            </div>
            <?php
                            if(isset($_GET['source'])){
                                $source= $_GET['source'];

                            }else{
                                $source= "";
                            }
                            switch ($source) {
                                
                                case "edit_user":
                                    include "include/edit_user.php";
                                    break;
                                
                                
                                default:
                                    
                                    break;
                            }
                        ?>
          </div>
        </div>

      </section>
      <!-- /wrapper -->
    </section>
      <!--main content end-->
    <!--footer start-->
    <?php include("include/admin_footer.php") ?>