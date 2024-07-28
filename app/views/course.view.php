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
              <li class="mx-2"><a href="<?= ROOT . '/course/' . generate_slug(esc($row->category_row->category ?? 'Unknown')) ?>"><?= esc($row->category_row->category ?? 'Unknown') ?> </a> > </li>
            </ul>
            <h1 class="mt-4"><?= esc(ucwords($row->title)) ?></h1>
            <h5 class="my-3"><?= esc($row->subtitle) ?></h1>
              <div class="post-meta my-4">
                <span>
                  <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 384 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                    <path d="M32 32C14.3 32 0 46.3 0 64S14.3 96 32 96H160V448c0 17.7 14.3 32 32 32s32-14.3 32-32V96H352c17.7 0 32-14.3 32-32s-14.3-32-32-32H192 32z" />
                  </svg>
                  <?= esc($row->primary_subject) ?></span>
                <span class="mx-1">&bullet;</span>
                <span>
                  <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                    <path d="M128 0c17.7 0 32 14.3 32 32V64H288V32c0-17.7 14.3-32 32-32s32 14.3 32 32V64h48c26.5 0 48 21.5 48 48v48H0V112C0 85.5 21.5 64 48 64H96V32c0-17.7 14.3-32 32-32zM0 192H448V464c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V192zm64 80v32c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16V272c0-8.8-7.2-16-16-16H80c-8.8 0-16 7.2-16 16zm128 0v32c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16V272c0-8.8-7.2-16-16-16H208c-8.8 0-16 7.2-16 16zm144-16c-8.8 0-16 7.2-16 16v32c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16V272c0-8.8-7.2-16-16-16H336zM64 400v32c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16V400c0-8.8-7.2-16-16-16H80c-8.8 0-16 7.2-16 16zm144-16c-8.8 0-16 7.2-16 16v32c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16V400c0-8.8-7.2-16-16-16H208zm112 16v32c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16V400c0-8.8-7.2-16-16-16H336c-8.8 0-16 7.2-16 16z" />
                  </svg>
                  <?= get_date($row->date) ?></span>
                <span class="mx-1">&bullet;</span>
                <span>
                  <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 640 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                    <path d="M0 128C0 92.7 28.7 64 64 64H256h48 16H576c35.3 0 64 28.7 64 64V384c0 35.3-28.7 64-64 64H320 304 256 64c-35.3 0-64-28.7-64-64V128zm320 0V384H576V128H320zM178.3 175.9c-3.2-7.2-10.4-11.9-18.3-11.9s-15.1 4.7-18.3 11.9l-64 144c-4.5 10.1 .1 21.9 10.2 26.4s21.9-.1 26.4-10.2l8.9-20.1h73.6l8.9 20.1c4.5 10.1 16.3 14.6 26.4 10.2s14.6-16.3 10.2-26.4l-64-144zM160 233.2L179 276H141l19-42.8zM448 164c11 0 20 9 20 20v4h44 16c11 0 20 9 20 20s-9 20-20 20h-2l-1.6 4.5c-8.9 24.4-22.4 46.6-39.6 65.4c.9 .6 1.8 1.1 2.7 1.6l18.9 11.3c9.5 5.7 12.5 18 6.9 27.4s-18 12.5-27.4 6.9l-18.9-11.3c-4.5-2.7-8.8-5.5-13.1-8.5c-10.6 7.5-21.9 14-34 19.4l-3.6 1.6c-10.1 4.5-21.9-.1-26.4-10.2s.1-21.9 10.2-26.4l3.6-1.6c6.4-2.9 12.6-6.1 18.5-9.8l-12.2-12.2c-7.8-7.8-7.8-20.5 0-28.3s20.5-7.8 28.3 0l14.6 14.6 .5 .5c12.4-13.1 22.5-28.3 29.8-45H448 376c-11 0-20-9-20-20s9-20 20-20h52v-4c0-11 9-20 20-20z" />
                  </svg>

                     <?= esc($row->language_row->name ?? '') ?></span>
              </div>

              <div class="my-4">
                <!-- ======= Hero Slider Section ======= -->
                <img src="<?= get_image($row->course_image) ?>" alt="" style="width: -webkit-fill-available;height: 300px;">
              </div>

              <?php if (!empty($row_learners)) : ?>
                <div class="my-4">
                  <div class="accordion-body" style="border: 1px solid black;">
                    <h3>What you'll learn</h3>
                    <ul class="row mt-4">
                      <?php foreach ($row_learners as $cmeta) :
                        if ($cmeta->tab == "intended-learners") : ?>
                          <li class="col-md-6" style="list-style-type: circle;"><?= esc($cmeta->value) ?></li>
                        <?php endif ?>
                      <?php endforeach ?>
                    </ul>
                    <!-- <strong>This is the first item's accordion body.</strong> It is shown by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow. -->
                  </div>
                </div>
              <?php endif ?>

              <?php if (!empty($row_contents)) : ?>
                <h2>Course Content</h2>
                <div class="accordion" id="accordionPanelsStayOpenExample">
                  <?php foreach ($row_contents as $key => $lecture) : ?>
                    <div class="accordion-item">
                      <h2 class="accordion-header">

                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="<?= '#panelsStayOpen-collapse' . $key ?>" aria-expanded="true" aria-controls="<?= '#panelsStayOpen-collapse' . $key ?>">
                          <?= esc(ucwords($lecture->value)) ?>
                        </button>
                      </h2>

                      <div id="<?= 'panelsStayOpen-collapse' . $key ?>" class="accordion-collapse collapse <?= ($key == 0) ? 'show' : 'hide'; ?>">
                        <div class="accordion-body">
                          <ul class="row my-4">
                            <?php foreach ($lecture->row_lectures as $lmeta) : ?>
                              <li class="col-8 py-2" style="list-style-type: disclosure-closed; "><a href="#0" style="text-decoration: underline; color:brown; "><?= esc($lmeta->title) ?></a></li>
                              <li class="col-4 py-2" style="list-style-type: none; "><a href="#0" style="text-decoration: underline; color:brown; ">Preview</a></li>
                            <?php endforeach ?>
                          </ul>
                        </div>
                      </div>

                    </div>
                  <?php endforeach ?>
                </div>

              <?php endif ?>

              <p><?= esc($row->description) ?></p>

              <?php if (!empty($row_learners)) : ?>

                <div class="comment-replies bg-light p-3 mt-3 rounded">
                  <div class="reply d-flex mb-4">
                    <div class="flex-grow-1 ms-2 ms-sm-3">

                      <div class="reply-body">
                        <h6 class="comment-replies-title mb-4 text-muted text-uppercase">Requirements or prerequisites for this course</h6>
                        <ul class="row mt-4">
                          <?php foreach ($row_learners as $cmeta) :
                            if ($cmeta->data_type == "prerequisites") : ?>
                              <li class="col-md-6" style="list-style-type: circle;"><?= esc($cmeta->value) ?></li>
                            <?php endif ?>
                          <?php endforeach ?>
                        </ul>
                      </div>

                      <div class="reply-body">
                        <h6 class="comment-replies-title mb-4 text-muted text-uppercase">Who is this course for?</h6>
                        <h3 class="my-4"></h3>
                        <ul class="row mt-4">
                          <?php foreach ($row_learners as $cmeta) :
                            if ($cmeta->data_type == "whose-course") : ?>
                              <li class="col-md-6" style="list-style-type: circle;"><?= esc($cmeta->value) ?></li>
                            <?php endif ?>
                          <?php endforeach ?>
                        </ul>
                      </div>

                    </div>
                  </div>
                </div>
              <?php endif ?>
          </div><!-- End Single Post Content -->

          <hr>
          <!-- ======= Comments ======= -->
          <div class="comments">
            <h5 class="comment-title py-4"><?= (!empty($comments)) ? count($comments) : ''; ?> Comments</h5>

            <?php if (!empty($comments)) {
              foreach ($comments as $ckey => $comment) : ?>
                <div class="comment d-flex mb-4">
                  <div class="flex-shrink-0">
                    <div class="avatar avatar-sm rounded-circle">
                      <img class="avatar-img" src="<?= get_image($comment->user_row->image) ?>" alt="" class="img-fluid">
                    </div>
                  </div>
                  <div class="flex-grow-1 ms-2 ms-sm-3">
                    <div class="comment-meta d-flex align-items-baseline">
                      <h6 class="me-2"><?= esc($comment->user_row->name) ?></h6>

                      <span class="text-muted"> <small><i><?= get_date($comment->timestamp) ?></i> </small></span>
                    </div>
                    <div class="comment-body">
                      <p><?= esc($comment->message) ?></p>
                      <button type="button" data-bs-toggle="collapse" data-bs-target="<?= '#panelsStayOpen-collapse' . $ckey ?>" aria-expanded="true" aria-controls="<?= '#panelsStayOpen-collapse' . $ckey ?>">
                        <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 512 512">
                          <path d="M205 34.8c11.5 5.1 19 16.6 19 29.2v64H336c97.2 0 176 78.8 176 176c0 113.3-81.5 163.9-100.2 174.1c-2.5 1.4-5.3 1.9-8.1 1.9c-10.9 0-19.7-8.9-19.7-19.7c0-7.5 4.3-14.4 9.8-19.5c9.4-8.8 22.2-26.4 22.2-56.7c0-53-43-96-96-96H224v64c0 12.6-7.4 24.1-19 29.2s-25 3-34.4-5.4l-160-144C3.9 225.7 0 217.1 0 208s3.9-17.7 10.6-23.8l160-144c9.4-8.5 22.9-10.6 34.4-5.4z" />
                        </svg> &nbsp; Reply
                      </button>

                      <div id="<?= 'panelsStayOpen-collapse' . $ckey ?>" class="accordion-collapse collapse <?= ($ckey == 0) ? 'show' : 'hide'; ?>">
                        <div class="accordion-body">
                          <div class="comment-replies bg-light p-3 mt-3 rounded">
                            <h6 class="comment-replies-title mb-4 text-muted text-uppercase">replies</h6>
                            <?php
                            if (!empty($replies)) :
                              foreach ($replies as $reply) :
                                if ($reply->comment_id ==  $comment->id) : ?>

                                  <div class="reply d-flex mb-4">
                                    <div class="flex-shrink-0">
                                      <div class="avatar avatar-sm rounded-circle">
                                        <img class="avatar-img" src="<?= get_image($reply->user_reply->rpimage) ?>" alt="" class="img-fluid">
                                      </div>
                                    </div>
                                    <div class="flex-grow-1 ms-2 ms-sm-3">
                                      <div class="reply-meta d-flex align-items-baseline">
                                        <h6 class="mb-0 me-2"><?= esc($reply->user_reply->rpname) ?></h6>
                                        <span class="text-muted"><small> <?= get_date($reply->timestamp) ?></small></span>
                                      </div>
                                      <div class="reply-body">
                                        <?= esc($reply->reply_message) ?>
                                      </div>
                                    </div>
                                  </div>
                                <?php endif ?>
                              <?php endforeach  ?>
                            <?php endif  ?>
                            <div class="reply d-flex">
                              <!-- ======= Reply Form ======= -->
                              <div class="comments">
                                <h5 class="comment-title ">Leave a Reply</h5>
                                <form method="post" action="<?= ROOT . '/course/comment-reply/' . generate_slug(esc($row->title)) ?>">
                                  <div class="comment d-flex">
                                    <div class="flex-shrink-0">
                                      <div class="avatar avatar-sm rounded-circle">
                                        <img class="avatar-img" src="<?= get_image(Auth::getImage()) ?>" alt="" class="img-fluid">
                                      </div>
                                    </div>
                                    <div class="flex-shrink-1 ms-2 ms-sm-3">
                                      <div class="comment-meta d-flex">
                                        <h6 class="me-2"><?= esc(Auth::getFirstname()) . " " . esc(Auth::getLastname()) ?? 'unknown'; ?></h6>
                                      </div>
                                      <div class="comment-body">
                                        <input type="hidden" name="post_id" value="<?= $row->id ?>">
                                        <input type="hidden" name="comment_id" value="<?= $comment->id ?>">
                                        <input type="hidden" name="from_id" value="<?= Auth::getId() ?>">
                                        <input type="hidden" name="to_id" value="<?= $row->user_id ?? '' ?>">
                                        <textarea name="reply_message" class="form-control w-100" id="comment-message" placeholder="Enter your message" cols="100" rows="3"></textarea>
                                      </div>
                                      <div class="comment-meta d-flex">
                                        <input type="submit" class="btn btn-primary py-2" value="Post Reply">
                                      </div>
                                    </div>
                                  </div>
                                </form>
                              </div><!-- End Reply Form -->
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>


                  </div>
                </div>
              <?php endforeach ?>
            <?php } else { ?>
              <div class="text-center p-4">
                <h6>No comments fonud..</h6>
              </div>
            <?php }  ?>

          </div><!-- End Comments -->


          <!-- ======= Comments Form ======= -->
          <div class="comments">
            <h5 class="comment-title py-4">Leave a Comments</h5>
            <form method="post" action="<?= ROOT . '/course/comments/' . generate_slug(esc($row->title)) ?>">
              <div class="comment d-flex">
                <div class="flex-shrink-0">
                  <div class="avatar avatar-sm rounded-circle">
                    <img class="avatar-img" src="<?= get_image(Auth::getImage()) ?>" alt="" class="img-fluid">
                  </div>
                </div>
                <div class="flex-shrink-1 ms-2 ms-sm-3">
                  <div class="comment-meta d-flex">
                    <h6 class="me-2"><?= esc(Auth::getFirstname()) . " " . esc(Auth::getLastname()) ?? 'unknown'; ?></h6>
                  </div>
                  <div class="comment-body">
                    <input type="hidden" name="post_id" value="<?= $row->id ?>">
                    <input type="hidden" name="from_id" value="<?= Auth::getId() ?>">
                    <input type="hidden" name="to_id" value="<?= $row->user_id ?? '' ?>">
                    <input type="hidden" name="action" value="<?= 'save' ?>">
                    <textarea name="message" class="form-control w-100" id="comment-message" placeholder="Enter your message" cols="100" rows="3"></textarea>
                  </div>
                  <div class="comment-meta d-flex">
                    <input type="submit" class="btn btn-primary py-2" value="Post comment">
                  </div>
                </div>
              </div>
            </form>
          </div><!-- End Comments Form -->



        </div><!-- Col 9 ended -->
        <div class="col-md-3">
          <!-- ======= Sidebar ======= -->
          <div class="aside-block">
            <div class="row">
              <div class="col-12">
                <video controls class="js-video-upload-preview" style="width: 100%;">
                  <source src="<?= get_video($row->course_promo_video) ?>" type="video/mp4">
                </video>
                <h4 class="py-4">Price:
                  
                <small><?=  esc($row->price_row->symbol ?? 'unknown') .'('. (double) $row->price_row->price . ')' ?></small>
                  
                </h4> 
                <div class="row">
                  <div class="col-8">
                    <?php if (empty($buy_item)) { ?>

                      <button type="button" class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#myModal">
                        Buy this Course
                      </button>
                    <?php } else { ?>
                      <a href="<?= ROOT . '/course/learn-lecture/' . generate_slug(esc($row->title)) . "?id=" . $row->id; ?>" class="btn btn-success w-100">Start Learn</a>
                    <?php } ?>
                  </div>
                  <div class="col-4">
                  <?php if (empty($cart_item)) { ?>
                    <form action="<?= ROOT . '/course/add-to-cart/' . generate_slug(esc($row->title)) ?>" method="post">
                      <input type="hidden" name="course_id" value="<?= $row->id ?>">
                      <input type="hidden" name="user_to_id" value="<?= $row->user_id ?>">
                      <input type="hidden" name="user_of_id" value="<?= Auth::getId() ?>">
                      <input type="hidden" name="course_title" value="<?= esc($row->title) ?>">
                      <input type="hidden" name="course_price" value="<?= esc($row->price_row->price ?? 'unknown') ?>">
                      <input type="hidden" name="user_name" value="<?= esc($row->user_row->name ?? 'unknown') ?>">
                      <button type="submit" class="btn btn-outline-primary w-100 ">
                          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 512 512">
                            <path d="M225.8 468.2l-2.5-2.3L48.1 303.2C17.4 274.7 0 234.7 0 192.8v-3.3c0-70.4 50-130.8 119.2-144C158.6 37.9 198.9 47 231 69.6c9 6.4 17.4 13.8 25 22.3c4.2-4.8 8.7-9.2 13.5-13.3c3.7-3.2 7.5-6.2 11.5-9c0 0 0 0 0 0C313.1 47 353.4 37.9 392.8 45.4C462 58.6 512 119.1 512 189.5v3.3c0 41.9-17.4 81.9-48.1 110.4L288.7 465.9l-2.5 2.3c-8.2 7.6-19 11.9-30.2 11.9s-22-4.2-30.2-11.9zM239.1 145c-.4-.3-.7-.7-1-1.1l-17.8-20c0 0-.1-.1-.1-.1c0 0 0 0 0 0c-23.1-25.9-58-37.7-92-31.2C81.6 101.5 48 142.1 48 189.5v3.3c0 28.5 11.9 55.8 32.8 75.2L256 430.7 431.2 268c20.9-19.4 32.8-46.7 32.8-75.2v-3.3c0-47.3-33.6-88-80.1-96.9c-34-6.5-69 5.4-92 31.2c0 0 0 0-.1 .1s0 0-.1 .1l-17.8 20c-.3 .4-.7 .7-1 1.1c-4.5 4.5-10.6 7-16.9 7s-12.4-2.5-16.9-7z" />
                          </svg>
                      </button>
                    </form>

                    <?php } else { ?>
                      <button type="button" class="btn btn-outline-primary w-100 ">
                          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 512 512">
                            <path d="M47.6 300.4L228.3 469.1c7.5 7 17.4 10.9 27.7 10.9s20.2-3.9 27.7-10.9L464.4 300.4c30.4-28.3 47.6-68 47.6-109.5v-5.8c0-69.9-50.5-129.5-119.4-141C347 36.5 300.6 51.4 268 84L256 96 244 84c-32.6-32.6-79-47.5-124.6-39.9C50.5 55.6 0 115.2 0 185.1v5.8c0 41.5 17.2 81.2 47.6 109.5z" />
                          </svg>
                          </button>
                        <?php } ?>
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
              <?php if ($row->tags) {
                $tags = explode(',', $row->tags);
                for ($i = 0; $i < count($tags); $i++) {
                  echo '<li ><a class"m-2" href="' . ROOT . '/course/search-tags/' . generate_slug($tags[$i]) . '">' . $tags[$i] . '</a></li>';
                }
              } ?>

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


<!-- Button trigger modal -->




<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-9988" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle"><?= ucwords(esc($row->title)) ?></h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= ROOT . '/course/course-buy/' . generate_slug(esc($row->title)) ?>" method="post">
      <div class="modal-body">
        <h4 class="py-2">Price: 
        <small><?=  esc($row->price_row->symbol ?? 'unknown') .'('. (double) $row->price_row->price . ')' ?></small>
                  </h4>
        <h4 class="">Enter Payment Details </h4>
        
          <div class="row ">
            <div class="col-12 my-2">
              <div class="form__div">
                <label for="" class="form__label">Name on card:</label>
                <input type="text" class="form-control" placeholder="Enter name on card" required>
              </div>
            </div>
            <div class="col-12 my-2">
              <div class="form__div">
                <label for="" class="form__label">Card number:</label> 
                <input type="text" class="form-control" placeholder="Endter Card Number" required>
              </div>
            </div>

            <div class="col-6 my-2">
              <div class="form__div">
                <label for="" class="form__label">Expiration Date:</label>
                <input type="date" class="form-control" placeholder="Enter expiration Date" required>
              </div>
            </div>

            <div class="col-6 my-2">
              <div class="form__div">
                <label for="" class="form__label">Security Code:</label>
                <input type="password" class="form-control" placeholder="Enter security code" required>
              </div>
            </div>
            <!-- <div class="col-12">
              <div class="form__div">
                <input type="text" class="form-control" placeholder="name on the card " required>
                <label for="" class="form__label">name on the card</label>
              </div>
            </div> -->
          </div>
      </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

          <input type="hidden" name="course_id" value="<?= $row->id ?>">
          <input type="hidden" name="user_id" value="<?= Auth::getId() ?>">
          <input type="hidden" name="instructor_id" value="<?= $row->user_id ?>">
          <button type="submit" class="btn btn-primary">Pay Now</button>

        </div>
      </form>
    </div>
  </div>
</div>

<?php $this->view('includes/footer', $data) ?>