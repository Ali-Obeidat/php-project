<?php
session_start();
include("./include/header.php");
include("function.php");
?>

<?php //specific category 
if (isset($_GET["id"])) {
  $id = $_GET["id"];
  singleCategory($id);
} ?>
<!--================ Feature Product Area =================-->

<section class="feature_product_area section_gap_bottom_custom mt-5">
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
      $query = "SELECT * FROM products 
                              INNER JOIN categories ON 
                              products.category_id = categories.category_id
                              WHERE products.category_id='1' ";

      $select_product = mysqli_query($conn, $query);
      while ($row = mysqli_fetch_assoc($select_product)) {
        $product_id = $row['product_id'];
        $product_name = $row['product_name'];
        $product_description = $row['product_description'];
        $product_old_price = $row['product_price'];
        $product_new_price = $row['product_price_on_sale'];
        $product_img = $row['product_m_img'];
        $product_sale_status = $row['sale_status'];
        $category_id = $row['category_id'];
      ?>


        <div class="col-lg-4 col-md-6">
          <div class="single-blog">
            <div class="thumb">

              <?php echo $product_name ?>
              <img class="img-fluid" src="image/<?php echo $product_img ?>" alt="111">
              <?php echo "<STRONG> " . $product_new_price . "JD" . "</STRONG>" ?>
            </div>
          </div>
        </div>
      <?php  } ?>
    </div>

</section>


<!--================ End Feature Product Area =================-->



<?php include("./include/footer.php") ?>