<?php 
        $id =$_GET['edit'];
        $query = "SELECT * FROM categories WHERE category_id = $id";
        $update_admin = mysqli_query($connection, $query );
        $row = mysqli_fetch_assoc($update_admin); 
        $category_name = $row['category_name'];    
         $category_img = $row['category_img'];
       
         if(isset($_POST['edit_category'])) {
            $category_name         = $_POST['category_name'];
            $category_image        = $_FILES['image']['name'];
            $admin_image_temp      = $_FILES['image']['tmp_name'];
            if (empty($category_name)) {
              $category_err= "Please fill this field";
              $category_status= false ;
            }elseif (!preg_match("/^[a-zA-Z-' ]*$/",$category_name)) {
              $category_err = "Only letters and white space allowed";
              $category_status= false ;
            }else{
              $category_status= true ;
            }

            if ($category_image == "" || empty($category_image)) {
                $query = "SELECT * FROM categories WHERE category_id = $id";
                    $select_img = mysqli_query($connection, $query );
                    while($row = mysqli_fetch_assoc($select_img)){
                        $category_image = $row['category_img'];
                    }
              }
            if ($category_status== true ) {
                move_uploaded_file($admin_image_temp, "../image/$category_image" );
                $query = "UPDATE categories SET category_name = '$category_name', category_img = '$category_image' WHERE category_id = $id ";
                $edit_category_query = mysqli_query($connection, $query);
                if(!$edit_category_query) {
                    die("QUERY FAILED" . mysqli_error($connection));    
                }
            }
        }
         
   ?>

<h4><i class="fa fa-angle-right"></i> Edit Category</h4>
            <div class="form-panel">
            <form role="form" class="form-horizontal style-form" method="post" enctype="multipart/form-data">
                <div class="form-group has-success">
                <label class="col-lg-2 control-label">Category Name</label>
                <div class="col-lg-10">
                    <input type="text" value="<?php echo $category_name ?>" id="f-name" name="category_name" class="form-control">
                    <p class="help-block" style="color:red;"><?php global $category_err; echo $category_err ?></p>
                </div>
                </div>
                
                
                <div class="form-group last">
                <label class="col-lg-2 control-label">Image Upload</label>
                    <div class="col-md-9">
                    <div class="fileupload fileupload-new" data-provides="fileupload">
                        <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
                        <img src="../image/<?php echo $category_img ?>" alt="" />
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
                    <button class="btn btn-theme" type="submit" name="edit_category">Submit</button>
                    </div>
                    <div class=" col-lg-1">
                    <a href="manage_categories.php" class="btn btn-danger">Close</a> 
                    </div>
                </div>
                
            </form>
            
            </div>