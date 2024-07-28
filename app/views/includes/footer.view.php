    </main><!-- End #main -->
    
    <?php
     $category = new \Model\Category();
     $course = new \Model\Course();
     $categories = $category->findAll();

      $query = "select * from courses where approved != 0 order by views desc limit 3";
			$populars = $course->query($query);
      
    ?>
  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">

    <div class="footer-content">
      <div class="container">

        <div class="row  ">
          <div class="col-5">
            <h3 class="footer-heading"><?=APP_NAME?></h3>
            <p><?=APP_DESC?></p>
            <h4 class="footer-heading">Contact us At:</h>
            <ul>
              <li>
                Email: brainiacedge@gmail.com
              </li>
              <li>
                Phone No : +60 102596831
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>

    <div class="footer-legal">
      <div class="container">

        <div class="row justify-content-between">
          <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
            <div class="copyright">
              © Copyright <strong><span><?=APP_NAME?></span></strong>. All Rights Reserved
            </div>

            <div class="credits">
              
            </div>

          </div>


          </div>

        </div>

      </div>
    </div>

  </footer>

  <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="<?=ROOT?>/zenblog/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?=ROOT?>/zenblog/assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="<?=ROOT?>/zenblog/assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="<?=ROOT?>/zenblog/assets/vendor/aos/aos.js"></script>
  <script src="<?=ROOT?>/zenblog/assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="<?=ROOT?>/zenblog/assets/js/main.js"></script>

</body>

</html>