<?php

use Model\Auth;

$this->view('includes/header', $data) ?>
<?php $this->view('includes/nav', $data) ?>


<style>
  .progress {
    position: absolute;
    height: 30px;
    width: 30px;
    cursor: pointer;
    top: 0%;
    left: 0%;
    /* margin: -80px 0 0 -80px; */
  }

  .progress-circle {
    transform: rotate(-90deg);
    margin-top: -40px;
  }

  .progress-circle-back {
    fill: none;
    stroke: #D2D2D2;
    stroke-width: 10px;
  }

  .progress-circle-prog {
    fill: none;
    stroke: #7E3451;
    stroke-width: 10px;
    stroke-dasharray: 0 999;
    stroke-dashoffset: 0px;
    transition: stroke-dasharray 0.7s linear 0s;
  }

  .progress-text {
    width: 100%;
    position: absolute;
    top: 60px;
    text-align: center;
    font-size: 2em;
  }
</style>
<?php
// show($row);
// show($row_contents);
// die; 
?>
<?php if (!empty($row)) :  ?>
  <section class="single-post-content pt-3 pb-3  bg-dark text-light">
    <div class="container-fluid">


      <div class="row">
        <div class="col-12 d-flex justify-content-between align-items-center">
          <h5> <?= esc(ucwords($row->title)) ?></h5>
          <!-- progress bar -->
          <link href='https://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
          <div class="progress">
            <svg class="progress-circle" width="200px" height="200px" xmlns="http://www.w3.org/2000/svg">
              <circle class="progress-circle-back" cx="80" cy="80" r="74"></circle>
              <circle class="progress-circle-prog" cx="80" cy="80" r="74"></circle>
            </svg>
            <div class="progress-text" data-progress="0">0%</div>
          </div>
          <!-- end progress bar -->
        </div>
      </div>
    </div>
  </section>
  <section class="single-post-content pt-0">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-9" data-aos="fade-up">

          <!-- ======= Single Post Content ======= -->
          <div class="single-post">

            <div class="mb-4">

              <!-- ======= Hero Slider Section ======= -->
              <?php if (!empty($row_contents[0]->row_lectures[0])) { ?>
                <video id="myVideo" data-lecture="" controls class="js-video-upload-preview" style="width: 100%;">
                  <source src="" type="video/mp4">
                  Your browser does not support the video tag.
                </video>
              <?php } else { ?>
                <div class="text-center p-4">
                  <h3>That video content was not found!</h3>
                </div>
              <?php  } ?>

            </div>


            <ul class="nav nav-tabs" id="myTab" role="tablist">
              <li class="nav-item" role="presentation">
                <button class="nav-link active" id="overview-tab" data-bs-toggle="tab" data-bs-target="#overview" type="button" role="tab" aria-controls="overview" aria-selected="true">Overview</button>
              </li>
              <li class="nav-item" role="presentation">
                <button class="nav-link" id="comments-tab" data-bs-toggle="tab" data-bs-target="#comments" type="button" role="tab" aria-controls="comments" aria-selected="false">Student Comments</button>
              </li>
              <li class="nav-item" role="presentation">
                <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false">Objective</button>
              </li>
            </ul>
            <div class="tab-content" id="myTabContent">
              <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview-tab">
                <div class="accordion-body">
                  <p><?= esc($row->description) ?></p>
                  <br>
                  <?php if (!empty($row_learners)) : ?>
                    <div class="comment-replies bg-light p-3 mt-3 rounded">
                      <div class="reply d-flex mb-4">
                        <div class="flex-grow-1 ms-2 ms-sm-3">

                          <div class="reply-body">
                            <h6 class="comment-replies-title mb-4 text-muted text-uppercase">Requirements or prerequisites for this course</h6>
                            <ul class="row mt-4 ">
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
                </div>
              </div>
              <div class="tab-pane fade" id="comments" role="tabpanel" aria-labelledby="comments-tab">
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
              </div>
              <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                <?php if (!empty($row_learners)) : ?>
                  <div class="accordion-body" style="border: 1px solid black;">
                    <h3>What you'll learn</h3>
                    <ul class="row mt-4">
                      <?php foreach ($row_learners as $cmeta) :
                        if ($cmeta->tab == "intended-learners") : ?>
                          <li class="col-md-6" style="list-style-type: circle;"><?= esc($cmeta->value) ?></li>
                        <?php endif ?>
                      <?php endforeach ?>
                    </ul>
                  </div>
                <?php endif ?>
              </div>
            </div>

          </div><!-- End Single Post Content -->
        </div><!-- Col 9 ended -->
        <div class="col-md-3">
          <!-- ======= Sidebar ======= -->
          <div class="aside-block">
            <div class="row">
              <div class="col-12">
                <?php if (!empty($row_contents)) : ?>
                  <div class="accordion" id="accordionPanelsStayOpenExample">
                    <?php foreach ($row_contents as $key => $lecture) : ?>
                      <div class="accordion-item">
                        <h2 class="accordion-header">
                          <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="<?= '#panelsStayOpen-collapse' . $key ?>" aria-expanded="true" aria-controls="<?= '#panelsStayOpen-collapse' . $key ?>">
                            <?= esc(ucwords($lecture->value)) ?>
                          </button>
                        </h2>
                        <div id="<?= 'panelsStayOpen-collapse' . $key ?>" class="accordion-collapse collapse <?= ($key == 0) ? 'show' : 'hide'; ?>">
                          <table class="accordion-body table table-bordered table-hover mb-0">
                            <?php foreach ($lecture->row_lectures as $lmeta) : ?>
                              <tr>
                                <td>
                                  <li class=" py-2 " style="list-style-type: disclosure-closed;">
                                    <a href="#0" onclick="play_video('<?= get_video($lmeta->file) ?>','<?= esc($lmeta->id) ?>')" style="text-decoration: underline; color:brown; "><?= esc($lmeta->title) ?></a>
                                  </li>
                                  <!-- <li class="py-2" style="list-style-type: none; "><a href="<?= ROOT . '/course/video/' . esc($lmeta->file) ?>" style="text-decoration: underline; color:brown; ">Preview</a></li> -->
                                </td>

                              </tr>
                            <?php endforeach ?>
                          </table>
                        </div>

                      </div>
                    <?php endforeach ?>
                  </div>
                <?php endif ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
<?php else : ?>
  <div class="text-center p-4">
    <h3>That course was not found!</h3>
  </div>
<?php endif ?>



<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<!-- Dynamic play video -->
<script>
  let course_id = '<?= esc($row->id) ?? '' ?>';
  let instructor_id = '<?= esc($row->user_id) ?? '' ?>';
  let lecture_id = '<?= esc($row_contents[0]->row_lectures[0]->id) ?? '' ?>';
  var isCompleted = 0;
  let total_duration = 0;


  // on click dynamically load vieo form playlist to video player
  function play_video(video, id) {
    lecture_id = id;
    const videoPlayer = document.getElementById('myVideo');
    const source = videoPlayer.querySelector('source');
    source.src = '' + video;
    videoPlayer.load();
  }

  document.addEventListener('DOMContentLoaded', function() {
    const video = document.getElementById('myVideo');
    let intervalId;



    // get the total duration of the video once it's loaded
    video.addEventListener('loadedmetadata', function() {
      total_duration = Math.floor(video.duration);

    });

    // get the current Time of the video once it's start playing
    video.addEventListener('play', function() {
      intervalId = setInterval(function() {
        var currentTime = video.currentTime;
        const hours = Math.floor(currentTime);
        uploadData(hours);

      }, 5000); // 5000 milliseconds = 5 seconds

    });

    // get the current Time of the video once it's pause
    video.addEventListener('pause', function() {
      var currentTime = video.currentTime;
      const hours = Math.floor(currentTime);
      uploadData(hours);
      clearInterval(intervalId);
    });

    // get the current Time of the video once it's ended
    video.addEventListener('ended', function() {
      isCompleted = 1;
      var currentTime = video.currentTime;
      const hours = Math.floor(currentTime);
      uploadData(hours);
      clearInterval(intervalId);
    });


    // Upload video current time to server every 5 seconds
    function uploadData(currentTime) {
      var xhr = new XMLHttpRequest();
      xhr.open('POST', '<?= ROOT ?>/course/update-lecture-progress', true);
      xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
      xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
          // alert(xhr.responseText);
          console.log(xhr.responseText);
          // alert('Data uploaded successfully');
        }
      };

      const progress = (currentTime / total_duration) * 100;

      // Prepare data for sent to server
      var data = 'progress=' + Math.floor(progress) +
        '&course_id=' + course_id +
        '&lecture_id=' + lecture_id +
        '&isCompleted=' + isCompleted +
        '&instructor_id=' + instructor_id;

      xhr.send(data);
    }

  });
</script>


<?php $this->view('includes/footer', $data) ?>