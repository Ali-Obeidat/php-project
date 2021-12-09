<?php
$connection = mysqli_connect("localhost", "root", "", "ecommerce2");
session_start();
include("include/header.php");
?>
<!--================Header Menu Area =================-->

<!--================Home Banner Area =================-->
<section class="banner_area" >
  <div class="banner_inner d-flex align-items-center">
    <div class=" container">
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
            <form action="" method="get">
              <div class="form-row">
                <div class="col">
                  <input type="number" name="min" value="" class="form-control" placeholder="Min Price">
                </div>
                <div class="col">
                  <input type="number" name="max" value="" class="form-control" placeholder="Max Price">
                  <input type="hidden" name="c_id" value="<?php echo $_GET['c_id'] ?? "" ?>" class="form-control" placeholder="Max Price">
                </div>
                <div class="col">
                  <button style="height: 100%; line-height: 0;" type="submit" class="main_btn">Show</button>
                </div>
              </div>
            </form>
          </div>
        </div>
        <div class="latest_product_inner">
          <div class="row">
            <?php
            $min               = $_GET['min'] ?? 0;
            $max               = $_GET['max'] ?? 5000;
            $count             = 0;
            $productNumber     = $_GET['m'] ?? 0;
            $subCategory       = $_GET['c_id'] ?? 0;
            if (isset($_GET['c_id']) && !empty($_GET['c_id'])) {
              $query  = "SELECT * FROM products WHERE category_id =  {$subCategory} && product_price BETWEEN {$min} AND {$max} ";
              $select_products =  mysqli_query($connection, $query);
            } else {
              $query = "SELECT * FROM products WHERE product_price BETWEEN {$min} AND {$max} ORDER BY product_price LIMIT 9 OFFSET {$productNumber}";
              $select_products = mysqli_query($connection, $query);
            }
            while ($row = mysqli_fetch_assoc($select_products)) {
              $count++;
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
                  </div>
                </div>
              </div>
            <?php    }  ?>
          </div>
          <?php if ($count >= 9 || isset($_GET['m'])) { ?>
            <nav aria-label="Page navigation example" class="mx-auto">
              <ul class="pagination pg-blue justify-content-center">
                <!-- <li class="page-item"><a class="page-link">Previous</a></li> -->
                <li class="page-item"><a href="category.php?min=<?php echo $_GET['min'] ?? 0 ?>&max=<?php echo $_GET['max'] ?? 1000 ?>&m=0" class="page-link">1</a></li>
                <li class="page-item"><a href="category.php?min=<?php echo $_GET['min'] ?? 0 ?>&max=<?php echo $_GET['max'] ?? 1000 ?>&m=9" class="page-link">2</a></li>
                <li class="page-item"><a href="category.php?min=<?php echo $_GET['min'] ?? 0 ?>&max=<?php echo $_GET['max'] ?? 1000 ?>&m=18" class="page-link">3</a></li>
              <?php
            } ?>
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