<?php
session_start();
$connection = mysqli_connect("localhost", "root", "", "ecommerce2");
require_once("./include/header.php");
?>


<!--================Home Banner Area =================-->
<section class="banner_area">
  <div class="banner_inner d-flex align-items-center">
    <div class="container">
      <div class="banner_content d-md-flex justify-content-between align-items-center">
        <div class="mb-3 mb-md-0">
          <h2>Product Details</h2>
          <p>Very us move be blessed multiply night</p>
        </div>
        <div class="page_link">
          <a href="index.php">Home</a>
          <a href="single-product.php">Product Details</a>
        </div>
      </div>
    </div>
  </div>
</section>
<!--================End Home Banner Area =================-->

<!--================Single Product Area =================-->
<?php
if (isset($_GET['id'])) {
  $p_id =  $_GET['id'];
}
global $connection;
$query = "SELECT * FROM products WHERE product_id = {$p_id}";
$single_product_query = mysqli_query($connection, $query);
if (!$single_product_query) {
  echo "NO";
}
?>
<div class="product_image_area">
  <div class="container">
    <div class="row s_product_inner">
      <div class="col-lg-6">
        <div class="s_product_img">
          <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
              <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active">
                <?php
                while ($row = mysqli_fetch_assoc($single_product_query)) {
                  $product_id = $row['product_id'];
                  $product_name = $row['product_name'];
                  $product_description = $row['product_description'];
                  $product_sub1_img = $row['product_sub1_img'];
                  $product_sub2_img = $row['product_sub2_img'];
                  $product_sub3_img = $row['product_sub3_img'];
                  $product_m_img = $row['product_m_img'];
                  $product_price = $row['product_price'];
                  $product_price_on_sale = $row['product_price_on_sale'];
                  $sale_status = $row['sale_status'];
                  $product_size = $row['product_sizes'];
                ?>
                  <img class="img-responsive" width="100%" src="image/<?php echo $product_m_img ?>" alt="" />
              </li>
              <li data-target="#carouselExampleIndicators" data-slide-to="1">
                <img class="img-responsive" width="100%" src="image/<?php echo $product_sub1_img ?>" alt="" />
              </li>
              <li data-target="#carouselExampleIndicators" data-slide-to="2">
                <img class="img-responsive" width="100%" src="image/<?php echo $product_sub2_img ?>" alt="" />
              </li>
            </ol>
            <div class="carousel-inner">
              <div class="carousel-item active">
                <img class="d-block w-100" src="image/<?php echo $product_m_img  ?>" alt="First slide" />
              </div>
              <div class="carousel-item">
                <img class="d-block w-100" src="image/<?php echo $product_sub1_img ?>" alt="Second slide" />
              </div>
              <div class="carousel-item">
                <img class="d-block w-100" src="image/<?php echo $product_sub2_img ?>" alt="Third slide" />
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-5 offset-lg-1">
        <div class="s_product_text">
          <h3><?php echo $product_name ?></h3>

          <h2 class="d-inline"> <?php
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
          </h2>
          <ul class="list">
            <?php

                  $query = "SELECT * FROM products INNER JOIN categories 
                        ON products.category_id = categories.category_name ";
                  $category_query = mysqli_query($connection, $query);

                  while ($row = mysqli_fetch_assoc($category_query)) {
                    $category_name = $row['category_name'];
                    $category_id = $row['category_id'];

            ?>
              <li>
                <a class="active" href="#">
                  <span>Category</span> : <?php echo $category_name ?></a>
              </li>
            <?php } ?>

            <li>
              <a href="#"> <span>Availibility</span> : In Stock</a>
            </li>
          </ul>
          <p>
            <?php echo $product_description ?>
          </p>
          <form action="" method="get">
            <div class="product_count">
              <label for="qty">Quantity:</label>
              <input type="number" name="quantity" id="sst" min="1" value="1" title="Quantity:" class="input-text qty" />
              <input type="hidden" name="id" value="<?php echo $product_id; ?>">
              <input type="hidden" name="action" value="add_to_cart">

              <button onclick="var result = document.getElementById('sst'); var sst = result.value; if( !isNaN( sst )) result.value++;return false;" class="increase items-count" type="button">
                <i class="lnr lnr-chevron-up"></i>
              </button>
              <button onclick="var result = document.getElementById('sst'); var sst = result.value; if( !isNaN( sst ) && sst > 0 ) result.value--;return false;" class="reduced items-count" type="button">
                <i class="lnr lnr-chevron-down"></i>
              </button>
            </div>
            <br>
            <select name="size" class="form-select w-25 mr-3 text-dark " aria-label="Default select example">


              <?php

                  $sizes =   explode(',', $product_size);
                  foreach ($sizes as $key => $value) {

              ?>
                <option value="<?php echo $value; ?>"><?php echo $value; ?> </option>


              <?php } ?>

            </select>
            <div class="card_area">
              <button class="myBtn" type="submit"><a class="main_btn">Add to cart</a></button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<?php } ?>
<!--================End Single Product Area =================-->

<!--================Product Description Area =================-->
<section class="product_description_area" style="padding-bottom: 0px">
  <div class="container">
    <ul class="nav nav-tabs" id="myTab" role="tablist">
      <li class="nav-item">
        <a class="nav-link" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Description</a>
      </li>

      <li class="nav-item">
        <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="true">Comments</a>
      </li>

    </ul>
    <div class="tab-content" id="myTabContent">
      <div class="tab-pane fade" id="home" role="tabpanel" aria-labelledby="home-tab">
        <p>
          <?php echo $product_description; ?>
        </p>
      </div>
      <?php

      $query = "SELECT * FROM comments INNER JOIN users 
              ON comments.user_id = users.user_id ";
      $comments_query = mysqli_query($connection, $query);

      while ($row = mysqli_fetch_assoc($comments_query)) {
        $comment_id = $row['id'];
        $user_id = $row['user_id'];
        $product_id = $row['prodcut_id'];
        $comment_date = $row['comment_date'];
        $comment_content = $row['comment_content'];
        $user_name = $row['user_name'];
        $user_img = $row['user_img'];
      } ?>
      <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
        <div class="row">
          <div class="col-lg-6">
            <div class="comment_list">
              <?php
              // NEW
              $query = "SELECT * FROM comments INNER JOIN users 
                      ON (comments.user_id = users.user_id) WHERE prodcut_id = {$_GET['id']} AND  comment_status = 'public' ";
              $comments_query = mysqli_query($connection, $query);

              while ($row = mysqli_fetch_assoc($comments_query)) {
                $comment_id = $row['id'];
                $user_id = $row['user_id'];
                $product_id = $row['prodcut_id'];
                $comment_date = $row['comment_date'];
                $comment_content = $row['comment_content'];
                $user_name = $row['user_name'];
                $user_img = $row['user_img'];
                $comment_status = $row['comment_status'];
              ?>
                <div class="review_item">
                  <div class="media">
                    <div class="d-inline mr-3">
                      <img width="75px" class="rounded-circle" src="image/<?php echo $user_img; ?>" alt="" />
                    </div>
                    <div class="media-body">
                      <h4><?php echo $user_name ?></h4>
                      <h5><?php echo $comment_date ?></h5>
                      <p class="">
                        <em class="">
                          <?php echo  $comment_content; ?>
                        </em>
                      </p>
                    </div>
                  </div>
                </div>
                <hr>

              <?php }
              if (isset($_SESSION['userLogin'])) { ?>
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get">
                  <div class="col-md-12">
                    <div class="form-group">
                      <textarea class="form-control" name="message" id="message" rows="3" placeholder="Add your comment"></textarea>
                      <input type="hidden" name="id" value="<?php echo $p_id ?>">
                    </div>
                  </div>
                  <div class="col-md-12 text-right">
                    <button type="submit" name="comment" class="btn submit_btn">
                      Submit Now
                    </button>
                  </div>
                </form>
              <?php } ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>







  <!--================End Product Description Area =================-->

  <!--================ start footer Area  =================-->
  <?php include("./include/footer.php") ?>