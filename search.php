<?php
$connection = mysqli_connect("localhost", "root", "", "ecommerce2");
require_once("./include/header.php")

?>

<section class="banner_area">
  <div class="banner_inner d-flex align-items-center">
    <div class="container">
      <div class="banner_content d-md-flex justify-content-between align-items-center">
        <div class="mb-3 mb-md-0">
          <h2>Shop Category</h2>
          <p>Very us move be blessed multiply night</p>
        </div>
        <div class="page_link">
          <a href="index.php">Home</a>
          <a href="category.php">Shop</a>
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


        <div class="latest_product_inner">
          <div class="row">
            <?php

            if (isset($_POST['submit'])) {
              $search = $_POST['search'];
              $query = "SELECT * FROM products WHERE product_tags LIKE '%$search%'";
              $search_query = mysqli_query($connection, $query);
              if (!$search_query) {
                die("QUERY FAILED" . mysqli_error($connection)); //just to check if its work

              }
              $count = mysqli_num_rows($search_query);
              if ($count == 0) {
                echo "<h1>No Result!</h1>";
              } else {
                while ($row = mysqli_fetch_assoc($search_query)) {
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
                            <i class="ti-heart"></i>
                          </a>
                          <a href="#">
                            <i class="ti-shopping-cart"></i>
                          </a>
                        </div>
                      </div>
                      <div class="product-btm">
                        <a href="#" class="d-block">
                          <h4><?php echo $product_name ?></h4>
                        </a>
                        <div class="mt-3">
                          <span class="mr-4"><?php echo $product_price_on_sale . "JOD" ?></span>
                          <del><?php echo $product_price . "JOD" ?></del>
                        </div>
                      </div>
                    </div>
                  </div>
            <?php    }
              }
            } ?>
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