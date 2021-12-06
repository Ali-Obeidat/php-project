<?php
session_start();
$connection = mysqli_connect("localhost", "root", "", "ecommerce2");

include("./include/header.php");
?>
<!--================Header Menu Area =================-->
<?php if (isset($_GET['c_id'])) {
  $c_id = $_GET['c_id'];
  global $connection;
} ?>
<!--================Home Banner Area =================-->
<section class="banner_area">
  <div class="banner_inner d-flex align-items-center">
    <div class="container">
      <div class="banner_content d-md-flex justify-content-between align-items-center">
        <div class="mb-3 mb-md-0">
          <h2>Shop Category</h2>
          <p>Very us move be blessed multiply night</p>
        </div>
        <div class="page_link">
          <a href="category.php">Home</a>
          <a href="category.php">Shop</a>
          <?php
          $query = "SELECT * FROM categories WHERE category_id = {$c_id}";
          $cat_query = mysqli_query($connection, $query);
          while ($row = mysqli_fetch_assoc($cat_query)) {
            $category_name = $row['category_name'];
            $category_id = $row['category_id'];
          ?>
            <a href="individual_category.php?c_id=<?php echo $category_id ?>"><?php echo $category_name ?> </a>

          <?php } ?>

        </div>
      </div>
    </div>
  </div>
</section>
<!--================End Home Banner Area =================-->

<!--================Category Product Area =================-->
<section class="cat_product_area section_gap">
  <div class="container">
    <div class="row flex-row-reverse">
      <div class="col-lg-9">
        <div class="product_top_bar">
          <div class="left_dorp">
            <!-- <select class="sorting">
              <option value="1">Default sorting</option>
              <option value="2">Default sorting 01</option>
              <option value="4">Default sorting 02</option>
            </select> -->
         
          </div>
        </div>

        <div class="latest_product_inner">
          <div class="row">
            <?php

            global $connection;
            $query = "SELECT * FROM products WHERE category_id = {$c_id}";
            $cat_query = mysqli_query($connection, $query);
            while ($row = mysqli_fetch_assoc($cat_query)) {


              $product_id = $row['product_id'];
              $product_name = $row['product_name'];
              $product_description = $row['product_description'];
              $product_m_img = $row['product_m_img'];
              $product_price = $row['product_price'];
              $product_price_on_sale = $row['product_price_on_sale'];
              $sale_status = $row['sale_status'];
            ?>
              <div class="col-lg-4 col-md-6">
                <div class="single-product">
                  <div class="product-img">
                    <a href="single-product.php?id=<?php echo $product_id; ?>">
                      <img class="card-img" src="image/<?php echo $product_m_img ?>" alt="" />
                    </a>
                    <div class="p_icon">
                      <a href="single-product.php?id=<?php echo $product_id; ?>">
                        <i class="ti-eye"></i>
                      </a>
                      <a href="#">
                        <i class="ti-shopping-cart"></i>
                      </a>
                    </div>
                  </div>
                  <div class="product-btm">
                    <a href="#" class="d-block">
                      <h4><?php
                          if ($sale_status == "on") { ?>
                          <div class="mt-3">
                            <span class="mr-4"><?php echo $product_price_on_sale . " JOD" ?></span>
                            <del><?php echo $product_price . " JOD" ?></del>
                          </div>
                        <?php } else { ?>
                          <div class="mt-3">
                            <span class="mr-4"><?php echo $product_price . " JOD" ?></span>
                          </div>
                        <?php } ?>
                      </h4>
                    </a>
                  </div>
                </div>
              </div>
            <?php    }  ?>
          </div>

        </div>
      </div>
      <!-- ===============SIDE BAR ===================== -->
      <?php include("./include/sidebar.php") ?>

    </div>
  </div>
</section>
<!--================End Category Product Area =================-->

<!--================ start footer Area  =================-->
<?php include("./include/footer.php") ?>