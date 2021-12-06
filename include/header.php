<?php
$connection = mysqli_connect("localhost", "root", "", "ecommerce2");
// For Logout
if (isset($_GET['status']) && $_GET['status'] == 'logout') {
  unset($_SESSION['userLogin']);
  unset($_SESSION['adminLogin']);
  unset($_SESSION['shopping_cart']);
  header("Location: index.php");
}

// For Comments
if (isset($_GET['comment'])) {
  if (isset($_SESSION['userLogin'])) {
    $sql = "INSERT INTO comments (user_id,prodcut_id,comment_content,comment_date) 
    VALUES ('{$_SESSION['userLogin']}','{$_GET['id']}','{$_GET['message']}', NOW())";
    mysqli_query($connection, $sql);
    $id = $_GET['id'];
    header("location: single-product.php?id={$id}");
  } else {
    echo "<script>alert('You must be logged in')</script>";
  }
}

// For Add To Cart
if (isset($_GET["action"]) && $_GET["action"] == "add_to_cart") {

  // Get Data of specific item
  $query         = "SELECT * FROM products WHERE product_id = {$_GET['id']}";
  $result        = mysqli_query($connection, $query);
  $row           = mysqli_fetch_assoc($result);
  if ($row['product_price_on_sale'] == 0) {
    $thePrice = $row['product_price'];
  } else {
    $thePrice = $row['product_price_on_sale'];
  }
  if (isset($_SESSION["shopping_cart"])) {
    $item_array_id = array_column($_SESSION["shopping_cart"], "item_id");
    if (!in_array($_GET["id"], $item_array_id)) {
      $count = count($_SESSION["shopping_cart"]);
      $item_array = array(
        'item_id'              =>    $_GET['id'],
        'item_name'            =>    $row['product_name'],
        'item_price'           =>    $thePrice,
        'item_quantity'        =>    $_GET['quantity'],
        'item_total_price'     =>    $thePrice * $_GET['quantity'],
        'item_image'           =>    $row['product_m_img'],
        'item_size'            =>    $_GET['size'] ?? "S"
      );
      $_SESSION["shopping_cart"][$count] = $item_array;
    }
    // IF item is exist in session
    else {
      foreach ($_SESSION["shopping_cart"] as $keys => $values) {
        if ($values['item_id'] == $_GET['id']) {
          $newQuantity = $_GET['quantity'] + $values['item_quantity'];
          $newPrice    = $newQuantity * $values['item_price'];
          $_SESSION["shopping_cart"][$keys]['item_quantity'] = $newQuantity;
          $_SESSION["shopping_cart"][$keys]['item_total_price'] = $newPrice;
          $_SESSION["shopping_cart"][$keys]['item_size'] = $_GET['size'];
        }
      }
    }
    if (isset($_GET['page'])) {
      if ($_GET['page'] == "cat") {
        header("Location: category.php");
      }
      if ($_GET['page'] == "index") {
        header("Location: index.php");
      }
    }
  }
  // IF Session not exist
  else {
    $item_array = array(
      'item_id'           =>    $_GET["id"],
      'item_name'         =>    $row['product_name'],
      'item_price'        =>    $thePrice,
      'item_quantity'     =>   $_GET['quantity'],
      'item_total_price'  =>   $thePrice * $_GET['quantity'],
      'item_image'        =>    $row['product_m_img'],
      'item_size'            =>    $_GET['size'] ?? "S"
    );
    $_SESSION["shopping_cart"][0] = $item_array;
  }
  $totalCart = 0;
  foreach ($_SESSION['shopping_cart'] as $keys => $values) {
    $totalCart += $values['item_total_price'];
  }
  $_SESSION['cart_total_price'] = $totalCart;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <link rel="icon" href="img/favicon.png" type="image/png" />
  <title>Eiser ecommerce</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="css/bootstrap.css" />
  <link rel="stylesheet" href="vendors/linericon/style.css" />
  <link rel="stylesheet" href="css/font-awesome.min.css" />
  <link rel="stylesheet" href="css/themify-icons.css" />
  <link rel="stylesheet" href="css/flaticon.css" />
  <link rel="stylesheet" href="vendors/owl-carousel/owl.carousel.min.css" />
  <link rel="stylesheet" href="vendors/lightbox/simpleLightbox.css" />
  <link rel="stylesheet" href="vendors/nice-select/css/nice-select.css" />
  <link rel="stylesheet" href="vendors/animate-css/animate.css" />
  <link rel="stylesheet" href="vendors/jquery-ui/jquery-ui.css" />
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
  <!-- main css -->
  <link rel="stylesheet" href="css/style.css" />
  <link rel="stylesheet" href="css/responsive.css" />
  <link rel="stylesheet" href="css/slider.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.css" rel="stylesheet" />
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <style>
    i.ti {
      cursor: pointer;
    }

    .myBtn {
      border: none;
      background: transparent;
    }

    .myBtn a {
      color: white !important;
    }

    .myBtn a:hover {
      color: black !important;
    }

    .mylinks>li,
    .mylinks>p {
      transition: 0.3s all ease;
    }

    .mylinks>li:hover,
    .mylinks>p:hover {
      color: white;
    }

    [class^="ti-"] {
      font-size: 20px;
    }

    .cont {
      display: flex;
    }

    @media (max-width:500px) {
      .cont {
        margin-top: 10px;
      }

      .cont>li:nth-of-type(1) {
        margin-left: 0;
      }
    }
  </style>
</head>

<body>
  <!--================Header Menu Area =================-->
  <header class="header_area">
    <div class="main_menu">
      <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light w-100">
          <!-- Brand and toggle get grouped for better mobile display -->
          <a class="navbar-brand logo_h" href="index.php">
            <img src="img/styleloft-03.svg" style="    width: 140px ; height: 50px;" alt="" />
          </a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse offset w-100" id="navbarSupportedContent">
            <div class="row w-100 mr-0">
              <div class="col-lg-7 pr-0">
                <ul class="nav navbar-nav center_nav pull-right">
                  <li class="nav-item active">
                    <a class="nav-link" href="index.php">Home</a>
                  </li>
                  <li class="nav-item submenu dropdown">
                    <a href="category.php" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Shop</a>
                    <ul class="dropdown-menu">
                      <li class="nav-item">
                        <a class="nav-link" href="category.php">All Categories</a>
                      </li>
                      <?php
                      $sql    = "SELECT * FROM categories";
                      $result = mysqli_query($connection, $sql);
                      while ($row = mysqli_fetch_assoc($result)) {
                        $category_id = $row['category_id'];
                        $category_name = $row['category_name'];
                      ?>
                        <li class=" nav-item">
                          <a class="nav-link" href="individual_category.php?c_id=<?php echo $category_id; ?>"><?php echo $category_name ?></a>
                        </li>
                      <?php } ?>

                    </ul>
                  </li>
                  <?php
                  if (isset($_SESSION['userLogin']) || isset($_SESSION['adminLogin'])) { ?>
                    <li class="nav-item">
                      <a class="nav-link mylink" href="index.php?status=logout">Logout</a>
                    </li>
                  <?php
                  } else { ?>
                    <li class="nav-item">
                      <a class="nav-link mylink" href="login.php">Login</a>
                    </li>
                  <?php } ?>
                  <?php
                  if (isset($_SESSION['adminLogin'])) { ?>
                    <li class="nav-item">
                      <a class="nav-link" href="admin/index.php">Admin</a>
                    </li>
                  <?php } ?>
                </ul>
              </div>

              <div class="col-lg-5 pr-0">
                <ul class="nav navbar-nav navbar-right right_nav pull-right">
                  <div class="h-25 my-auto">
                    <form action="search.php" method="post">
                      <input class="px-2 py-1" name="search" type="text" class="searchTerm " placeholder="What are you looking for?">
                      <button class="myBtn" type="submit" name="submit" class="searchButton">
                        <i style="cursor:pointer ; margin-left: 0;" class="ti-search icons" aria-hidden="true"></i>
                      </button>
                    </form>
                  </div>
                  <div class="cont">
                    <li class="nav-item" style="padding-top: 3px;">
                      <a href="cart.php" class="icons">
                        <i class="ti-shopping-cart"></i>
                        <span class="ml-1"><?php
                                            if (isset($_SESSION['shopping_cart'])) {
                                              $totalQuantity = 0;
                                              foreach ($_SESSION['shopping_cart'] as $keys => $values) {
                                                $totalQuantity += $values['item_quantity'];
                                              }
                                              echo $totalQuantity;
                                            } else {
                                              echo "";
                                            }
                                            ?>
                        </span>
                      </a>
                    </li>
                    <li class="nav-item" style="padding-top: 3px;">
                      <a href=" profile.php" class="icons">
                        <i class="ti-user" aria-hidden="true"></i>
                      </a>
                    </li>
                  </div>
                </ul>
              </div>
            </div>
          </div>
        </nav>
      </div>
    </div>
  </header>
  <!--================Header Menu Area =================-->