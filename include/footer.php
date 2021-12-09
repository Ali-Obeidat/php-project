<?php $connection = mysqli_connect("localhost", "root", "", "ecommerce2"); ?>
<footer class="footer-area section_gap">
  <div class="container">
    <div class="row">
      <div class="col-lg-2 col-md-6 single-footer-widget">
        <h4>Top Categories</h4>
        <ul>
          <?php
          $sql    = "SELECT * FROM categories";
          $result = mysqli_query($connection, $sql);
          while ($row = mysqli_fetch_assoc($result)) { ?>
            <li><a href="category.php?c_id=<?php echo $row['category_id']; ?>"><?php echo $row['category_name']; ?></a></li>
          <?php }
          ?>
        </ul>
      </div>
      <div class="col-lg-2 col-md-6 single-footer-widget">
        <h4>Contacts</h4>
        <ul class="mylinks">
          <li>Email:<br> style_loft@gmail.com</li>
          <li>Phone:<br> +962-777-684-193</li>
          <li>Address:<br> Amman,Jordan</li>
        </ul>
      </div>
      <div class="col-lg-2 col-md-6 single-footer-widget">
        <h4>Services</h4>
        <ul class="mylinks">
          <li>FREE DELIVERY</li>
          <li>ALWAYS SUPPORT</li>
          <li>MONEY BACK GURANTEE</li>
          <li>SECURE PAYMENT</li>
        </ul>
      </div>
      <div class="col-lg-2 col-md-6 single-footer-widget">

      </div>
      <div class="mylinks col-lg-4 col-md-6 single-footer-widget">
        <h4>Newsletter</h4>
        <p>You can trust us. we only send promo offers,</p>
        <div class="footer-bottom row">
          <div class="col-lg-12 col-md-12 footer-social d-flex justify-content-start">

            <a href="https://www.facebook.com/" target="_blank"><i class="fab fa-facebook-f"></i></a>
            <a href="https://twitter.com/i/flow/login" target="_blank"><i class=" fab fa-twitter"></i></a>
            <a href="https://www.instagram.com/accounts/login/?hl=en"><i class="fab fa-instagram" target="_blank"></i></i></a>
            <a href=" mailto:alrfati.hazem@gmail.com"><i class="fas fa-envelope"></i></i></a>
          </div>
        </div>
      </div>
    </div>
    <div class="footer-bottom row align-items-center">
      <p class="footer-text m-0 col-lg-12 col-md-12 text-center">
        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
        Copyright &copy;<script>
          document.write(new Date().getFullYear());
        </script> All rights reserved | This template is made with <i class="mx-2 fas fa-heart"></i> by <span style="color:#71CD14; font-weight:normal" class="ml-1">Style_Loft</span>
        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
      </p>
    </div>
  </div>
</footer>
<!--================ End footer Area  =================-->

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script>
  var alert = document.querySelector(".swal2-confirm");
  if (alert !== null) {
    alert.addEventListener("click", function() {
      if (location.href == "http://localhost/Last-Version/test.php") {
        location.assign("index.php");
      }
    })
  }
</script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="js/jquery-3.2.1.min.js"></script>
<script src="js/popper.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/stellar.js"></script>
<script src="vendors/lightbox/simpleLightbox.min.js"></script>
<script src="vendors/nice-select/js/jquery.nice-select.min.js"></script>
<script src="vendors/isotope/imagesloaded.pkgd.min.js"></script>
<script src="vendors/isotope/isotope-min.js"></script>
<script src="vendors/owl-carousel/owl.carousel.min.js"></script>
<script src="js/jquery.ajaxchimp.min.js"></script>
<script src="vendors/counter-up/jquery.waypoints.min.js"></script>
<script src="vendors/counter-up/jquery.counterup.js"></script>
<script src="js/mail-script.js"></script>
<script src="js/theme.js"></script>
<script src="js/slider.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.js"></script>
<script src="js/slider.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>