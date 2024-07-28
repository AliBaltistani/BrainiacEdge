<?php $this->view('includes/header', $data) ?>
<?php $this->view('includes/nav', $data) ?>


<?php if (!empty($rows)) : ?>

  <!-- ======= Post Grid Section ======= -->
  <section id="posts" class="posts">
    <div class="container" data-aos="fade-up">

      <div class="section-header d-flex justify-content-between align-items-center mb-5">
        <h2>All Latest Courses</h2>
      </div>

      <div class="row">
        <div class="col-lg-9">
          <div class="row">
            <?php if (!empty($rows)) : ?>
              <?php foreach ($rows as $row) : ?>
                <div class="col-lg-4">
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
        <div class="col-lg-3">
          <div class="row">
            <!-- Trending -->
            <div class="col-12">
              <h2>TRENDING</h2>
              <hr>
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
      </div>

    </div>
  </section> <!-- End Post Grid Section -->

<?php else : ?>

  <div class="alert alert-success text-center">No records were found!</div>
<?php endif; ?>


<?php $this->view('includes/footer', $data) ?>