<?php include("include/db.php") ?>
<!-- <?php
      /*
if (!isset($_SESSION['adminLogin'])) {
  header("location: ../login.php");
}*/ ?> -->
<?php include("include/function.php") ?>
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
<!--main content start-->
<?php
$query = "SELECT * FROM admins WHERE admin_id ='{$_SESSION['adminLogin']}' ";
$select_admin = mysqli_query($connection, $query);
$row = mysqli_fetch_assoc($select_admin);
$admin_id        = $row['admin_id'];
$admin_name         = $row['admin_name'];
$admin_email           = $row['admin_email'];
$admin_password =     $row['admin_password'];
$admin_image            = $row['admin_img'];
?>
<?php
// update category
if (isset($_POST['update'])) {
  $admin_name         = $_POST['admin_name'];
  $admin_email        = $_POST['email'];
  $admin_image        = $_FILES['image']['name'];
  $admin_image_temp   = $_FILES['image']['tmp_name'];
  $admin_password     = $_POST['password'];
  if (empty($admin_name)) {
    $name_err = "Please fill this field";
  } elseif (!preg_match("/^[a-zA-Z-' ]*$/", $admin_name)) {
    $name_err = "Only letters and white space allowed";
  } else {
    $name_status = true;
  }
  if ($admin_email == "" || empty($admin_email)) {
    $emailErr = " This field should not be empty";
  } else {
    $email_status = true;
  }
  if ($admin_password == "" || empty($admin_password)) {
    $passErr = " This field should not be empty";
  } else {
    $pass_status = true;
  }
  if ($admin_image == "" || empty($admin_image)) {
    $query = "SELECT * FROM admins WHERE admin_id = '{$_SESSION['adminLogin']}'";
    $select_img = mysqli_query($connection, $query);
    while ($row = mysqli_fetch_assoc($select_img)) {
      $admin_image = $row['admin_img'];
    }
  }
  if ($name_status == true && $email_status == true && $pass_status == true) {
    move_uploaded_file($admin_image_temp, "../image/$admin_image");
    $query = "UPDATE admins SET admin_img = '$admin_image', admin_name = '$admin_name',
            admin_email = '$admin_email' ,admin_password ='$admin_password' WHERE admin_id = '{$_SESSION['adminLogin']}' ";
    $result = mysqli_query($connection, $query);
    if (!$result) {
      die("QUERY FAILED" . mysqli_error($connection));
    }
  }
}

?>
<section id="main-content">
  <section class="wrapper site-min-height">
    <div class="row mt">
      <div class="col-lg-12">
        <div class="row content-panel">
          <div class="col-md-2 profile-text mt mb centered">

          </div>
          <!-- /col-md-4 -->
          <div class="col-md-4 profile-text">
            <h3><?php echo $admin_name ?></h3>
            <h4><?php echo $admin_email ?></h4>
            <p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC.</p>
            <br>
          </div>
          <!-- /col-md-4 -->
          <div class="col-md-4 centered">
            <div class="profile-pic">
              <p><img src="../image/<?php echo $admin_image ?>" class="img-circle"></p>
              <p>
                <a class="btn btn-theme" data-toggle="tab" href="#edit">Edit Profile</a>

              </p>
            </div>
          </div>
          <!-- /col-md-4 -->
        </div>
        <!-- /row -->
      </div>
      <!-- /col-lg-12 -->
      <div class="col-lg-12 mt">
        <div class="row content-panel">
          <div class="panel-heading">
            <ul class="nav nav-tabs nav-justified">

              <li>
                <a data-toggle="tab" href="#edit">Edit Profile</a>
              </li>

            </ul>
          </div>
          <!-- /panel-heading -->
          <div class="panel-body">
            <div class="tab-content">


              <div id="edit" class="tab-pane">
                <div class="row">
                  <div class="col-lg-8 col-lg-offset-2 detailed">
                    <h4 class="mb">Edit Personal Information</h4>
                    <div class="form-panel">
                      <form role="form" class="form-horizontal style-form" method="post" enctype="multipart/form-data">
                        <div class="form-group ">
                          <label class="col-lg-2 control-label">Admin Name</label>
                          <div class="col-lg-10">
                            <input type="text" value="<?php echo $admin_name ?>" id="admin_name" name="admin_name" class="form-control">
                            <p class="help-block" style="color:red;"><?php global $name_err;
                                                                      echo $name_err ?></p>
                          </div>
                        </div>
                        <div class="form-group ">
                          <label class="col-lg-2 control-label">Email</label>
                          <div class="col-lg-10">
                            <input type="email" value="<?php echo $admin_email ?>" id="email2" name="email" class="form-control">
                            <p class="help-block" style="color:red;"><?php global $emailErr;
                                                                      echo $emailErr ?></p>
                          </div>
                        </div>
                        <div class="form-group ">
                          <label class="col-lg-2 control-label">Password</label>
                          <div class="col-lg-10">
                            <input type="password" name="password" value="<?php echo $admin_password ?>" id="l-name" class="form-control">
                            <p class="help-block" style="color:red;"><?php global $passErr;
                                                                      echo $passErr ?></p>
                          </div>
                        </div>
                        <div class="form-group last">
                          <label class="col-lg-2 control-label">Image Upload</label>
                          <div class="col-md-9">
                            <div class="fileupload fileupload-new" data-provides="fileupload">
                              <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
                                <img src="../image/<?php echo $admin_image ?>" alt="" />
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
                            <button class="btn btn-theme" type="submit" name="update">Submit</button>
                          </div>
                        </div>

                      </form>

                    </div>
                    <!-- /tab-pane -->
                  </div>
                  <!-- /tab-content -->
                </div>
                <!-- /panel-body -->
              </div>
              <!-- /col-lg-12 -->
            </div>
            <!-- /row -->
          </div>
          <!-- /container -->
  </section>
  <!-- /wrapper -->
</section>


<!--footer start-->
<?php include("include/admin_footer.php") ?>