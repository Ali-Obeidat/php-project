<?php
if(isset($_GET['product_category'])){
    $id= $_GET['product_category'];
    
}
$query = "SELECT * FROM categories WHERE category_id = $id";
    $select_categories = mysqli_query($connection, $query );
    $row_cat = mysqli_fetch_assoc($select_categories); 
    $category_title= $row_cat ['category_name'];
    $category_id= $row_cat ['category_id'];
?>
<form action="" method="get">
            <label for=""> <h2>Select Category</h2></label>
            <div class="Category " style="display: flex; flex-direction: row; padding-bottom: 10px ;" >
              <select class="form-control col-lg-4" name="product_category">
              <option value="<?php echo $category_id ?>"><?php echo $category_title ?></option>                      <?php 
                      $query = "SELECT * FROM categories ";
                      $select_categories = mysqli_query($connection, $query );
                      while($row = mysqli_fetch_assoc($select_categories) ) {
                        $category_id = $row['category_id'];  
                        $category_name= $row['category_name'];
                        if ($category_name ==$category_title ) {
                            continue;
                        }
                        ?>
                        <option value="<?php echo $category_id  ?>"> <?php echo $category_name ?></option>
                        <?php
                            }
                        ?>
                        <option value="0">All categories</option>

                    </select>
                
                  <button class="btn btn-theme" name="Filter" value="on" type="submit">Filter </button>
                </div>
                </form>
<div class="content-panel">
              <h4><i class="fa fa-angle-right"></i> <?php echo $category_title ?> Table</h4>
              <section id="no-more-tables">
                <table class="table table-bordered table-striped table-condensed cf">
                <thead>
                  <tr>
                    <th>Id</th>
                    <th>Product Name</th>
                    <th>Product Description</th>
                    <th>Min Image</th>
                    <th>Sub Images</th>
                    <th>Product Price</th>
                    <th>product price on sale</th>
                    <th>sale status</th>
                    <th>product featured</th>
                    <th>product quantity</th>
                    <th>category</th>
                    <th>Tags</th>

                  </tr>
                </thead>
                  <tbody>
                  <?php 
                            // view all posts
                        $query = "SELECT * FROM products INNER JOIN categories
                        ON products.category_id  = categories.category_id WHERE categories.category_id = $id";
                        $select_product = mysqli_query($connection, $query );
                        if(!$select_product ){
                            die('Query Failed'. mysqli_error($connection));
                         }
                        while($row = mysqli_fetch_assoc($select_product)) {
                            $product_id= $row['product_id'];
                            $product_name= $row['product_name'];
                            $product_description= $row['product_description'];
                            $product_price= $row['product_price'];
                            $product_price_on_sale = $row['product_price_on_sale'];
                            $sale_status = $row['sale_status'];
                            $min_image = $row['product_m_img'];
                            $sub_image1 = $row['product_sub1_img'];
                            $sub_image2 = $row['product_sub2_img'];
                            $sub_image3 = $row['product_sub3_img'];
                            $category_name = $row['category_name'];
                            $product_tags = $row['product_tags'];
                            $product_quantity = $row['product_quantity'];
                            $product_featured = $row['product_featured'];
                            ?>
                        <tr>
                      <td data-title="Code"><?php echo $product_id ?></td>
                      <td data-title=""><?php echo $product_name ?></td>
                      <td data-title="Company"><?php echo $product_description ?></td>
                      <td> <img width="100" src="../image/<?php echo $min_image; ?>" alt=""> </td>
                      <td>
                        <li><img width="100" src="../image/<?php echo $sub_image1; ?>" alt=""></li>
                        <li><img width="100" src="../image/<?php echo $sub_image2; ?>" alt=""></li>
                      </td>
                      <td class="numeric" data-title="Change %">$<?php echo $product_price ?></td>
                      <td class="numeric" data-title="Open">$<?php echo $product_price_on_sale ?></td>
                      <td class="numeric" data-title="High"><?php echo $sale_status ?></td>
                      <td class="numeric" data-title="Low"><?php echo $product_featured ?></td>
                      <td class="numeric" data-title="Volume"><?php echo $product_quantity ?></td>
                      <td class="numeric" data-title="Volume"><?php echo $category_name ?></td>
                      <td class="numeric" data-title="Volume"><?php echo $product_tags ?></td>
                      <td><a href='manage_admin.php?source=edit_admin&edit=<?php echo $product_id ?>' class="btn btn-theme">edit</a></td>
                      <td><a href="show_products.php?delete=<?php echo $product_id ?>" class="btn btn-danger">delete</a></td>
                    </tr>
                    <?php }?>
                  </tbody>
                </table>
              </section>
            </div>