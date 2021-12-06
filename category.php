<?php
session_start();
include("include/header.php");

?>
<!--================Header Menu Area =================-->

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
        <div class="product_top_bar">
          <div class="left_dorp">
            <!-- <form action="" method="post">
              <select class="sorting">
                <option value="price">Price</option>
                <button type="submit" class="btn main_btn">Filter</button>
              </select>
            </form> -->
          </div>
        </div>
        <div class="latest_product_inner">
          <div class="row">
            <?php
            $query = "SELECT * FROM products ORDER BY product_price ASC LIMIT 9";
            $select_products = mysqli_query($connection, $query);
            while ($row = mysqli_fetch_assoc($select_products)) {
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
                      <a href="category.php?action=add_to_cart&page=cat&quantity=1&id=<?php echo $row['product_id']; ?> ">
                        <i class=" ti-shopping-cart"></i>
                      </a>
                    </div>
                  </div>
                  <div class="product-btm">
                    <a href="#" class="d-block">
                      <h4><?php echo $product_name ?></h4>
                    </a>

                    <?php
                    if ($product_price_on_sale != 0) { ?>
                      <div class="mt-3">
                        <span class="mr-4"><?php echo $product_price_on_sale . " JOD" ?></span>
                        <del><?php echo $product_price . " JOD" ?></del>
                      </div>
                    <?php } else { ?>
                      <div class="mt-3">
                        <span class="mr-4"><?php echo $product_price . " JOD" ?></span>
                      </div>

                    <?php } ?>
                  </div>
                </div>
              </div>
              <!-- REEM -->
            <?php    }  ?>
          </div>
          <nav aria-label="Page navigation example" class="mx-auto">
            <ul class="pagination pg-blue justify-content-center">
              <!-- <li class="page-item"><a class="page-link">Previous</a></li> -->
              <li class="page-item"><a href="secondPage.php" class="page-link">1</a></li>
              <li class="page-item"><a href="secondPage.php" class="page-link">2</a></li>
              <li class="page-item"><a href="thirdPage.php" class="page-link">3</a></li>
              <!-- <li class="page-item"><a class="page-link">Next</a></li> -->
            </ul>
          </nav>

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