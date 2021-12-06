       <?php
        $status=['Order Placed','Processing', 'Preparing to Ship','Shipped','Delivered' ,'Canceled'];
        $id =$_GET['edit'];
        $query = "SELECT * FROM orders INNER JOIN users
                  ON orders.user_id  = users.user_id WHERE orders.order_id = $id";
       $update_order = mysqli_query($connection, $query );
           $row = mysqli_fetch_assoc($update_order); 
           $user_name = $row['user_name'];    
           $user_email = $row['user_email'];    
           $phone_number= $row['phone_number'];
           $city_name = $row['city_name'];
           $street_name = $row['street_name'];
           $order_status = $row['order_status'];
           
           if(isset($_POST['edit_order'])) {
        
             $User_Name       = $_POST['User_Name'];
             $email        = $_POST['email'];
             $User_Phone        = $_POST['User_Phone'];
             $city       = $_POST['city_name'];        
             $street       = $_POST['street_name'];        
             $order_status        = $_POST['order_status'];        

             if (empty($order_status)) {
               $orderStatusErr= "Please select category";
               $orderStatus= false ;
             }else{
               $orderStatus= true ;
             }
             if ($User_Name == "" || empty($User_Name)) {
               $userNameErr= " This field should not be empty";
               $userNameStatus= false ;
           }  else{
             $userNameStatus= true ;
           }
           if ($User_Phone == "" || empty($User_Phone)) {
             $phoneErr= " This field should not be empty";
             $phoneStatus= false ;
           }else{
             $phoneStatus= true ;
           }
           if ($user_email == "" || empty($user_email)) {
             $emailErr= " This field should not be empty";
             $emailStatus= false ;
           }else{
             $emailStatus= true ;
           }
           if ($city == "" || empty($city)) {
             $cityErr= " This field should not be empty";
             $cityStatus= false ;
           }else{
             $cityStatus= true ;
           }
           if ($street == "" || empty($street)) {
             $streetErr= " This field should not be empty";
             $streetStatus= false ;
           }else{
             $streetStatus= true ;
           }

             if ($userNameStatus== true && $phoneStatus== true && $emailStatus== true && $cityStatus== true && $streetStatus== true ) {
                 
     
               $query = "UPDATE orders INNER JOIN users ON orders.user_id  = users.user_id SET order_status = '{$order_status}', city_name = '{$city_name}', street_name = '{$street_name}',
                user_name = '{$User_Name}', user_email = '{$user_email}',phone_number = '{$User_Phone}' WHERE orders.order_id = $id";
             $edit_product_query = mysqli_query($connection, $query);
              header("location: manage_order.php");
             if(!$edit_product_query ){
               die('Query Failed'. mysqli_error($connection));
            }
           //  header("Location: show_products.php");
             }
          } 
       ?>
        
        <h2>Edit Order</h2>
        <div class="row mt">
          <div class="col-lg-12">
            <div class="form-panel">
              <div class=" form">
                <form class="cmxform form-horizontal style-form" id="commentForm" method="post" enctype="multipart/form-data">
                  <div class="form-group ">
                    <label for="cname" class="control-label col-lg-2">Order Status</label>
                    <div class="col-lg-10">
                    <select class="form-control col-lg-4" name="order_status">
                        <option value="<?php echo $order_status ?>"> <?php echo $order_status ?></option>
                        <?php
                          foreach ($status as $key ) {
                            if ($key == $order_status ) {
                             continue;
                            }
                            ?>
                            <option value="<?php echo $key ?>"> <?php echo $key ?></option>
                            <?php
                          }
                        ?>
                    </select>
                    <p class="help-block" style="color:red;"><?php global $orderStatusErr; echo $orderStatusErr ?></p>

                    </div>
                  </div>
                  <div class="row col-12" >
                  
                      <div class="form-group col-lg-5 ">
                        <label for="cemail" style="margin-right: 50px;" class="control-label col-lg-4">User Name</label>
                        <div class="col-lg-5" >
                          <input class="form-control" value="<?php echo $user_name ?>" id="cemail" type="text" name="User_Name"  />
                          <p class="help-block" style="color:red;"><?php global $userNameErr; echo $userNameErr ?></p>
                        </div>
                      </div>
                      <div class="form-group col-lg-3 ">
                        <label for="cemail" class="control-label col-lg-4">User Email</label>
                        <div class="col-lg-8">
                          <input class="form-control " value="<?php echo $user_email ?>" id="cemail" type="email" name="email"  />
                          <p class="help-block" style="color:red;"><?php global $emailErr; echo $emailErr ?></p>
                        </div>
                      </div>
                      <div class="form-group col-lg-3 ">
                        <label for="cemail" class="control-label col-lg-4">User Phone</label>
                        <div class="col-lg-8">
                          <input class="form-control " value="<?php echo $phone_number ?>" id="cemail" type="text" name="User_Phone"  />
                          <p class="help-block" style="color:red;"><?php global $phoneErr; echo $phoneErr ?></p>
                        </div>
                      </div>
                    
                  </div>
                  
                  <div class="form-group ">
                    <label for="cname" class="control-label col-lg-2">City Name</label>
                    <div class="col-lg-10">
                      <input class=" form-control" value="<?php echo $city_name ?>" id="cname" name="city_name" minlength="2" type="text"  />
                      <p class="help-block" style="color:red;"><?php global $cityErr; echo $cityErr ?></p>
                    </div>
                  </div>
                  <div class="form-group ">
                    <label for="cname" class="control-label col-lg-2">street Name</label>
                    <div class="col-lg-10">
                      <input class=" form-control" value="<?php echo $street_name ?>" id="cname" name="street_name" minlength="2" type="text"  />
                      <p class="help-block" style="color:red;"><?php global $streetErr; echo $streetErr ?></p>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-lg-offset-2 col-lg-10">
                      <button class="btn btn-theme" name="edit_order" type="submit">Edit </button>
                      <a href="manage_order.php"><button class="btn btn-theme04" type="button">Cancel</button></a>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>