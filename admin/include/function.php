<?php
    // admin
    function add_admin(){
        // add category
        global $connection,$name_err,$name_status,
        $emailErr,$email_status,$passErr,$img_status,
        $imgErr,$pass_status ,$create_admin_query;
        if(isset($_POST['add_admin'])) {
            $admin_name         = $_POST['admin_name'];
            $admin_email        = $_POST['email'];
            $admin_image        = $_FILES['image']['name'];
            $admin_image_temp   = $_FILES['image']['tmp_name'];
            $admin_password     = $_POST['password'];
            if (empty($admin_name)) {
              $name_err= "Please fill this field";
            }elseif (!preg_match("/^[a-zA-Z-' ]*$/",$admin_name)) {
              $name_err = "Only letters and white space allowed";
              $name_status= false ;
            }else{
              $name_status= true ;
            }
            if ($admin_email == "" || empty($admin_email)) {
              $emailErr= " This field should not be empty";
              $email_status= false ;
          } else if (!filter_var($admin_email, FILTER_VALIDATE_EMAIL)) {
              $emailErr = "Invalid email format";
              $email_status= false ;
          } else{
            $email_status= true ;
          }
          if ($admin_password == "" || empty($admin_password)) {
            $passErr= " This field should not be empty";
            $pass_status= false ;
          }else{
            $pass_status= true ;
          }
          if ($admin_image == "" || empty($admin_image)) {
            $imgErr= " Please add Image";
            $img_status= false ;
          }else{
            $img_status= true ;
          }
            if ($name_status== true && $email_status== true && $pass_status== true && $img_status== true ) {
                move_uploaded_file($admin_image_temp, "../image/$admin_image" );

              $query = "INSERT INTO admins(admin_img, admin_name, admin_email, admin_password) ";
                     
            $query .= "VALUES('{$admin_image}','{$admin_name}','{$admin_email}','{$admin_password}' ) "; 
            $create_admin_query = mysqli_query($connection, $query);
            }
         } 
   }

   function delete_admin(){
   if(isset($_GET['delete'])){
    global $connection;
    $the_admin_id = $_GET['delete'];
    $query = "DELETE FROM admins WHERE admin_id = {$the_admin_id} ";
    $delete_query = mysqli_query($connection, $query);
    header("Location: manage_admin.php");
}
}
?>
<!-- user ..................................................... -->
<?php
    // user
    function delete_user(){
        if(isset($_GET['delete'])){
         global $connection;
         $the_user_id = $_GET['delete'];
         $query = "DELETE FROM users WHERE user_id = {$the_user_id} ";
         $delete_query = mysqli_query($connection, $query);
         header("Location: manage_users.php");
     }
     }
?>
<!-- Categories ..................................................... -->

<?php 
     function add_category(){
        // add category
        global $connection,$category_err,$category_status,
        $img_status, $imgErr;
        if(isset($_POST['add_category'])) {
            $category_name         = $_POST['category_name'];
            $category_image        = $_FILES['image']['name'];
            $admin_image_temp   = $_FILES['image']['tmp_name'];
            if (empty($category_name)) {
              $category_err= "Please fill this field";
              $category_status= false ;
            }elseif (!preg_match("/^[a-zA-Z-' ]*$/",$category_name)) {
              $category_err = "Only letters and white space allowed";
              $category_status= false ;
            }else{
              $category_status= true ;
            }

          if ($category_image == "" || empty($category_image)) {
            $imgErr= " Please add Image";
            $img_status= false ;
          }else{
            $img_status= true ;
          }
            if ($category_status== true && $img_status== true ) {
                move_uploaded_file($admin_image_temp, "../image/$category_image" );

              $query = "INSERT INTO categories(category_name, category_img) ";
                     
            $query .= "VALUES('{$category_name}','{$category_image}' ) "; 
            $create_admin_query = mysqli_query($connection, $query);
            
            }
         } 
   }
//    delete_category
   function delete_category(){
    if(isset($_GET['delete'])){
     global $connection;
     $the_category_id = $_GET['delete'];
     $query = "DELETE FROM categories WHERE category_id = {$the_category_id} ";
     $delete_query = mysqli_query($connection, $query);
     header("Location: manage_categories.php");
 }
 }
?>