<?php function singleCategory ($id){

 $conn = mysqli_connect("localhost","root","","ecommerce2");?>

 <div class="row">
     <?php 
 $query = "SELECT * FROM products 
 INNER JOIN categories ON 
 products.category_id = categories.category_id
 WHERE products.category_id=$id";
  
$select_product = mysqli_query($conn, $query );
while($row = mysqli_fetch_assoc($select_product)) {
$product_id= $row['product_id'];
$product_name= $row['product_name'];
$product_description= $row['product_description'];
$product_old_price= $row['product_price'];
$product_new_price= $row['product_price_on_sale'];
$product_img= $row['product_m_img'];
$product_sale_status= $row['sale_status'];
$category_id= $row['category_id'];
?>

<div class="col-lg-4 col-md-6">
<div class="single-blog">
<div class="thumb">

<?php echo $product_name ?>
<img class="img-fluid" src="img/<?php echo $product_img?>" alt="111">
<?php echo"<STRONG> ".$product_new_price ."JD" ."</STRONG>" ?>
</div>
</div>  
</div>

<?php  }?>

<?php } ?>