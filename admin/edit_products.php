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
$id = $_GET['edit'];
$query = "SELECT * FROM products INNER JOIN categories
    ON products.category_id  = categories.category_id WHERE product_id = $id";
$select_product = mysqli_query($connection, $query);
$update_product = mysqli_query($connection, $query);
$row = mysqli_fetch_assoc($update_product);
$product_name = $row['product_name'];
$product_description = $row['product_description'];
$product_price = $row['product_price'];
$product_price_on_sale = $row['product_price_on_sale'];
$sale_status = $row['sale_status'];
$min_image = $row['product_m_img'];
$sub_image1 = $row['product_sub1_img'];
$sub_image2 = $row['product_sub2_img'];
$sub_image3 = $row['product_sub3_img'];
$category_name = $row['category_name'];
$category_id = $row['category_id'];
$product_tags = $row['product_tags'];
$product_quantity = $row['product_quantity'];
$product_featured = $row['product_featured'];
$product_sizes = $row['product_sizes'];

?>
<?php
if (isset($_POST['edit_product'])) {

  echo $product_category         = $_POST['product_category'];
  echo $product_name        = $_POST['product_name'];
  $product_tags        = $_POST['product_tags'];
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
  $product_sizes = $_POST['Sizes'];

  $Description    = $_POST['Description'];
  if (!isset($_POST['Sale_Status'])) {
    $_POST['Sale_Status'] = 'off';
    $Sale_Status        = $_POST['Sale_Status'];
    $price_on_sale        = 0;
  } else {
    $Sale_Status        = $_POST['Sale_Status'];
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
    $query = "SELECT * FROM products WHERE product_id = $id ";
    $select_img = mysqli_query($connection, $query);
    while ($row = mysqli_fetch_assoc($select_img)) {
      $m_image = $row['product_m_img'];
    }
  }
  if ($image1 == "" || empty($image1)) {
    $query = "SELECT * FROM products WHERE product_id = $id ";
    $select_img = mysqli_query($connection, $query);
    while ($row = mysqli_fetch_assoc($select_img)) {
      $image1 = $row['product_sub1_img'];
    }
  }
  if ($image2 == "" || empty($image2)) {
    $query = "SELECT * FROM products WHERE product_id = $id ";
    $select_img = mysqli_query($connection, $query);
    while ($row = mysqli_fetch_assoc($select_img)) {
      $image2 = $row['product_sub2_img'];
    }
  }
  if ($image3 == "" || empty($image3)) {
    $query = "SELECT * FROM products WHERE product_id = $id ";
    $select_img = mysqli_query($connection, $query);
    while ($row = mysqli_fetch_assoc($select_img)) {
      $image3 = $row['product_sub3_img'];
    }
  }

  if ($categoryStatus == true && $productNameStatus == true && $tagsStatus == true && $priceStatus == true) {
    move_uploaded_file($m_image_temp, "../image/$m_image");
    move_uploaded_file($image1_temp, "../image/$image1");
    move_uploaded_file($image2_temp, "../image/$image2");
    move_uploaded_file($image3_temp, "../image/$image3");

    $query = "UPDATE products SET product_name = '{$product_name}', product_description = '{$Description}', product_m_img = '{$m_image}',
           product_sub1_img = '{$image1}', product_sub2_img = '{$image2}',product_sub3_img = '{$image3}',product_price = '{$product_price}', 
           product_price_on_sale = '{$price_on_sale}', sale_status = '{$Sale_Status}', product_featured = '{$featured}', product_quantity ='{$product_quantity}',
            category_id= '{$product_category}' , product_tags= '{$product_tags}', product_sizes = '{$product_sizes}' WHERE product_id = $id";
    $edit_product_query = mysqli_query($connection, $query);

    if (!$edit_product_query) {
      die('Query Failed' . mysqli_error($connection));
    }
    //  header("Location: show_products.php");
  }
}

?>
<section id="main-content">
  <section class="wrapper">
    <h3><i class="fa fa-angle-right"></i> Edit Product</h3>

    <div class="row mt">
      <div class="col-lg-12">
        <div class="form-panel">
          <div class=" form">
            <form class="cmxform form-horizontal style-form" id="commentForm" method="post" enctype="multipart/form-data">
              <div class="form-group ">
                <label for="cname" class="control-label col-lg-2">Select Category</label>
                <div class="col-lg-10">
                  <select class="form-control col-lg-4" name="product_category">
                    <option value="<?php echo $category_id ?>"><?php echo $category_name ?></option>
                    <?php
                    $query = "SELECT * FROM categories ";
                    $select_categories = mysqli_query($connection, $query);
                    while ($row = mysqli_fetch_assoc($select_categories)) {
                      $category_id = $row['category_id'];
                      $category_title = $row['category_name'];
                      if ($category_title == $category_name) {
                        continue;
                      }
                    ?>
                      <option value="<?php echo $category_id ?>"> <?php echo $category_title ?></option>
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
                  <input class=" form-control" id="cname" name="product_name" minlength="2" type="text" value="<?php echo $product_name ?>" />
                  <p class="help-block" style="color:red;"><?php global $productNameErr;
                                                            echo $productNameErr ?></p>

                </div>
              </div>
              <div class="form-group ">
                <label for="cname" class="control-label col-lg-2">Product Tags</label>
                <div class="col-lg-10">
                  <input class=" form-control" id="cname" name="product_tags" minlength="2" type="text" value="<?php echo $product_tags ?>" />
                  <p class="help-block" style="color:red;"><?php global $tagsErr;
                                                            echo $tagsErr ?></p>
                </div>
              </div>
              <div class="form-group ">
                <label for="cname" class="control-label col-lg-2">Product Sizes</label>
                <div class="col-lg-10">
                  <input class=" form-control" id="cname" value="<?php echo $product_sizes ?>" name="Sizes" minlength="2" type="text" />
                  <p class="help-block" style="color:red;"><?php global $tagsErr;
                                                            echo $tagsErr ?></p>
                </div>
              </div>
              <div style="display: flex; flex-direction: row;">
                <div class="col-lg-6" style=" padding-left:0px; ">
                  <div class="form-group ">
                    <label for="cemail" class="control-label col-lg-4">product price</label>
                    <div class="col-lg-2">
                      <input class="form-control " id="cemail" type="text" name="product_price" value="<?php echo $product_price ?>" />
                      <p class="help-block" style="color:red;"><?php global $priceErr;
                                                                echo $priceErr ?></p>
                    </div>
                  </div>
                  <div class="form-group ">
                    <label for="cemail" class="control-label col-lg-4">product quantity</label>
                    <div class="col-lg-2">
                      <input class="form-control " id="cemail" type="text" name="product_quantity" value="<?php echo $product_quantity ?>" />
                    </div>
                  </div>
                  <div class="form-group ">
                    <label for="cemail" class="control-label col-lg-4">product featured</label>
                    <div class="col-lg-2">
                      <select class="form-control" name="featured" id="">
                        <option value="<?php echo $product_featured ?>"> <?php echo $product_featured ?></option>
                        <?php
                        if ($product_featured == "On") {
                          echo "<option value='Off'> Off</option>";
                        } else {
                          echo "<option value='On'> On</option>";
                        }
                        ?>

                      </select>
                    </div>
                  </div>
                </div>
                <div class="col-lg-6" style="padding-top: 17px">
                  <div class="form-group ">
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
                      <input class="form-control " id="price_on_sale" disabled type="text" name="price_on_sale" value="<?php echo $product_price_on_sale ?>" />
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-group ">
                <label for="curl" class="control-label col-lg-2">Product Image</label>
                <div class="col-md-9">
                  <div class="fileupload fileupload-new" data-provides="fileupload">
                    <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
                      <img src="../image/<?php echo $min_image ?>" alt="" />
                    </div>
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
                          <img width="100" src="../image/<?php echo $sub_image1 ?>" alt="" />

                        </div>
                      </div>

                    </div>
                  </div>
                  <div class="col-lg-3">
                    <label for="curl" class="control-label col-lg-4"> Image #2 </label>
                    <div class="col-md-9">
                      <div class="fileupload fileupload-new" data-provides="fileupload">
                        <div>
                          <input class="btn btn-theme02 btn-file" name="Image2" fileupload-new fa fa-paperclip type="file" class="default" value="Select image" />
                          <img width="100" src="../image/<?php echo $sub_image2 ?>" alt="" />

                        </div>
                      </div>

                    </div>
                  </div>
                  <div class="col-lg-3">
                    <label for="curl" class="control-label col-lg-4"> Image #3 </label>
                    <div class="col-md-9">
                      <div class="fileupload fileupload-new" data-provides="fileupload">
                        <div>
                          <input class="btn btn-theme02 btn-file" name="Image3" fileupload-new fa fa-paperclip type="file" class="default" value="Select image" />
                          <img width="100" src="../image/<?php echo $sub_image3 ?>" alt="" />

                        </div>
                      </div>

                    </div>
                  </div>
                </div>
              </div>
              <div class="form-group ">
                <label for="ccomment" class="control-label col-lg-2">Description</label>
                <div class="col-lg-10">
                  <textarea class="form-control " id="ccomment" name="Description"><?php echo $product_description ?></textarea>
                  <p class="help-block" style="color:red;"><?php global $DescriptionErr;
                                                            echo $DescriptionErr ?></p>

                </div>
              </div>
              <div class="form-group">
                <div class="col-lg-offset-2 col-lg-10">
                  <button class="btn btn-theme" name="edit_product" type="submit">Edit </button>
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