<?php
session_start();
$connection = mysqli_connect("localhost", "root", "", "ecommerce2");

require_once("include/header.php");

// after do checkout
if (isset($_SESSION['refresh']) && $_SESSION['refresh'] == true) {
  echo "<script> Swal.fire('The Order Confirmed','It will be delivered within 3 to 5 working days <br><br> Thank you for your visit  ','success') </script>";
  unset($_SESSION['refresh']);
}

?>

<head>
  <style>
    .single-feature {
      transition: all 0.3s linear;
    }

    .single-feature:hover {
      transform: scale(1.1);
    }

    .swal2-select {
      display: none;
    }
  </style>
</head>


<!--================Home Banner Area =================-->
<section class="home_banner_area mb-40">
  <div class="banner_inner d-flex align-items-center">
    <div class="container">
      <div class="banner_content row">
        <div class="col-lg-12">
          <p class="sub text-uppercase">men Collection</p>
          <h3><span>Show</span> Your <br />Personal <span>Style</span></h3>
          <a class="main_btn mt-40" href="category.php">View Collection</a>
        </div>
      </div>
    </div>
  </div>
</section>

<!--================End Home Banner Area =================-->


<!-- Start feature Area -->
<section class="feature-area section_gap_bottom_custom" style="padding-bottom: 0px;">
  <div class="container ">
    <div class="row">
      <div class="col-lg-3 col-md-6">
        <div class="single-feature">
          <i class="flaticon-money"></i>
          <h3>Money back gurantee</h3>
          <p>Shall open divide a one</p>
        </div>
      </div>

      <div class="col-lg-3 col-md-6">
        <div class="single-feature">
          <i class="flaticon-truck"></i>
          <h3>Free Delivery</h3>
          <p>Shall open divide a one</p>
        </div>
      </div>

      <div class="col-lg-3 col-md-6">
        <div class="single-feature">
          <i class="flaticon-support"></i>
          <h3>Alway support</h3>
          <p>Shall open divide a one</p>
        </div>
      </div>

      <div class="col-lg-3 col-md-6">
        <div class="single-feature">
          <i class="flaticon-blockchain"></i>
          <h3>Secure payment</h3>
          <p>Shall open divide a one</p>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- End feature Area -->


<!--================ Feature Product Area =================-->

<section style="margin-top:0 !important; margin-bottom:0 ; padding-top:20px" class="feature_product_area section_gap_bottom_custom">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-12">
        <div class="main_title">
          <h2><span>Featured product</span></h2>
          <p>Bring called seed first of third give itself now ment</p>
        </div>
      </div>
    </div>

    <div class="row">

      <?php
      //show featured products
      $query = "SELECT * FROM products 
                              INNER JOIN categories ON 
                              products.category_id = categories.category_id
                              WHERE products.product_featured='on' LIMIT 6 ";

      $select_product = mysqli_query($connection, $query);
      while ($row = mysqli_fetch_assoc($select_product)) {
        $product_id = $row['product_id'];
        $product_name = $row['product_name'];
        $product_description = $row['product_description'];
        $product_price = $row['product_price'];
        $product_price_on_sale = $row['product_price_on_sale'];
        $product_img = $row['product_m_img'];
        $product_sale_status = $row['sale_status'];
        $category_id = $row['category_id'];
      ?>
        <div class="col-lg-4 col-md-4">
          <div class="single-product">
            <div class="product-img">
              <img class="img-fluid w-100" src="image/<?php echo $product_img ?>" alt="image" />
              <div class="p_icon">
                <a href="single-product.php?id=<?php echo $product_id; ?>">
                  <i class="ti-eye"></i>
                </a>
                <a href="index.php?action=add_to_cart&page=index&quantity=1&id=<?php echo $row['product_id']; ?> ">
                  <i class=" ti-shopping-cart"></i>
                </a>
              </div>
            </div>
            <div class="product-btm">
              <a href="#" class="d-block">
                <h4 style="font-size: 18px;"><?php echo "<strong>" . $product_name . "</strong>" ?></h4>
                <h6><?php echo $product_description  ?></h6>
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
      <?php  } ?>

    </div>
  </div>
</section>
<!--================ End Feature Product Area =================-->



<!--================ On Sale Products Area =================-->
<section style="margin-top:0  !important; margin-bottom:0 ; padding-top:0px" class="new_product_area section_gap_top section_gap_bottom_custom">
  <div class="page-content page-container " id="page-content">
    <div class="padding">
      <div class="row container-fluid">
        <div class="col-lg-12 grid-margin stretch-card">
          <div>
            <div class="main_title">
              <h2><span> Products On Sale</span></h2>
              <p>Bring called seed first of third give itself now ment</p>
            </div>
            <div class="owl-carousel">
              <?php
              //show onsale products
              $query = "SELECT * FROM products 
                              INNER JOIN categories ON 
                              products.category_id = categories.category_id
                              WHERE products.sale_status ='on' ";

              $select_product = mysqli_query($connection, $query);
              while ($row = mysqli_fetch_assoc($select_product)) {
                $product_id = $row['product_id'];
                $product_name = $row['product_name'];
                $product_description = $row['product_description'];
                $product_price = $row['product_price'];
                $product_price_on_sale = $row['product_price_on_sale'];
                $product_img = $row['product_m_img'];
                $product_sale_status = $row['sale_status'];
                $category_id = $row['category_id'];
              ?>

                <div class="item single-product ">
                  <div style="position: relative;" class="product-img ">
                    <div style="position:absolute; top:0; left:0; background-color:#C7370F; 
                    color:white;padding:10px;font-size:18px;font-weight:medium;border-radius:5px">Sale!</div>
                    <img class="img-fluid w-100 " src="image/<?php echo $product_img ?>" alt="image" />
                    <div class="p_icon">
                      <a href="single-product.php?id=<?php echo  $product_id ?>">
                        <i class="ti-eye"></i>
                      </a>
                      <a href="index.php?action=add_to_cart&page=index&quantity=1&id=<?php echo $row['product_id']; ?> ">
                        <i class=" ti-shopping-cart"></i>
                      </a>
                    </div>
                  </div>
                  <div class="product-btm">
                    <a href="#" class="d-block">
                      <h4 style="font-size: 18px;;"><?php echo "<strong>" . $product_name . "</strong>" ?></h4>
                      <h6><?php echo $product_description  ?></h6>
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

              <?php  } ?>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!--================ End On Sale Products Area =================-->


<!--================ Offer Area =================-->
<section class="offer_area">
  <div class="container">
    <div class="row justify-content-center">
      <div class="offset-lg-4 col-lg-6 text-center">
        <div class="offer_content">
          <h3 class="text-uppercase mb-40">all men’s collection</h3>
          <h2 class="text-uppercase">50% off</h2>
          <a href="#" class="main_btn mb-20 mt-5">Discover Now</a>
          <p>Limited Time Offer</p>
        </div>
      </div>
    </div>
  </div>
</section>
<!--================ End Offer Area =================-->

<!--================ Start category Area =================-->
<section style="margin-top:0 !important; margin-bottom:0 ; padding-top:60px;" class="feature_product_area section_gap_bottom_custom">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-12">
        <div class="main_title">
          <h2><span>Top Category</span></h2>
          <p>Bring called seed first of third give itself now ment</p>
        </div>
      </div>
    </div>

    <div class="row">
      <?php
      //show all categories
      $query = "SELECT * FROM categories";
      $select_category = mysqli_query($connection, $query);
      while ($row = mysqli_fetch_assoc($select_category)) {
        $category_id = $row['category_id'];
        $category_name = $row['category_name'];
        $category_img = $row['category_img'];
      ?>

        <div class="col-lg-4 col-md-4">
          <div class="single-product">
            <div class="product-img">
              <img class="img-fluid w-100" src="image/<?php echo $category_img ?>" alt="image" />
              <div class="p_icon">
                <a href="category.php?c_id=<?php echo $category_id ?>">
                  <i class="ti-eye"></i>
                </a>

              </div>
            </div>
            <div class="product-btm">
              <a href="#" class="d-block">
                <h4 style="font-size: 18px;"><?php echo "<strong>" . $category_name . "</strong>" ?></h4>
              </a>

            </div>
          </div>
        </div>

      <?php  } ?>
    </div>
  </div>

</section>
<!--================ End category Area =================-->

<!--================ start footer Area  =================-->
<?php include("./include/footer.php") ?>
<?php

// after do signup
if (isset($_SESSION['stateSignUp']) && $_SESSION['stateSignUp'] == true) {
  echo "<script> Swal.fire('Successfully Registred','Welcome to our website','success') </script>";
  unset($_SESSION['stateSignUp']);
}

?>