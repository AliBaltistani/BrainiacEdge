<?php

use Model\Auth;

$this->view('includes/header', $data) ?>
<?php $this->view('includes/nav', $data) ?>

<?php if (!empty($row)) :  ?>
  <section class="single-post-content">
    <div class="container">
      <div class="row">
        <div class="col-md-9 post-content" data-aos="fade-up">

          <!-- ======= Single Post Content ======= -->
          <div class="single-post">
            <ul style="
                        margin:0;
                        padding:0;
                        list-style-type: none;
                        display: flex;
                        font-size: large;
                        font-weight: 600;
                      ">
              <li class="mx-2"><a href="<?= ROOT ?>"> Home </a> > </li>
              <li class="mx-2"><a href="<?= ROOT . '/competitions' ?>">Competitions</a> > </li>
            </ul>
            <h1 class="mt-4"><?= esc(ucwords($row->title)) ?></h1>

            <div class="my-4">
              <!-- ======= Hero Slider Section ======= -->
              <img src="<?= get_image($row->image) ?>" alt="<?= esc($row->title) ?>" style="width: -webkit-fill-available;height: 300px;">
            </div>

            <p><?= esc($row->description) ?></p>
          </div><!-- End Single Post Content -->

          <hr>


        </div><!-- Col 9 ended -->
        <div class="col-md-3">
          <!-- ======= Sidebar ======= -->
          <div class="aside-block">
            <div class="row">
              <div class="col-12">
                <img class="card-img-top" src="<?= get_image($row->image) ?>" style="height: -webkit-fill-available; max-height: 130px; object-fit:cover;" alt="<?= esc($row->title) ?>">

                <div class="post-meta my-4">
                  <span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                      <path d="M128 0c17.7 0 32 14.3 32 32V64H288V32c0-17.7 14.3-32 32-32s32 14.3 32 32V64h48c26.5 0 48 21.5 48 48v48H0V112C0 85.5 21.5 64 48 64H96V32c0-17.7 14.3-32 32-32zM0 192H448V464c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V192zm64 80v32c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16V272c0-8.8-7.2-16-16-16H80c-8.8 0-16 7.2-16 16zm128 0v32c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16V272c0-8.8-7.2-16-16-16H208c-8.8 0-16 7.2-16 16zm144-16c-8.8 0-16 7.2-16 16v32c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16V272c0-8.8-7.2-16-16-16H336zM64 400v32c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16V400c0-8.8-7.2-16-16-16H80c-8.8 0-16 7.2-16 16zm144-16c-8.8 0-16 7.2-16 16v32c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16V400c0-8.8-7.2-16-16-16H208zm112 16v32c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16V400c0-8.8-7.2-16-16-16H336c-8.8 0-16 7.2-16 16z" />
                    </svg>
                    <?php

                    // Create DateTime objects for start and end dates
                    $startDateTime = new DateTime($row->start_date);
                    $endDateTime = new DateTime($row->end_date);

                    // Calculate the difference between the two dates
                    $dateInterval = $startDateTime->diff($endDateTime);

                    // Get the remaining days from the difference
                    $remainingDays = $dateInterval->days;
                    // Check if remaining days is -1
                    if ($endDateTime < $startDateTime) {
                      echo "<span class=' alert-danger'> Expired</span>";
                    } else {
                      echo '<b>' . $remainingDays . "</b> Day(s) left";
                    }
                    // echo $remainingDays . " Day(s) left";
                    ?>
                  </span>
                  <br><br>
                  <!-- </span>&bullet;</span> -->
                  <span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 576 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                      <path d="M288 32c-80.8 0-145.5 36.8-192.6 80.6C48.6 156 17.3 208 2.5 243.7c-3.3 7.9-3.3 16.7 0 24.6C17.3 304 48.6 356 95.4 399.4C142.5 443.2 207.2 480 288 480s145.5-36.8 192.6-80.6c46.8-43.5 78.1-95.4 93-131.1c3.3-7.9 3.3-16.7 0-24.6c-14.9-35.7-46.2-87.7-93-131.1C433.5 68.8 368.8 32 288 32zM144 256a144 144 0 1 1 288 0 144 144 0 1 1 -288 0zm144-64c0 35.3-28.7 64-64 64c-7.1 0-13.9-1.2-20.3-3.3c-5.5-1.8-11.9 1.6-11.7 7.4c.3 6.9 1.3 13.8 3.2 20.7c13.7 51.2 66.4 81.6 117.6 67.9s81.6-66.4 67.9-117.6c-11.1-41.5-47.8-69.4-88.6-71.1c-5.8-.2-9.2 6.1-7.4 11.7c2.1 6.4 3.3 13.2 3.3 20.3z" />
                    </svg>
                    <?= $row->views . ' Impressions'; ?>
                  </span>
                  <br><br>
                  <span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 384 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                      <path d="M215.7 499.2C267 435 384 279.4 384 192C384 86 298 0 192 0S0 86 0 192c0 87.4 117 243 168.3 307.2c12.3 15.3 35.1 15.3 47.4 0zM192 128a64 64 0 1 1 0 128 64 64 0 1 1 0-128z" />
                    </svg>
                    <?= esc($row->address); ?>
                  </span>
                </div>


                <div class="row">
                  <div class="col-12">
                    <?php
                    if ($endDateTime < $startDateTime) {
                      echo "<span class='btn btn-danger w-100 disabled'> Registration Expired</span>";
                    } else {
                      echo '<a href="'.$row->google_form_link.'" target="_blank" class="btn btn-danger w-100">Register now</a>';
                    }
                    ?>
                   
                  </div>
                </div>
              </div>
            </div>
            <hr>
            <ul class="nav nav-pills custom-tab-nav mb-4" id="pills-tab" role="tablist">
              <li class="nav-item" role="presentation">
                <button class="nav-link active" id="pills-popular-tab" data-bs-toggle="pill" data-bs-target="#pills-popular" type="button" role="tab" aria-controls="pills-popular" aria-selected="true">Popular</button>
              </li>
              <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-trending-tab" data-bs-toggle="pill" data-bs-target="#pills-trending" type="button" role="tab" aria-controls="pills-trending" aria-selected="false">Trending</button>
              </li>
            </ul>

            <div class="tab-content" id="pills-tabContent">

              <!-- Popular -->
              <div class="tab-pane fade show active" id="pills-popular" role="tabpanel" aria-labelledby="pills-popular-tab">
                <?php if (!empty($populars)) : ?>
                  <?php foreach ($populars as $popular) : ?>
                    <div class="post-entry-1 border-bottom">
                      <div class="post-meta"><span class="date"><?= esc($popular->category_row->category) ?></span> <span class="mx-1">
                          &bullet;</span> <span><?= get_date($popular->date) ?></span>
                        &bullet;</span> <span><?= esc($popular->user_row->name) ?></span>
                      </div>
                      <h2 class="mb-2">
                        <div class="row">
                          <div class="col-sm-4">
                            <img src="<?= get_image($popular->course_image) ?>" alt="" style="width: -webkit-fill-available; height:50px;">
                          </div>
                          <div class="col-sm-8">
                            <a href="<?= ROOT . '/course/' . generate_slug(esc($popular->title)) ?>"><?= ucwords(esc($popular->title)) ?></a>
                          </div>
                      </h2>
                    </div>
                  <?php endforeach ?>
                <?php endif ?>
              </div> <!-- End Popular -->

              <!-- Trending -->
              <div class="tab-pane fade" id="pills-trending" role="tabpanel" aria-labelledby="pills-trending-tab">

                <?php if (!empty($trending)) : ?>
                  <?php foreach ($trending as $trens) : ?>
                    <div class="post-entry-1 border-bottom">
                      <div class="post-meta"><span class="date"><?= esc($trens->category_row->category) ?></span> <span class="mx-1">
                          &bullet;</span> <span><?= get_date($trens->date) ?></span>
                        &bullet;</span> <span><?= esc($trens->user_row->name) ?></span>
                      </div>
                      <h2 class="mb-2">
                        <div class="row">
                          <div class="col-sm-4">
                            <img src="<?= get_image($trens->course_image) ?>" alt="" style="width: -webkit-fill-available; height:50px;">
                          </div>
                          <div class="col-sm-8">
                            <a href="<?= ROOT . '/course/' . generate_slug(esc($trens->title)) ?>"><?= ucwords(esc($trens->title)) ?></a>
                          </div>
                      </h2>
                    </div>
                  <?php endforeach ?>
                <?php endif ?>

              </div> <!-- End Trending -->


            </div>
          </div>


          <div class="aside-block">
            <h3 class="aside-title">Tags</h3>
            <ul class="aside-tags list-unstyled">

              <?php
              if (!empty($row->tags)) {
                $arr = explode(',', $row->tags);
                for ($i = 0; $i < count($arr); $i++) {
                  if ($arr[$i] != ' ') {
                    echo '<span class="badge bg-secondary mx-2">' . $arr[$i] . '</span>';
                  }
                }
              }
              ?>


            </ul>
          </div><!-- End Tags -->

        </div>
      </div>
    </div>
  </section>
<?php else : ?>
  <div class="text-center p-4">
    <h3>That course was not found!</h3>
  </div>
<?php endif ?>


<?php $this->view('includes/footer', $data) ?>