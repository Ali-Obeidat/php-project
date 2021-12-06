<?php
if (isset($_GET['show'])) {
  $id = $_GET['show'];
  $query = "SELECT * FROM orders 
                    INNER JOIN users ON orders.user_id = users.user_id  WHERE orders.order_id = $id";
  $select_product = mysqli_query($connection, $query);
  $row = mysqli_fetch_assoc($select_product);
  $user_name = $row['user_name'];
?>
  <div class="form-panel">
    <h4><i class="fa fa-angle-right"></i> Order For <?php echo $user_name ?></h4>
    <section id="unseen">
      <table class="table table-bordered table-striped table-condensed">
        <thead>
          <tr>
            <th>Id</th>
            <th>Product Image</th>
            <th> Product Name</th>
            <th>Product Quantity</th>
            <th>Product Size</th>
            <th>Order Date</th>
            <th>order_sub_total</th>
            <th> Total</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <?php


          $query = "SELECT * FROM users_cart 
                 INNER JOIN users ON users_cart.user_id = users.user_id 
                 INNER JOIN orders ON users_cart.order_id = orders.order_id 
                 INNER JOIN products ON users_cart.product_id = products.product_id WHERE orders.order_id =$id";
          $select_product = mysqli_query($connection, $query);

          while ($row = mysqli_fetch_assoc($select_product)) {
            $order_id = $row['order_id'];
            $users_cart_id = $row['user_cart_id'];
            $user_name = $row['user_name'];
            $product_name = $row['product_name'];
            $product_quantity = $row['quantity'];
            $product_size     = $row['size_cart'];
            $product_img = $row['product_m_img'];
            $order_sub_total = $row['sub_total'];
            $order_date = $row['order_date'];
            $order_total = $row['order_total_amount'];
          ?>

            <tr>
              <td><?php echo $users_cart_id ?></td>
              <td> <img width="100" src="../image/<?php echo $product_img; ?>" alt=""> </td>
              <td data-title="Company"><?php echo $product_name ?></td>
              <td class="numeric">X <?php echo $product_quantity ?></td>
              <td> <?php echo $product_size ?></td>
              <td class="numeric"><?php echo $order_date ?></td>
              <td class="numeric"><?php echo $order_sub_total ?> JD</td>
              <td class="numeric"></td>
              <td><a href="manage_order.php?source=show_order&show=3&delete=<?php echo $users_cart_id ?>" class="btn btn-danger">delete</a></td>
            </tr>
          <?php } ?>
          <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td><?php echo $order_total ?> JD</td>
            <td></td>
          </tr>
        </tbody>
      </table>
      <a style="align-items: end;" href="manage_order.php" class="btn btn-danger">Close</a </section>
  </div>
<?php
}
?>
<?php
if (isset($_GET['delete'])) {
  global $connection;
  $the_user_cart_id = $_GET['delete'];
  $query = "DELETE FROM users_cart WHERE user_cart_id = {$the_user_cart_id} ";
  $delete_query = mysqli_query($connection, $query);
  header("Location: manage_order.php");
}
?>