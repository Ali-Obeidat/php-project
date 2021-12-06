<?php
$connection = mysqli_connect("localhost", "root", "", "ecommerce2");
session_start();
if (!isset($_SESSION['userLogin']) && !isset($_SESSION['adminLogin'])) {
  header("location: login.php");
}

function refresh($site)
{
  echo " <meta http-equiv='refresh' content='0;$site' />";
}

require_once("include/header.php");

$errors = [];
if (isset($_GET['proceed'])) {
  $state = check($_GET['name'], $_GET['phone'], $_GET['city'], $_GET['district']);
  if ($state == true) {
    $totalQuantity = 0;
    foreach ($_SESSION['shopping_cart'] as $keys => $values) {
      $totalQuantity += $values['item_quantity'];
    }
    $query = "INSERT INTO orders (user_id,order_status,order_date,product_quantity,order_total_amount,city_name	, street_name , phone_number)
              VALUES ({$_SESSION['userLogin']},'Order Placed',NOW(),{$totalQuantity},{$_SESSION['cart_total_price']},'{$_GET['city']}','{$_GET['district']}','{$_GET['phone']}')";
    mysqli_query($connection, $query);
    $query   = "SELECT order_id FROM orders WHERE orders.user_id = '{$_SESSION['userLogin']}' ORDER BY order_id DESC LIMIT 1;";
    $result  = mysqli_query($connection, $query);
    $row     = mysqli_fetch_assoc($result);
    $orderId = $row['order_id'];
    foreach ($_SESSION['shopping_cart'] as $keys => $values) {
      $query = "INSERT INTO users_cart (user_id,product_id,order_id,quantity,sub_total,size_cart) 
     VALUES ('{$_SESSION['userLogin']}','{$values['item_id']}','{$orderId}','{$values['item_quantity']}','{$values['item_total_price']}', '{$values['item_size']}')";
      mysqli_query($connection, $query);
    }
    // echo "<script> Swal.fire('The Order Confirmed','It will be delivered within 3 to 5 working days <br><br> Thank you for your visit  ','success') </script>";
    unset($_SESSION['shopping_cart']);
    unset($_SESSION['cart_total_price']);
    $_SESSION['refresh'] = true;
    sleep(1);
    refresh('index.php');
  }
}

function check($name, $phone, $city, $district)
{
  global $errors;
  $regexName      = "/^[A-z ]{3,}$/";
  $regexMobile = "/^[0-9]{10}$/";
  $state = true;
  // Validation
  if (empty($name) || trim($name) == "") {
    $errors[0] = "This field is required";
    $state     = false;
  } else if (!preg_match($regexName, $name)) {
    $errors[0] = "This field is not correct, only letters are allowed";
    $state     = false;
  }
  if (empty($phone) || trim($phone) == "") {
    $errors[1] = "This field is required";
    $state     = false;
  } else if (!preg_match($regexMobile, $phone)) {
    $errors[1] = "This field is not correct, must be 10 numbers";
    $state     = false;
  }
  if (empty($city) || trim($city) == "") {
    $errors[2] = "This field is required";
    $state     = false;
  }
  if (empty($district) || trim($district) == "") {
    $errors[3] = "This field is required";
    $state     = false;
  }
  if (!isset($_GET['selector'])) {
    $errors[4] = "Please check this field";
    $state     = false;
  }
  return $state;
}

?>

<head>
  <style>
    .error {
      color: red;
      font-size: 12px;
      font-family: Arial, Helvetica, sans-serif;
    }

    input.form-control {
      font-size: 13px;
    }

    .swal2-select {
      display: none;
    }
  </style>
</head>
<!--================Home Banner Area =================-->
<section class="banner_area">
  <div class="banner_inner d-flex align-items-center">
    <div class="container">
      <div class="banner_content d-md-flex justify-content-between align-items-center">
        <div class="mb-3 mb-md-0">
          <h2>Product Checkout</h2>
          <p>Very us move be blessed multiply night</p>
        </div>
        <div class="page_link">
          <a href="index.php">Home</a>
          <a href="checkout.php">Product Checkout</a>
        </div>
      </div>
    </div>
  </div>
</section>
<!--================End Home Banner Area =================-->

<!--================Checkout Area =================-->
<section class="checkout_area section_gap">
  <div class="container">
    <!-- <div class="cupon_area">
      <div class="check_title">
        <h2>
          Have a coupon?
        </h2>
      </div>
      <input type="text" placeholder="Enter coupon code" />
      <a class="tp_btn" href="#">Apply Coupon</a>
    </div> -->
    <div class="billing_details">
      <div class="row">
        <div class="col-lg-8">
          <h3>Billing Details</h3>
          <form class="row contact_form" action="" method="get">
            <div class="col-md-12 form-group p_star">
              <input type="text" placeholder="Full Name" class="form-control" id="first" name="name" />
              <span class="error"><?php echo $errors[0] ?? ""; ?></span>
            </div>
            <div class="col-md-12 form-group p_star">
              <input type="text" placeholder="Phone number" class="form-control" id="number" name="phone" />
              <span class="error"><?php echo $errors[1] ?? ""; ?></span>
            </div>
            <div class="col-md-12 form-group p_star">
              <input type="text" placeholder="City" class="form-control" id="city" name="city" />
              <span class="error"><?php echo $errors[2] ?? ""; ?></span>
            </div>
            <div class="col-md-12 form-group p_star">
              <input type="text" placeholder="District" class="form-control" id="district" name="district" />
              <span class="error"><?php echo $errors[3] ?? ""; ?></span>
            </div>
            <div class="col-md-12 form-group">
              <textarea class="form-control" name="message" id="message" rows="1" placeholder="Order Notes"></textarea>
            </div>
        </div>
        <div class="col-lg-4">
          <div class="order_box">
            <h2>Your Order</h2>
            <ul class="list">
              <li>
                <a>Product
                  <span>Total</span>
                </a>
              </li>
              <?php
              if (isset($_SESSION['shopping_cart'])) {
                foreach ($_SESSION['shopping_cart'] as $keys => $values) {
                  if (is_array($values)) { ?>

                    <li>
                      <a><?php echo $values['item_name']; ?>
                        <span class="middle"><?php echo "x " . $values['item_quantity'] ?? ""; ?></span>
                        <span class="middle"><?php echo $values['item_size'] ?? ""; ?></span>
                        <span class="last"><?php echo "JD " . $values['item_total_price'] ?? ""; ?></span>
                      </a>
                    </li>
              <?php }
                }
              } ?>
            </ul>
            <ul class="list list_2">
              <li>
                <a>Total
                  <?php
                  if (isset($_SESSION['cart_total_price'])) {
                  ?>
                    <span><?php echo "JD " . $_SESSION['cart_total_price']; ?></span>
                  <?php } ?>
                </a>
              </li>
            </ul>
            <div class="mt-3 creat_account">
              <input type="checkbox" id="f-option4" name="selector" />
              <label class="mb-0" for="f-option4">I’ve read and accept the </label>
              <a href="#">terms & conditions*</a>
              <span class="error mx-4"><?php echo $errors[4] ?? ""; ?></span>
            </div>
            <button class="main_btn" type="submit" name="proceed">Proceed</button>
          </div>
        </div>
        </form>
      </div>
    </div>
  </div>
</section>
<!--================End Checkout Area =================-->

<!--================ start footer Area  =================-->
<footer class="footer-area section_gap">
  <div class="container">
    <div class="row">
      <div class="col-lg-2 col-md-6 single-footer-widget">
        <h4>Top Products</h4>
        <ul>
          <li><a href="#">Managed Website</a></li>
          <li><a href="#">Manage Reputation</a></li>
          <li><a href="#">Power Tools</a></li>
          <li><a href="#">Marketing Service</a></li>
        </ul>
      </div>
      <div class="col-lg-2 col-md-6 single-footer-widget">
        <h4>Quick Links</h4>
        <ul>
          <li><a href="#">Jobs</a></li>
          <li><a href="#">Brand Assets</a></li>
          <li><a href="#">Investor Relations</a></li>
          <li><a href="#">Terms of Service</a></li>
        </ul>
      </div>
      <div class="col-lg-2 col-md-6 single-footer-widget">
        <h4>Features</h4>
        <ul>
          <li><a href="#">Jobs</a></li>
          <li><a href="#">Brand Assets</a></li>
          <li><a href="#">Investor Relations</a></li>
          <li><a href="#">Terms of Service</a></li>
        </ul>
      </div>
      <div class="col-lg-2 col-md-6 single-footer-widget">
        <h4>Resources</h4>
        <ul>
          <li><a href="#">Guides</a></li>
          <li><a href="#">Research</a></li>
          <li><a href="#">Experts</a></li>
          <li><a href="#">Agencies</a></li>
        </ul>
      </div>
      <div class="col-lg-4 col-md-6 single-footer-widget">
        <h4>Newsletter</h4>
        <p>You can trust us. we only send promo offers,</p>
        <div class="form-wrap" id="mc_embed_signup">
          <form target="_blank" action="https://spondonit.us12.list-manage.com/subscribe/post?u=1462626880ade1ac87bd9c93a&amp;id=92a4423d01" method="get" class="form-inline">
            <input class="form-control" name="EMAIL" placeholder="Your Email Address" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Your Email Address '" required="" type="email">
            <button class="click-btn btn btn-default">Subscribe</button>
            <div style="position: absolute; left: -5000px;">
              <input name="b_36c4fd991d266f23781ded980_aefe40901a" tabindex="-1" value="" type="text">
            </div>

            <div class="info"></div>
          </form>
        </div>
      </div>
    </div>
    <div class="footer-bottom row align-items-center">
      <p class="footer-text m-0 col-lg-8 col-md-12">
        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
        Copyright &copy;<script>
          document.write(new Date().getFullYear());
        </script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib---</a>Downloaded from <a href="https://themeslab.org/" target="_blank">Themeslab</a>
        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
      </p>
      <div class="col-lg-4 col-md-12 footer-social">
        <a href="#"><i class="fa fa-facebook"></i></a>
        <a href="#"><i class="fa fa-twitter"></i></a>
        <a href="#"><i class="fa fa-dribbble"></i></a>
        <a href="#"><i class="fa fa-behance"></i></a>
      </div>
    </div>
  </div>
</footer>
<!--================ End footer Area  =================-->

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="js/jquery-3.2.1.min.js"></script>
<script src="js/popper.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/stellar.js"></script>
<script src="vendors/lightbox/simpleLightbox.min.js"></script>
<script src="vendors/nice-select/js/jquery.nice-select.min.js"></script>
<script src="vendors/isotope/imagesloaded.pkgd.min.js"></script>
<script src="vendors/isotope/isotope-min.js"></script>
<script src="vendors/owl-carousel/owl.carousel.min.js"></script>
<script src="js/jquery.ajaxchimp.min.js"></script>
<script src="js/mail-script.js"></script>
<script src="vendors/jquery-ui/jquery-ui.js"></script>
<script src="vendors/counter-up/jquery.waypoints.min.js"></script>
<script src="vendors/counter-up/jquery.counterup.js"></script>
<script src="js/theme.js"></script>
</body>

</html>