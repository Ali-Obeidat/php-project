<?php
$connection = mysqli_connect("localhost", "root", "", "ecommerce2");
session_start();

if (isset($_GET['update'])) {
  if (isset($_SESSION['shopping_cart'])) {
    $i = 1;
    foreach ($_SESSION['shopping_cart'] as $keys => $values) {
      $_SESSION["shopping_cart"][$keys]['item_quantity'] = $_GET['quantity' . $i];
      $_SESSION["shopping_cart"][$keys]['item_total_price'] = $values['item_price'] * $_GET['quantity' . $i];
      $_SESSION["shopping_cart"][$keys]['item_size'] = $_GET['size' . $i];
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

    .cart_area {
      padding-top: 30px;
      padding-bottom: 30px;
    }

    .cart_inner .table tbody tr td {
      padding-top: 10px;
      padding-bottom: 10px;
    }

    .cart_inner .table tbody tr td:nth-last-child(2) {
      width: 100px;
    }

    .cart_inner .table tbody tr:last-of-type td {
      padding-bottom: 0px;
    }

    .table-responsive {
      overflow-y: hidden;
      overflow-x: auto;
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
            <button class="main_btn d-block ml-auto mr-0 mb-4" name="update" type="submit">Update Cart</button>
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
                  <td>
                    <select name="size<?php echo $i; ?>" class="form-select w-25 mr-3 text-dark " aria-label="Default select example" style="display: none;">
                      <?php
                      $sql    = "SELECT * from products WHERE product_id = {$values['item_id']}";
                      $result = mysqli_query($connection, $sql);
                      $row    = mysqli_fetch_assoc($result);
                      $arraySize = explode(",", $row['product_sizes']);
                      foreach ($arraySize as $keys => $value) {
                        if ($value == $values['item_size']) { ?>
                          <option selected value="<?php echo $value ?>"><?php echo $value ?></option>
                        <?php } else { ?> <option value="<?php echo $value ?>"><?php echo $value ?></option>
                      <?php }
                      }
                      ?>
                    </select>
                  </td>
                  <td><?php echo $values['item_quantity'] * $values['item_price']; ?></td>
                </tr>
            <?php $i++;
              }
            }
            ?>
          </form>
        </tbody>
      </table>
      <h5 class="text-right border-top border-bottom py-3 pr-3">Total Amount: <span class="ml-2"><?php
                                                                                                  if (isset($_SESSION['shopping_cart'])) {
                                                                                                    $total = 0;
                                                                                                    foreach ($_SESSION['shopping_cart'] as $keys => $values) {
                                                                                                      $total += $values['item_price'] * $values['item_quantity'];
                                                                                                    }
                                                                                                    echo $total;
                                                                                                  }
                                                                                                  ?></span></h5>
      <div class="checkout_btn_inner mt-3">
        <a class="gray_btn myBtnshop" href="category.php">Shop</a>
        <a class="main_btn" href="checkout.php">Proceed</a>
      </div>
    </div>
  </div>
</section>
<!--================End Cart Area =================-->

<?php require_once("include/footer.php");
