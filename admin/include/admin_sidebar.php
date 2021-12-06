<?php

$query = "SELECT * FROM admins WHERE admin_id = '{$_SESSION['adminLogin']}'";
$select_admin = mysqli_query($connection, $query);
$row = mysqli_fetch_assoc($select_admin);
$admin_id        = $row['admin_id'];
$admin_name         = $row['admin_name'];
$admin_email           = $row['admin_email'];
$admin_image            = $row['admin_img'];
?>


<aside>
  <div id="sidebar" class="nav-collapse ">
    <!-- sidebar menu start-->
    <ul class="sidebar-menu" id="nav-accordion">
      <p class="centered"><a href="index.php"><img src="../image/<?php echo $admin_image ?>" class="img-circle" width="80"></a></p>
      <h5 class="centered"><?php echo $admin_name ?></h5>
      <li class="mt">
        <a class="active" href="index.php">
          <i class="fa fa-dashboard"></i>
          <span>Dashboard</span>
        </a>
      </li>
      <li class="sub-menu">
        <a class="sub-menu" href="manage_admin.php">
          <i class="fa fa-dashboard"></i>
          <span>Manage Admins</span>
        </a>
      </li>

      <li class="sub-menu">
        <a href="manage_users.php">
          <i class="fa fa-desktop"></i>
          <span>Manage Users</span>
        </a>
      </li>
      <li class="sub-menu">
        <a href="manage_categories.php">
          <i class="fa fa-desktop"></i>
          <span>Manage categories</span>
        </a>
      </li>
      <li class="sub-menu">
        <a href="manage_comment.php">
          <i class="fa fa-desktop"></i>
          <span>Manage Comments</span>
        </a>
      </li>
      <li class="sub-menu">
        <a href="">
          <i class="fa fa-desktop"></i>
          <span>Manage Products</span>
        </a>
        <ul class="sub">
          <li><a href="show_products.php">Show Products</a></li>
          <li><a href="add_products.php">Add Products</a></li>

        </ul>
      </li>
      <li class="sub-menu">
        <a href="manage_order.php">
          <i class="fa fa-desktop"></i>
          <span>Orders</span>
        </a>
      </li>

    </ul>
    <!-- sidebar menu end-->
  </div>
</aside>