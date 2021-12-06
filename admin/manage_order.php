<?php include("include/function.php") ?>
<?php include("include/db.php") ?>
<?php include("include/admin_header.php") ?>
    <!--header end-->
    <!-- **********************************************************************************************************************************************************
        MAIN SIDEBAR MENU
        *********************************************************************************************************************************************************** -->
    <!--sidebar start-->
    <?php include("include/admin_sidebar.php") ?>
    <!--sidebar end-->
    <!-- **********************************************************************************************************************************************************
        MAIN CONTENT
        *********************************************************************************************************************************************************** -->
    <!--main content start-->
    <section id="main-content">
      <section class="wrapper">
       
        <div class="row mt">
          <div class="col-lg-12">
            <div class="form-panel">
              <h4><i class="fa fa-angle-right"></i> Users Table</h4>
              <hr>
              <table class="table">
                <thead>
                  <tr>
                    <th>Id</th>
                    <th>User Name</th>
                    <th>Phone Number</th>
                    <th>Email</th>
                    <th>City Name</th>
                    <th>street Name</th>
                    <th>Order Status</th>
                    <th>Order Date</th>
                    <th>Total Price</th>
                    <th></th>
                    <th></th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                <?php
                 $query = "SELECT * FROM orders INNER JOIN users
                        ON orders.user_id  = users.user_id";
                        $select_product = mysqli_query($connection, $query );
                       
                        while($row = mysqli_fetch_assoc($select_product)) {
                          $order_id= $row['order_id'];
                          $user_name= $row['user_name'];
                          $user_email= $row['user_email'];
                          $order_date= $row['order_date'];
                          $order_status= $row['order_status'];
                          $order_total= $row['order_total_amount'];
                          $city_name= $row['city_name'];
                          $street_name= $row['street_name'];
                          $phone_number= $row['phone_number'];
                          ?>
                <tr>
                    <td><?php echo $order_id?></td>
                    <td><?php echo $user_name?></td>
                    <td><?php echo $phone_number?></td>
                    <td><?php echo $user_email?></td>
                   
                    
                    <td><?php echo $city_name?></td>
                    <td><?php echo $street_name?></td>
                    <td><?php echo $order_status?></td>
                    <td><?php echo $order_date?></td>
                    <td><?php echo $order_total?></td>
                    <td><a href='manage_order.php?source=show_order&show=<?php echo $order_id?>' class="btn btn-theme">Show</a></td>
                    <td><a href='manage_order.php?source=edit_order&edit=<?php echo $order_id ?>' class="btn btn-theme">edit</a></td>
                    <td><a href="manage_order.php?delete= <?php echo $order_id?> " class="btn btn-danger">delete</a></td>
                  </tr>
                 <?php }?>
                </tbody>
              </table>
              <?php 
              if(isset($_GET['delete'])){
                global $connection;
                $the_order_id = $_GET['delete'];
                $query = "DELETE FROM orders WHERE order_id = {$the_order_id} ";
                $delete_query = mysqli_query($connection, $query);
                header("Location: manage_order.php");
                }
?>
           
          </div>
                       <?php
                            if(isset($_GET['source'])){
                                $source= $_GET['source'];

                            }else{
                                $source= "";
                            }
                            switch ($source) {
                                case "show_order":
                                    include "include/show_user_order.php";
                                    break;
                                
                                case "edit_order":
                                    include "include/edit_order.php";
                                    break;
                                
                                
                                
                                default:
                                    break;
                            }
                        ?>

          
          <!-- /col-md-12 -->
          </div>
          <!-- /col-lg-12 -->
          
        </div>

      </section>
      <!-- /wrapper -->
    </section>
      <!--main content end-->
    <!--footer start-->
    <?php include("include/admin_footer.php") ?>