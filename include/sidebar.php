<?php
$query = "SELECT * FROM categories";
$product_query = mysqli_query($connection, $query);
?>
<div class="col-lg-3">
  <div class="left_sidebar_area">
    <aside class="left_widgets p_filter_widgets">
      <div class="l_w_title">
        <h3>Browse Categories</h3>
      </div>
      <div class="widgets_inner">
        <ul class="list">
          <?php
          while ($row = mysqli_fetch_assoc($product_query)) {
            $category_id = $row['category_id'];
            $category_name = $row['category_name'];

          ?>
            <li>
              <a href="individual_category.php?c_id=<?php echo $category_id  ?>"><?php echo $category_name ?></a>
            </li>
          <?php } ?>
        </ul>
      </div>
    </aside>
  </div>
</div>