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
            <div class="content-panel">
              <h4><i class="fa fa-angle-right"></i> Responsive Table</h4>
              <section id="unseen">
                <table class="table table-bordered table-striped table-condensed">
                <thead>
                  <tr>
                    <th>Id</th>
                    <th>Author</th>
                    <th>Comment Content</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>In Response to Product</th>
                    <th>Date</th>
                    <th>Change Status</th>
                    <th> </th>
                  </tr>
                </thead>
                  <tbody>
                    <tr>
                      <?php 
                    $query = "SELECT * FROM comments 
                    INNER JOIN users ON comments.user_id = users.user_id 
                    INNER JOIN products ON comments.prodcut_id = products.product_id";
                    $select_comment = mysqli_query($connection, $query );
                    while($row = mysqli_fetch_assoc($select_comment)) { 
                          $comment_id        = $row['id'];
                          $comment_author         = $row['user_name'];
                          $comment_content            = $row['comment_content'];
                          $comment_status            = $row['comment_status'];
                          $email                    = $row['user_email'];
                          $comment_date            = $row['comment_date'];
                          $product_name            = $row['product_name'];
                      ?>
                          <td><?php echo $comment_id ?></td>
                          <td><?php echo $comment_author ?></td>
                          <td data-title="Company" ><?php echo $comment_content ?></td>
                          <td class="numeric"><?php echo $email ?></td>
                          <td class="numeric"><?php echo $comment_status ?></td>
                          <td class="numeric"><?php echo $product_name ?></td>
                          <td class="numeric"><?php echo $comment_date ?></td>
                          <td class="numeric">
                            <ul>
                              <li><a href='manage_comment.php?change_to_draft=<?php echo $comment_id ?>'>Draft</a></li>
                              <li><a href='manage_comment.php?change_to_public=<?php echo $comment_id ?>'>public</a></li>
                            </ul>
                        </td>
                          <td><a href="manage_comment.php?delete=<?php echo $comment_id ?>" class="btn btn-danger">delete</a></td>
                        </tr>
                    <?php }?>
                    
                  
                  </tbody>
                </table>
              </section>
            </div>
            <!-- /content-panel -->
          </div>
          <!-- /col-lg-12 -->
          
        </div>

      </section>
      <!-- /wrapper -->
    </section>
    <?php

    if(isset($_GET['change_to_draft'])){
        
        $the_comment_id = $_GET['change_to_draft'];
        
        $query = "UPDATE comments SET comment_status = 'Draft' WHERE id = $the_comment_id   ";
        $query = mysqli_query($connection, $query);
        header("Location: manage_comment.php");
        
        
    }





    if(isset($_GET['change_to_public'])){
        
        $the_comment_id = $_GET['change_to_public'];
        
        $query = "UPDATE comments SET comment_status = 'public' WHERE id = $the_comment_id ";
        $query = mysqli_query($connection, $query);
        header("Location: manage_comment.php");
        
        
    }
    if(isset($_GET['delete'])){
      $the_comment_id = $_GET['delete'];
      $query = "DELETE FROM comments WHERE id = {$the_comment_id} ";
      $delete_query = mysqli_query($connection, $query);
      header("Location: manage_comment.php");
  }
?>     
    <!--main content end-->
    <!--footer start-->
    <?php include("include/admin_footer.php") ?>