<?php $this->view('includes/header', $data) ?>
<?php $this->view('includes/nav', $data) ?>



<?php if (!empty($images)) : ?>

  <!-- ======= Hero Slider Section ======= -->
  <section id="hero-slider" class="hero-slider">
    <div class="container-md" data-aos="fade-in">
      <div class="row">
        <div class="col-12">
          <div class="swiper sliderFeaturedPosts">
            <div class="swiper-wrapper">

              <?php foreach ($images as $image) : ?>
                <div class="swiper-slide">
                  <a href="#" class="img-bg d-flex align-items-end" style="background-image: url(<?= get_image($image->image) ?>);">
                    <div class="img-bg-inner">
                      <h2><?= esc($image->title) ?></h2>
                      <p><?= esc($image->description) ?></p>
                    </div>
                  </a>
                </div>
              <?php endforeach; ?>

            </div>
            <div class="custom-swiper-button-next">
              <span class="bi-chevron-right"></span>
            </div>
            <div class="custom-swiper-button-prev">
              <span class="bi-chevron-left"></span>
            </div>

            <div class="swiper-pagination"></div>
          </div>
        </div>
      </div>
    </div>
  </section><!-- End Hero Slider Section -->
<?php endif; ?>

<?php if (!empty($rows)) : ?>

  <!-- ======= Post Grid Section ======= -->
  <section id="posts" class="posts">
    <div class="container" data-aos="fade-up">


      <div class="section-header d-flex justify-content-between align-items-center mb-5">
        <h2>Courses</h2>
        <div><a href="<?= ROOT ?>/course/latest" class="more">See All Courses</a></div>
      </div>

      <div class="row">
        <?php if (!empty($rows)) : ?>
          <?php foreach ($rows as $row) : ?>

            <div class="col-lg-3">
              <div class="card my-2">
                <img class="card-img-top" src="<?= get_image($row->course_image) ?>" style="max-height: 180px; object-fit:cover;" alt="<?= esc($row->title) ?>">
                <div class="card-body">
                  <a href="<?= ROOT ?>/course/<?= generate_slug($row->title) ?>">
                    <h3 class="card-title"><?= esc(ucwords(substr($row->title, 0, 26))) ?></h3>
                  </a>
                  <div class="post-meta"><span class="date"><?= esc($row->category_row->category ?? 'Unknown') ?></span> <span class="mx-1">&bullet;</span> <span><?= get_date($row->date) ?></span></div>
                  <p class="card-text"><?= esc(substr($row->description, 0, 52)) ?>...</p>
                </div>
                <div class="card-footer d-flex " style="justify-content: space-between;">
                  <div class="d-flex align-items-center author">
                    <div class="photo"><img src="<?= get_image($row->user_row->image) ?>" style="object-fit: cover;" alt="" class="img-fluid"></div>
                    <div class="name">
                      <h3 class="m-0 p-0"><?= $row->user_row->firstname ?? 'Unknown' ?> <?= $row->user_row->lastname ?? '' ?></h3>
                    </div>
                  </div>
                  <a href="<?= ROOT ?>/course/<?= generate_slug($row->title) ?>" class="btn btn-sm btn-primary text-center">Buy Now</a>
                  <!-- <small class="text-muted">Last updated 3 mins ago</small> -->
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        <?php endif; ?>
      </div>

    </div>
  </section> <!-- End Post Grid Section -->

  <!-- ======= competitions Grid Section ======= -->
  <?php if (!empty($competitions)) : ?>
    <section id="posts" class="posts">
      <div class="container" data-aos="fade-up">


        <div class="section-header d-flex justify-content-between align-items-center mb-5">
          <h2>Competitions</h2>
          <div><a href="<?= ROOT ?>/competitions/all" class="more">See All Competitions</a></div>
        </div>

        <div class="row">
          <?php foreach ($competitions as $competition) : ?>

            <div class="col-lg-6">
              <div class="card my-2">
                <div class="row">
                  <div class="col-md-4 d-flex align-items-center justify-content-center">
                    <img class="card-img-top" src="<?= get_image($competition->image) ?>" style="height: -webkit-fill-available; max-height: 150px; object-fit:cover;" alt="<?= esc($competition->title) ?>">
                  </div>
                  <div class="col-md-8">
                    <div class="card-body">
                      <a href="<?= ROOT ?>/competitions/<?= generate_slug($competition->title) ?>">
                        <h3 class="card-title"><?= esc(ucwords(substr($competition->title, 0, 26))) ?></h3>
                      </a>
                      <div class="post-meta my-3">

                        <span>
                          <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                            <path d="M128 0c17.7 0 32 14.3 32 32V64H288V32c0-17.7 14.3-32 32-32s32 14.3 32 32V64h48c26.5 0 48 21.5 48 48v48H0V112C0 85.5 21.5 64 48 64H96V32c0-17.7 14.3-32 32-32zM0 192H448V464c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V192zm64 80v32c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16V272c0-8.8-7.2-16-16-16H80c-8.8 0-16 7.2-16 16zm128 0v32c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16V272c0-8.8-7.2-16-16-16H208c-8.8 0-16 7.2-16 16zm144-16c-8.8 0-16 7.2-16 16v32c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16V272c0-8.8-7.2-16-16-16H336zM64 400v32c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16V400c0-8.8-7.2-16-16-16H80c-8.8 0-16 7.2-16 16zm144-16c-8.8 0-16 7.2-16 16v32c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16V400c0-8.8-7.2-16-16-16H208zm112 16v32c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16V400c0-8.8-7.2-16-16-16H336c-8.8 0-16 7.2-16 16z" />
                          </svg>
                          <?php

                          // Create DateTime objects for start and end dates
                          $startDateTime = new DateTime($competition->start_date);
                          $endDateTime = new DateTime($competition->end_date);

                          // Calculate the difference between the two dates
                          $dateInterval = $startDateTime->diff($endDateTime);

                          // Get the remaining days from the difference
                          $remainingDays = $dateInterval->days;
                          // Check if remaining days is -1
                          if ($endDateTime < $startDateTime) {
                            echo "<span class='alert-danger'> Expired</span>";
                          } else {
                            echo '<b>' . $remainingDays . "</b> Day(s) left";
                          }
                          // echo $remainingDays . " Day(s) left";
                          ?>
                        </span>
                        <span class="mx-1">&bullet;</span>
                        <span>
                          <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 576 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                            <path d="M288 32c-80.8 0-145.5 36.8-192.6 80.6C48.6 156 17.3 208 2.5 243.7c-3.3 7.9-3.3 16.7 0 24.6C17.3 304 48.6 356 95.4 399.4C142.5 443.2 207.2 480 288 480s145.5-36.8 192.6-80.6c46.8-43.5 78.1-95.4 93-131.1c3.3-7.9 3.3-16.7 0-24.6c-14.9-35.7-46.2-87.7-93-131.1C433.5 68.8 368.8 32 288 32zM144 256a144 144 0 1 1 288 0 144 144 0 1 1 -288 0zm144-64c0 35.3-28.7 64-64 64c-7.1 0-13.9-1.2-20.3-3.3c-5.5-1.8-11.9 1.6-11.7 7.4c.3 6.9 1.3 13.8 3.2 20.7c13.7 51.2 66.4 81.6 117.6 67.9s81.6-66.4 67.9-117.6c-11.1-41.5-47.8-69.4-88.6-71.1c-5.8-.2-9.2 6.1-7.4 11.7c2.1 6.4 3.3 13.2 3.3 20.3z" />
                          </svg>
                          <?= $competition->views . ' Impressions'; ?>
                        </span>
                      </div>

                      <p class="card-text">
                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 384 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                          <path d="M215.7 499.2C267 435 384 279.4 384 192C384 86 298 0 192 0S0 86 0 192c0 87.4 117 243 168.3 307.2c12.3 15.3 35.1 15.3 47.4 0zM192 128a64 64 0 1 1 0 128 64 64 0 1 1 0-128z" />
                        </svg>
                        <?= esc(substr($competition->address, 0, 52)) ?>...
                      </p>
                      <?php
                      if (!empty($competition->tags)) {
                        $arr = explode(',', $competition->tags);
                        for ($i = 0; $i < count($arr); $i++) {
                          echo '<span class="badge bg-secondary mx-2">' . $arr[$i] . '</span>';
                        }
                      }
                      ?>
                    </div>
                  </div>
                </div>
                <div class="card-footer d-flex " style="justify-content: end;">
                <?php
                  if ($endDateTime < $startDateTime) {
                    echo "<span class='btn btn-danger w-100 disabled'> Registration Expired</span>";
                  } else {
                    echo '<a href="'.$competition->google_form_link.'" target="_blank" class="btn btn-primary w-100">Register now</a>';
                  }
                 ?>
                  
                </div>
              </div>
              </a>
            </div>
          <?php endforeach; ?>
        </div>

      </div>
    </section>
  <?php endif; ?>
  <!-- End competitions Grid Section -->

<?php endif; ?>


<?php $this->view('includes/footer', $data) ?>