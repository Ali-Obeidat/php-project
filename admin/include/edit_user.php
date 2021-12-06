<?php 
    $id =$_GET['edit'];
    $query = "SELECT * FROM users WHERE user_id = $id";
   $update_user = mysqli_query($connection, $query );
       $row = mysqli_fetch_assoc($update_user); 
       $user_name = $row['user_name'];    
       $user_email = $row['user_email'];    
       $user_password= $row['user_password'];
       $user_img = $row['user_img'];
       
   
   ?>
    <?php
    // update category
       if (isset($_POST['update'])){
        $user_name         = $_POST['user_name'];
        $user_email        = $_POST['email'];
        $user_image        = $_FILES['image']['name'];
        $user_image_temp   = $_FILES['image']['tmp_name'];
        $user_password     = $_POST['password'];
        if (empty($user_name)) {
          $name_err= "Please fill this field";
          $name_status= false ;
        }elseif (!preg_match("/^[a-zA-Z-' ]*$/",$user_name)) {
          $name_err = "Only letters and white space allowed";
          $name_status= false ;
        }else{
          $name_status= true ;
        }
        if ($user_email == "" || empty($user_email)) {
          $emailErr= " This field should not be empty";
      } else{
        $email_status= true ;
      }
      if ($user_password == "" || empty($user_password)) {
        $passErr= " This field should not be empty";
      }else{
        $pass_status= true ;
      }
      if ($user_image == "" || empty($user_image)) {
        $query = "SELECT * FROM users WHERE user_id = $id";
            $select_img = mysqli_query($connection, $query );
            while($row = mysqli_fetch_assoc($select_img)){
                $user_image = $row['user_img'];
            }
      }
        if ($name_status== true && $email_status== true && $pass_status== true  ) {
            move_uploaded_file($user_image_temp, "../image/$user_image" );
            $query = "UPDATE users SET user_img = '$user_image', user_name = '$user_name',
            user_email = '$user_email' ,user_password ='$user_password' WHERE user_id = $id ";
            $result = mysqli_query($connection, $query);
            header("Location:manage_users.php");
            if(!$result) {
                die("QUERY FAILED" . mysqli_error($connection));    
            }
        }
     } 

?>
<h4><i class="fa fa-angle-right"></i> Edit User</h4>
                                <div class="form-panel">
                                <form role="form" class="form-horizontal style-form" method="post" enctype="multipart/form-data">
                                    <div class="form-group ">
                                      <label class="col-lg-2 control-label">User Name</label>
                                      <div class="col-lg-10">
                                        <input type="text"value="<?php echo $user_name ?>" cid="admin_name" name="user_name" class="form-control">
                                        <p class="help-block" style="color:red;"><?php global $name_err; echo $name_err ?></p>
                                      </div>
                                    </div>
                                    <div class="form-group ">
                                      <label class="col-lg-2 control-label">Email</label>
                                      <div class="col-lg-10">
                                        <input type="email" value="<?php echo $user_email ?>"  id="email2" name="email" class="form-control">
                                        <p class="help-block" style="color:red;"><?php global $emailErr; echo $emailErr ?></p>
                                      </div>
                                    </div>
                                    <div class="form-group ">
                                      <label class="col-lg-2 control-label">Password</label>
                                      <div class="col-lg-10">
                                        <input type="password" name="password" value="<?php echo $user_password ?>"  id="l-name" class="form-control">
                                        <p class="help-block" style="color:red;"><?php global $passErr; echo $passErr ?></p>
                                      </div>
                                    </div>
                                    <div class="form-group last">
                                      <label class="col-lg-2 control-label">Image Upload</label>
                                      <div class="col-md-9">
                                        <div class="fileupload fileupload-new" data-provides="fileupload">
                                          <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
                                            <img src="../image/<?php echo $user_img ?>" alt="" />
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
                                       <a href="manage_users.php" class="btn btn-danger">Close</a> 
                                      </div>
                                    </div>

                                  </form>
                                  </div>