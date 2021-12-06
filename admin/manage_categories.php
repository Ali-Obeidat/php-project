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
    <?php add_category() ?>
    <?php delete_category()?>

    <section id="main-content">
      <section class="wrapper">
        <h3><i class="fa fa-angle-right"></i> Categories</h3>
        
        <!-- BASIC FORM VALIDATION -->
        <div class="row mt">
          <div class="col-lg-12">
            <?php 
          if(isset($_GET['source'])){
                                $source= $_GET['source'];

                            }else{
                                $source= "";
                            }
                            switch ($source) {
                                case "edit_category":
                                    include "include/edit_category.php";
                                    break;
                                default:
                               ?>
                               <h4><i class="fa fa-angle-right"></i> Add Category</h4>
                                  <div class="form-panel">
                                    <form role="form" class="form-horizontal style-form" method="post" enctype="multipart/form-data">
                                      <div class="form-group has-success">
                                        <label class="col-lg-2 control-label">Category Name</label>
                                        <div class="col-lg-10">
                                          <input type="text" placeholder="" id="f-name" name="category_name" class="form-control">
                                          <p class="help-block" style="color:red;"><?php global $category_err; echo $category_err ?></p>
                                        </div>
                                      </div>
                                      
                                      
                                      <div class="form-group last">
                                        <label class="col-lg-2 control-label">Image Upload</label>
                                          <div class="col-md-9">
                                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                              <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
                                                <img src="../image/<?php $category_image ?>" alt="" />
                                              </div>
                                              <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                                              <div>
                        
                                                <input class="btn btn-theme02 btn-file" fileupload-new fa fa-paperclip type="file" class="default" value="Select image"  name="image" />
                                                <p class="help-block" style="color:red;"><?php global $imgErr; echo $imgErr ?></p>
                                              </div>
                                            </div>
                                            
                                          </div>
                                      </div>
                                      <div class="form-group">
                                        <div class="col-lg-offset-2 col-lg-10">
                                          <button class="btn btn-theme" name="add_category" type="submit">Submit</button>
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
              <h4><i class="fa fa-angle-right"></i> Category Table</h4>
              <hr>
              <table class="table">
                <thead>
                  <tr>
                    <th>Id</th>
                    <th> Name</th>
                    <th>Image</th>
                    <th></th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                <?php 
                $query = "SELECT * FROM categories";
                $select_categories = mysqli_query($connection, $query );
                while($row = mysqli_fetch_assoc($select_categories)) { 
                  $category_id        = $row['category_id'];
                  $category_name         = $row['category_name'];
                  $category_image            = $row['category_img'];
                  ?>
                  <tr>
                  <td><?php echo $category_id  ?></td>
                  <td><?php echo $category_name  ?></td>
                  <td> <img width="100" src="../image/<?php echo $category_image; ?>" alt=""> </td>
                  <td><a href='manage_categories.php?source=edit_category&edit=<?php echo $category_id ?>' class="btn btn-theme">edit</a></td>
                  <td><a href='manage_categories.php?delete=<?php echo $category_id ?>'class="btn btn-danger">delete</a></td>
                  </tr>
                <?php }?>
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