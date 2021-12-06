    <?php
    session_start();
    $connection = mysqli_connect("localhost", "root", "", "ecommerce2");
    require_once("./include/db.php");
    // Save Data
    if (isset($_POST["save"])) {
        $new_user_name = $_POST["name"];
        $new_user_email = $_POST["email"];
        $new_user_password = $_POST["password"];
        $image        = $_FILES['user_image']['name'];
        $image_temp   = $_FILES['user_image']['tmp_name'];
        move_uploaded_file($image_temp, "image/$image");
        if (empty($image)) {
            $query = "SELECT * FROM users WHERE user_id = '{$_SESSION['userLogin']}'";
            $select_img = mysqli_query($connection, $query);
            while ($row = mysqli_fetch_assoc($select_img)) {
                $image = $row['user_img'];
            }
        }
        $query  = "UPDATE users SET user_img = '$image', user_name = '$new_user_name', 
 user_email  = '$new_user_email', user_password  = '$new_user_password' WHERE user_id = '{$_SESSION['userLogin']}' ";
        $update_user = mysqli_query($connection, $query);
        header("location: profile.php");
        if (!$update_user) {
            die('Query Failed' . mysqli_error($connection));
        }

    ?>


    <?php  }
    ?>


    <?php

    if (!isset($_SESSION['userLogin'])) {
        header("Location: login.php");
    }

    require_once("./include/header.php");
    //show user information
    $query = "SELECT * FROM users WHERE user_id = {$_SESSION['userLogin']}";
    $select_user = mysqli_query($connection, $query);
    while ($row = mysqli_fetch_assoc($select_user)) {
        $user_id = $row['user_id'];
        $user_name = $row['user_name'];
        $user_img = $row['user_img'];
        $user_email = $row['user_email'];
        $user_password = $row['user_password'];
        $login_date = $row['login_date'];
    ?>


        <head>
            <style>
                .lineV::before {
                    content: "";
                    position: absolute;
                    width: 1px;
                    height: 100%;
                    background-color: #ccc;
                    right: -100%;
                }
            </style>
        </head>
        <hr>
        <section>

            <div class="container-fluid px-5">
                <div class="mt-4 mb-4 p-3 d-flex row">
                    <div class="col-6">
                        <div style="width: 250px;" class=" lineV d-flex flex-wrap position-relative">
                            <img class="d-block circle" src="image/<?php echo $user_img ?>" height="250" width="250" />
                            <div class="d-flex col-lg-12 flex-column align-items-center">
                                <div class="name mt-3"><strong><?php echo $user_name ?></strong></div>
                                <div id="user-email" class="mt-2"><?php echo $user_email ?></div>
                                <div id="user-login-date"><?php echo 'Last Login: ' . $login_date ?></div>
                                <div class=" d-flex mt-3"> <a href="profile.php?source=edit_information"><button id="btn1" class="main_btn rounded">Edit Profile</button></a> </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-lg-6">
                        <div class="col-12">
                            <?php
                            if (isset($_GET['source'])) {
                                $source = $_GET['source'];
                            } else {
                                $source = "";
                            }
                            switch ($source) {
                                case "edit_information": ?>

                                    <section>
                                        <div class="container rounded ">
                                            <div class="row">

                                                <div class="col-md-12">
                                                    <div class="p-3 py-5">

                                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                                            <h4 class="text-right">Profile Settings</h4>
                                                        </div>
                                                        <div class="row mt-2">
                                                            <div class="col-md-12">
                                                                <form action="profile.php" method="post" enctype="multipart/form-data">
                                                                    <label class="labels">Name</label>
                                                                    <input type="text" name="name" class="form-control" value="<?php echo $user_name ?>">
                                                            </div>
                                                        </div>
                                                        <div class="row mt-3">
                                                            <div class="col-md-12">
                                                                <label class="labels">Email ID</label>
                                                                <input type="text" name="email" class="form-control" placeholder="enter email id" value="<?php echo $user_email ?>">
                                                            </div>
                                                        </div>
                                                        <div class="row mt-3">
                                                            <div class="col-md-12">
                                                                <label class="labels">Password</label>
                                                                <input type="password" name="password" class="form-control" value="<?php echo $user_password ?>">
                                                            </div>
                                                        </div>
                                                        <div class="row mt-3">
                                                            <div class="col-md-12">
                                                                <label class="form-label" for="customFile">Image</label>
                                                                <input type="file" name="user_image" class="form-control" id="customFile" />
                                                            </div>
                                                        </div>


                                                        <div class="d-flex justify-content-center mt-3">

                                                            <a href=""></a> <button id="btn1" name="save" class="main_btn btn1 rounded">Save Changes</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                        </div>
                    </div>
                </div>
        </section>
    <?php
                                    break;
                                default:
    ?>
        <table class="table  table-hover">
            <thead>
                <tr>
                    <th scope="col"> Order Number</th>
                    <th scope="col"> Product quantity</th>
                    <th scope="col"> order Status</th>
                    <th scope="col"> Total Amount</th>
                </tr>
            </thead>
            <tbody>
                <?php
                                    //get user orders
                                    $query = "SELECT * FROM orders 
                                          INNER JOIN users ON 
                                          orders.user_id = users.user_id";

                                    $select_order = mysqli_query($connection, $query);
                                    while ($row = mysqli_fetch_assoc($select_order)) {
                                        $order_id = $row['order_id'];
                                        $user_id = $row['user_id'];
                                        $order_status = $row['order_status'];
                                        $product_quantity = $row['product_quantity'];
                                        $order_date = $row['order_date'];
                                        $order_total_amount = $row['order_total_amount'];

                ?>

                    <tr>
                        <td scope="row"><?php echo "<strong>" . $order_id . "</strong>" ?></td>
                        <td> <?php echo  $product_quantity ?></td>
                        <td> <?php echo $order_status  ?></td>
                        <td> <?php echo $order_total_amount  ?></td>
                    </tr>

                <?php } ?>
            </tbody>
        </table>
    <?php
                                    break;
                            }
    ?>

    </div>
    </div>
    </div>
    </div>

    </section>


    <?php } ?>
    <?php include("./include/footer.php") ?>