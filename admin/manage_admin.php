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
<section id="main-content">
  <section class="wrapper">
    <h3><i class="fa fa-angle-right"></i> Manage Admins</h3>
    <!-- BASIC FORM VALIDATION -->
    <?php
    // add admins
    add_admin();

    delete_admin();
    ?>


    <div class="row mt">
      <div class="col-lg-12">
        <?php
        if (isset($_GET['source'])) {
          $source = $_GET['source'];
        } else {
          $source = "";
        }
        switch ($source) {
          case "edit_admin":
            include "include/edit_admin.php";
            break;
          default:
        ?>
            <h4><i class="fa fa-angle-right"></i> Add Admin</h4>
            <div class="form-panel">
              <form role="form" class="form-horizontal style-form" method="post" enctype="multipart/form-data">
                <div class="form-group ">
                  <label class="col-lg-2 control-label">Admin Name</label>
                  <div class="col-lg-10">
                    <input type="text" placeholder="" id="admin_name" name="admin_name" class="form-control">
                    <p class="help-block" style="color:red;"><?php global $name_err;
                                                              echo $name_err ?></p>
                  </div>
                </div>
                <div class="form-group ">
                  <label class="col-lg-2 control-label">Email</label>
                  <div class="col-lg-10">
                    <input type="email" placeholder="" id="email2" name="email" class="form-control">
                    <p class="help-block" style="color:red;"><?php global $emailErr;
                                                              echo $emailErr ?></p>
                  </div>
                </div>
                <div class="form-group ">
                  <label class="col-lg-2 control-label">Password</label>
                  <div class="col-lg-10">
                    <input type="password" name="password" placeholder="" id="l-name" class="form-control">
                    <p class="help-block" style="color:red;"><?php global $passErr;
                                                              echo $passErr ?></p>
                  </div>
                </div>
                <div class="form-group last">
                  <label class="col-lg-2 control-label">Image Upload</label>
                  <div class="col-md-9">
                    <div class="fileupload fileupload-new" data-provides="fileupload">
                      <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
                        <img src="../image/<?php $admin_image ?>" alt="" />
                      </div>
                      <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                      <div>

                        <input class="btn btn-theme02 btn-file" fileupload-new fa fa-paperclip type="file" class="default" value="Select image" name="image" />
                        <p class="help-block" style="color:red;"><?php global $imgErr;
                                                                  echo $imgErr ?></p>
                      </div>
                    </div>

                  </div>
                </div>
                <div class="form-group">
                  <div class="col-lg-offset-2 col-lg-10">
                    <button class="btn btn-theme" type="submit" name="add_admin">Submit</button>
                  </div>
                </div>

              </form>

            </div>
        <?php
            break;
        }
        ?>

        <!-- /form-panel -->

        <div class="form-panel">
          <h4><i class="fa fa-angle-right"></i> Admin Table</h4>
          <hr>
          <table class="table">
            <thead>
              <tr>
                <th>Id</th>
                <th>Image</th>
                <th>Full Name</th>
                <th>Email</th>
                <th>Password</th>
                <th>Log In Date</th>
                <th></th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <?php
              $query = "SELECT * FROM admins";
              $select_admin = mysqli_query($connection, $query);
              while ($row = mysqli_fetch_assoc($select_admin)) {
                $admin_id        = $row['admin_id'];
                $admin_name         = $row['admin_name'];
                $admin_email           = $row['admin_email'];
                $admin_image            = $row['admin_img'];
                $admin_password         = $row['admin_password'];
                $login_date            = $row['login_date'];
              ?>
                <tr>
                  <td><?php echo $admin_id  ?></td>
                  <td> <img width="100" src="../image/<?php echo $admin_image; ?>" alt=""> </td>
                  <td><?php echo $admin_name  ?></td>
                  <td><?php echo $admin_email  ?></td>
                  <td><?php echo $admin_password  ?></td>
                  <td><?php echo $login_date  ?></td>
                  <td><a href='manage_admin.php?source=edit_admin&edit=<?php echo $admin_id ?>' class="btn btn-theme">edit</a></td>
                  <td><a href='manage_admin.php?delete=<?php echo $admin_id ?>' class="btn btn-danger">delete</a></td>
                </tr>
              <?php } ?>
            </tbody>
          </table>

        </div>
        <!-- /col-md-12 -->

      </div>
      <!-- /col-lg-12 -->

    </div>

  </section>
  <!-- /wrapper -->
</section>
<!--main content end-->
<!--footer start-->
<?php include("include/admin_footer.php") ?>