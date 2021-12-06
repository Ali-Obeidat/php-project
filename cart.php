<?php
$connection = mysqli_connect("localhost", "root", "", "ecommerce2");
session_start();

if (isset($_GET['update'])) {
  if (isset($_SESSION['shopping_cart'])) {
    $i = 1;
    foreach ($_SESSION['shopping_cart'] as $keys => $values) {
      $_SESSION["shopping_cart"][$keys]['item_quantity'] = $_GET['quantity' . $i];
      $_SESSION["shopping_cart"][$keys]['item_total_price'] = $values['item_price'] * $_GET['quantity' . $i];
      $i++;
    }
    $totalCart = 0;
    foreach ($_SESSION['shopping_cart'] as $keys => $values) {
      $totalCart += $values['item_total_price'];
    }
    $_SESSION['cart_total_price'] = $totalCart;
  }
}

if (isset($_GET['delete'])) {
  if (isset($_SESSION['shopping_cart'])) {
    foreach ($_SESSION['shopping_cart'] as $keys => $values) {
      if ($_SESSION["shopping_cart"][$keys]['item_id'] == $_GET['delete']) {
        unset($_SESSION["shopping_cart"][$keys]);
        $_SESSION["shopping_cart"] = array_values($_SESSION["shopping_cart"]);
        break;
      }
    }
    $totalCart = 0;
    foreach ($_SESSION['shopping_cart'] as $keys => $values) {
      $totalCart += $values['item_total_price'];
    }
    $_SESSION['cart_total_price'] = $totalCart;
  }
}

require_once("./include/header.php");

?>

<head>

  <style>
    .productCount {
      display: inline-block;
      position: relative;
    }

    .productCount>input {
      height: 40px;
      outline: none;
      box-shadow: none;
      width: 76px;
      border: 1px solid #eeeeee;
      border-radius: 3px;
      text-align: center;
    }

    .myBtn {
      cursor: pointer;
      border: none;
    }

    .myBtn i:not(.ti-search) {
      color: #FF0000;
      font-size: 26px;
    }

    .main_btn.red {
      background-color: red;
    }

    .main_btn.red:hover {
      color: red;
      background: transparent;
      border: 1px solid red;
    }

    .cupon_text,
    .checkout_btn_inner {
      margin-left: 0px !important;
      display: flex;
      justify-content: end;
    }

    .myBtnshop {
      margin-right: 10px;
    }

    .myBtnshop:hover {
      background-color: #71CD14;
      color: white;
    }
  </style>

</head>

<!--================Home Banner Area =================-->
<section class="banner_area">
  <div class="banner_inner d-flex align-items-center">
    <div class="container">
      <div class="banner_content d-md-flex justify-content-between align-items-center">
        <div class="mb-3 mb-md-0">
          <h2>Cart</h2>
          <p>Very us move be blessed multiply night</p>
        </div>
        <div class="page_link">
          <a href="index.php">Home</a>
          <a href="cart.php">Cart</a>
        </div>
      </div>
    </div>
  </div>
</section>
<!--================End Home Banner Area =================-->

<!--================Cart Area =================-->
<section class="cart_area">
  <div class="container">
    <div class="cart_inner">
      <div class="table-responsive">
        <table class="table">
          <thead>
            <tr>
              <th scope="col"></th>
              <th scope="col">Image</th>
              <th scope="col">Product</th>
              <th scope="col">Price</th>
              <th scope="col">Quantity</th>
              <th scope="col">Size</th>
              <th scope="col">Total</th>
            </tr>
          </thead>
          <tbody>
            <!-- My Code -->
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get">
              <?php
              $i = 1;
              if (isset($_SESSION['shopping_cart'])) {
                foreach ($_SESSION['shopping_cart'] as $keys => $values) { ?>
                  <tr>
                    <td> <button class="myBtn myBtnCart" value="<?php echo $values['item_id']; ?>" name="delete" type="submit"><i class="fas fa-times"></i></button></td>
                    <td><img style="width: 100px;" src="image/<?php echo $values['item_image'];  ?>" alt=""></td>
                    <td><?php echo $values['item_name']; ?></td>
                    <td><?php echo $values['item_price']; ?></td>
                    <td>
                      <div class="productCount">
                        <input type="number" min="1" name="quantity<?php echo $i ?>" value="<?php echo $values['item_quantity']; ?>">
                      </div>
                    </td>
                    <td><?php echo $values['item_size'] ?></td>
                    <td><?php echo $values['item_quantity'] * $values['item_price']; ?></td>
                  </tr>
              <?php $i++;
                }
              }
              ?>
              <!-- My Code -->
              <tr class="bottom_button">
                <td>
                  <button class="main_btn" name="update" type="submit">Update Cart</button>
                </td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
              </tr>
            </form>
            <tr>
              <td></td>
              <td></td>
              <td></td>
              <td colspan="3">
                <div class="cupon_text px-5">
                  <h5 class="mx-5">Subtotal</h5>
                  <h5>
                    <?php
                    if (isset($_SESSION['shopping_cart'])) {
                      $total = 0;
                      foreach ($_SESSION['shopping_cart'] as $keys => $values) {
                        $total += $values['item_price'] * $values['item_quantity'];
                      }
                      echo $total;
                    }
                    ?>
                  </h5>
                </div>
              </td>
            </tr>
            <tr class="out_button_area">
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td>
                <div class="checkout_btn_inner">
                  <a class="gray_btn myBtnshop" href="category.php">Shop</a>
                  <a class="main_btn red" href="checkout.php">Proceed</a>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</section>
<!--================End Cart Area =================-->

<?php require_once("include/footer.php");
