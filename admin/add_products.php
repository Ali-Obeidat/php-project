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
<?php
if (isset($_POST['add_category'])) {
  $product_category         = $_POST['product_category'];
  $product_name        = $_POST['product_name'];
  $product_tags        = $_POST['product_tags'];
  $product_sizes       = $_POST['Sizes'];
  $product_price        = $_POST['product_price'];
  $featured        = $_POST['featured'];
 
  $product_quantity        = $_POST['product_quantity'];

  $m_image        = $_FILES['Product_Image']['name'];
  $m_image_temp   = $_FILES['Product_Image']['tmp_name'];

  $image1        = $_FILES['Image1']['name'];
  $image1_temp   = $_FILES['Image1']['tmp_name'];

  $image2       = $_FILES['Image2']['name'];
  $image2_temp   = $_FILES['Image2']['tmp_name'];

  $image3       = $_FILES['Image3']['name'];
  $image3_temp   = $_FILES['Image3']['tmp_name'];

  $Description    = $_POST['Description'];
  if (!isset($_POST['price_on_sale'])) {
    $price_on_sale = "0";
  } else {
    $price_on_sale        = $_POST['price_on_sale'];
  }
  if (empty($product_category)) {
    $categoryErr = "Please select category";
    $categoryStatus = false;
  } else {
    $categoryStatus = true;
  }
  if ($product_name == "" || empty($product_name)) {
    $productNameErr = " This field should not be empty";
    $productNameStatus = false;
  } else {
    $productNameStatus = true;
  }
  if ($product_tags == "" || empty($product_tags)) {
    $tagsErr = " This field should not be empty";
    $tagsStatus = false;
  } else {
    $tagsStatus = true;
  }
  if ($product_sizes == "" || empty($product_sizes)) {
    $SizesErr = " This field should not be empty";
    $sizesStatus = false;
  } else {
    $sizesStatus = true;
  }
  if ($product_price == "" || empty($product_price)) {
    $priceErr = " This field should not be empty";
    $priceStatus = false;
  } else {
    $priceStatus = true;
  }
  if ($Description == "" || empty($Description)) {
    $DescriptionErr = " This field should not be empty";
    $DescriptionStatus = false;
  } else {
    $DescriptionStatus = true;
  }
  if ($m_image == "" || empty($m_image)) {
    $imgErr = " Please add Image";
    $img_status = false;
  } else {
    $img_status = true;
  }
  if (empty($Sale_Status)) {
    $Sale_Status = "off";
  }else {
    $Sale_Status  = $_POST['Sale_Status'];
  }
  if ($categoryStatus == true && $productNameStatus == true && $tagsStatus == true && $priceStatus == true && $img_status == true) {
    move_uploaded_file($m_image_temp, "../image/$m_image");
    move_uploaded_file($image1_temp, "../image/$image1");
    move_uploaded_file($image2_temp, "../image/$image2");
    move_uploaded_file($image3_temp, "../image/$image3");

    $query = "INSERT INTO products(product_name, product_description, product_m_img, product_sub1_img, product_sub2_img,
          product_sub3_img,product_price, product_price_on_sale, sale_status, product_featured, product_quantity, category_id, product_tags, product_sizes ) ";

    $query .= "VALUES('{$product_name}','{$Description}','{$m_image}','{$image1}',
        '{$image2}','{$image3}','{$product_price}','{$price_on_sale}','{$Sale_Status}','{$featured}',
        '{$product_quantity}','{$product_category}','{$product_tags}','{$product_sizes}' ) ";
    $create_product_query = mysqli_query($connection, $query);
  }
}

?>
<section id="main-content">
  <section class="wrapper">
    <h3><i class="fa fa-angle-right"></i> Add Product</h3>

    <div class="row mt">
      <div class="col-lg-12">
        <div class="form-panel">
          <div class=" form">
            <form class="cmxform form-horizontal style-form" id="commentForm" method="post" enctype="multipart/form-data">
              <div class="form-group ">
                <label for="cname" class="control-label col-lg-2">Select Category</label>
                <div class="col-lg-10">
                  <select class="form-control col-lg-4" name="product_category">
                    <option value="0">Select Category</option>
                    <?php
                    $query = "SELECT * FROM categories ";
                    $select_categories = mysqli_query($connection, $query);
                    while ($row = mysqli_fetch_assoc($select_categories)) {
                      $category_id = $row['category_id'];
                      $category_name = $row['category_name'];
                    ?>
                      <option value="<?php echo $category_id ?>"> <?php echo $category_name ?></option>
                    <?php
                    }
                    ?>

                  </select>
                  <p class="help-block" style="color:red;"><?php global $categoryErr;
                                                            echo $categoryErr ?></p>

                </div>
              </div>
              <div class="form-group ">
                <label for="cname" class="control-label col-lg-2">Product Name</label>
                <div class="col-lg-10">
                  <input class=" form-control" id="cname" name="product_name" minlength="2" type="text" />
                  <p class="help-block" style="color:red;"><?php global $productNameErr;
                                                            echo $productNameErr ?></p>

                </div>
              </div>
              <div class="form-group ">
                <label for="cname" class="control-label col-lg-2">Product Tags</label>
                <div class="col-lg-10">
                  <input class=" form-control" id="cname" name="product_tags" minlength="2" type="text" />
                  <p class="help-block" style="color:red;"><?php global $tagsErr;
                                                            echo $tagsErr ?></p>
                </div>
              </div>
              <div class="form-group ">
                <label for="cname" class="control-label col-lg-2">Product Sizes</label>
                <div class="col-lg-10">
                  <input class=" form-control" id="cname" name="Sizes" minlength="2" type="text" />
                  <p class="help-block" style="color:red;"><?php global $tagsErr;
                                                            echo $tagsErr ?></p>
                </div>
              </div>
              <div style="display: flex; flex-direction: row;">
                <div class="col-lg-6" style="padding-left:0px;">
                  <div class=" form-group ">
                    <label for=" cemail" class="control-label col-lg-4">product price</label>
                    <div class="col-lg-2">
                      <input class=" form-control " id=" cemail" type="text" name="product_price" />
                      <p class="help-block" style="color:red;"><?php global $priceErr;
                                                                echo $priceErr ?></p>
                    </div>
                  </div>
                  <div class="form-group ">
                    <label for="cemail" class="control-label col-lg-4">product quantity</label>
                    <div class="col-lg-2">
                      <input class="form-control " id="cemail" type="text" name="product_quantity" />
                    </div>
                  </div>
                  <div class="form-group ">
                    <label for="cemail" class="control-label col-lg-4">product featured</label>
                    <div class="col-lg-2">
                      <select class="form-control" name="featured" id="">
                        <option value="Off">select</option>
                        <option value="On">On</option>
                        <option value="Off">Off</option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="col-lg-6" style=" padding-top: 17px">
                  <div class=" form-group ">
                    <div class="checkbox" style="padding-top: 0;">
                      <label>
                        <input type="checkbox" name="Sale_Status" id="sale" value="on">
                        Sale Status
                      </label>
                    </div>
                  </div>
                  <div class="form-group ">
                    <label for=" price_on_sale" class="control-label col-lg-4">product price on sale</label>
                    <div class="col-lg-2">
                      <input class="form-control " id="price_on_sale" disabled type="text" name="price_on_sale" value="" />
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-group ">
                <label for="curl" class="control-label col-lg-2">Product Image</label>
                <div class="col-md-9">
                  <div class="fileupload fileupload-new" data-provides="fileupload">
                    <div>
                      <input class="btn btn-theme02 btn-file" name="Product_Image" fileupload-new fa fa-paperclip type="file" class="default" value="Select image" />
                      <p class="help-block" style="color:red;"><?php global $imgErr;
                                                                echo $imgErr ?></p>

                    </div>
                  </div>

                </div>
              </div>
              <div class="form-group ">
                <div class="row">
                  <div class="col-lg-2">
                    <label for="curl" class="control-label col-lg-4">Product Images</label>

                  </div>
                  <div class="col-lg-3">
                    <label for="curl" class="control-label col-lg-4"> Image #1</label>
                    <div class="col-md-9">
                      <div class="fileupload fileupload-new" data-provides="fileupload">
                        <div>
                          <input class="btn btn-theme02 btn-file" name="Image1" fileupload-new fa fa-paperclip type="file" class="default" value="Select image" value="" />
                        </div>
                      </div>

                    </div>
                  </div>
                  <div class="col-lg-3">
                    <label for="curl" class="control-label col-lg-4"> Image #2 </label>
                    <div class="col-md-9">
                      <div class="fileupload fileupload-new" data-provides="fileupload">
                        <div>
                          <input class="btn btn-theme02 btn-file" name="Image2" fileupload-new fa fa-paperclip type="file" class="default" value="Select image" value="" />
                        </div>
                      </div>

                    </div>
                  </div>
                  <div class="col-lg-3">
                    <label for="curl" class="control-label col-lg-4"> Image #3 </label>
                    <div class="col-md-9">
                      <div class="fileupload fileupload-new" data-provides="fileupload">
                        <div>
                          <input class="btn btn-theme02 btn-file" name="Image3" fileupload-new fa fa-paperclip type="file" class="default" value="Select image" value="" />
                        </div>
                      </div>

                    </div>
                  </div>
                </div>
              </div>
              <div class="form-group ">
                <label for="ccomment" class="control-label col-lg-2">Description</label>
                <div class="col-lg-10">
                  <textarea class="form-control " id="ccomment" name="Description"></textarea>
                  <p class="help-block" style="color:red;"><?php global $DescriptionErr;
                                                            echo $DescriptionErr ?></p>

                </div>
              </div>
              <div class="form-group">
                <div class="col-lg-offset-2 col-lg-10">
                  <button class="btn btn-theme" name="add_category" type="submit">Add </button>
                 <a href="show_products.php"><button class="btn btn-theme04" type="button">Cancel</button></a> 
                </div>
              </div>
            </form>
          </div>
        </div>
        <!-- /form-panel -->
      </div>
      <!-- /col-lg-12 -->
    </div>

  </section>
  <!-- /wrapper -->
</section>
<!--main content end-->
<!--footer start-->
<?php include("include/admin_footer.php") ?>