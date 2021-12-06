<?php 
    $id =$_GET['edit'];
    $query = "SELECT * FROM admins WHERE admin_id = $id";
   $update_admin = mysqli_query($connection, $query );
       $row = mysqli_fetch_assoc($update_admin); 
       $admin_name = $row['admin_name'];    
       $admin_email = $row['admin_email'];    
       $admin_password= $row['admin_password'];
       $admin_img = $row['admin_img'];
       
   
   ?>
   <?php
    // update category
       if (isset($_POST['update'])){
        $admin_name         = $_POST['admin_name'];
        $admin_email        = $_POST['email'];
        $admin_image        = $_FILES['image']['name'];
        $admin_image_temp   = $_FILES['image']['tmp_name'];
        $admin_password     = $_POST['password'];
        if (empty($admin_name)) {
          $name_err= "Please fill this field";
        }elseif (!preg_match("/^[a-zA-Z-' ]*$/",$admin_name)) {
          $name_err = "Only letters and white space allowed";
        }else{
          $name_status= true ;
        }
        if ($admin_email == "" || empty($admin_email)) {
          $emailErr= " This field should not be empty";
      } else{
        $email_status= true ;
      }
      if ($admin_password == "" || empty($admin_password)) {
        $passErr= " This field should not be empty";
      }else{
        $pass_status= true ;
      }
      if ($admin_image == "" || empty($admin_image)) {
        $query = "SELECT * FROM admins WHERE admin_id = $id";
            $select_img = mysqli_query($connection, $query );
            while($row = mysqli_fetch_assoc($select_img)){
                $admin_image = $row['admin_img'];
            }
      }
        if ($name_status== true && $email_status== true && $pass_status== true  ) {
            move_uploaded_file($admin_image_temp, "../image/$admin_image" );
            $query = "UPDATE admins SET admin_img = '$admin_image', admin_name = '$admin_name',
            admin_email = '$admin_email' ,admin_password ='$admin_password' WHERE admin_id = $id ";
            $result = mysqli_query($connection, $query);
            if(!$result) {
                die("QUERY FAILED" . mysqli_error($connection));    
            }
        }
     } 

?>


<h4><i class="fa fa-angle-right"></i> Update Admin</h4>
                                <div class="form-panel">
                                <form role="form" class="form-horizontal style-form" method="post" enctype="multipart/form-data">
                                    <div class="form-group ">
                                      <label class="col-lg-2 control-label">Admin Name</label>
                                      <div class="col-lg-10">
                                        <input type="text"value="<?php echo $admin_name ?>" cid="admin_name" name="admin_name" class="form-control">
                                        <p class="help-block" style="color:red;"><?php global $name_err; echo $name_err ?></p>
                                      </div>
                                    </div>
                                    <div class="form-group ">
                                      <label class="col-lg-2 control-label">Email</label>
                                      <div class="col-lg-10">
                                        <input type="email" value="<?php echo $admin_email ?>"  id="email2" name="email" class="form-control">
                                        <p class="help-block" style="color:red;"><?php global $emailErr; echo $emailErr ?></p>
                                      </div>
                                    </div>
                                    <div class="form-group ">
                                      <label class="col-lg-2 control-label">Password</label>
                                      <div class="col-lg-10">
                                        <input type="password" name="password" value="<?php echo $admin_password ?>"  id="l-name" class="form-control">
                                        <p class="help-block" style="color:red;"><?php global $passErr; echo $passErr ?></p>
                                      </div>
                                    </div>
                                    <div class="form-group last">
                                      <label class="col-lg-2 control-label">Image Upload</label>
                                      <div class="col-md-9">
                                        <div class="fileupload fileupload-new" data-provides="fileupload">
                                          <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
                                            <img src="../image/<?php echo $admin_img ?>" alt="" />
                                          </div>
                                          <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                                          <div>
                    
                                            <input class="btn btn-theme02 btn-file" fileupload-new fa fa-paperclip type="file" class="default" value="Select image"  name="image" />
                                            <p class="help-block" style="color:red;"><?php global $imgErr; echo $imgErr ?></p>
                                          </div>
                                        </div>
                                        
                                      </div>
                                    </div>
                                    <div class="form-group  row" >
                                      <div class="col-lg-offset-2 col-lg-1">
                                        <button class="btn btn-theme" type="submit" name="update">Submit</button>
                                      </div>
                                      <div class=" col-lg-1">
                                       <a href="manage_admin.php" class="btn btn-danger">Close</a> 
                                      </div>
                                    </div>

                                  </form>
                                  </div>

                                
                                  
                               