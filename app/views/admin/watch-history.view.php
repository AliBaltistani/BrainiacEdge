<?php

use Model\Auth;

$this->view('admin/admin-header', $data) ?>

<style>
    .tabs-holder {
        display: flex;
        margin-top: 10px;
        margin-bottom: 10px;
        justify-content: center;
        text-align: center;
        flex-wrap: wrap;
    }

    .my-tab {
        flex: 1;
        border-bottom: solid 2px #ccc;
        padding-top: 10px;
        padding-bottom: 10px;
        cursor: pointer;
        user-select: none;
        min-width: 150px;

    }

    .my-tab:hover {
        color: #4154f1;
    }

    .active-tab {
        color: #4154f1;
        border-bottom: solid 2px #4154f1;
    }

    .hide {
        display: none;
    }

    .loader {
        position: relative;
        width: 200px;
        height: 200px;
        left: 50%;
        top: 50%;
        transform: translateX(-50%);
        opacity: 0.5;
    }
</style>

<?php if ($action == 'add') : ?>

    add
<?php elseif ($action == 'delete') : ?>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Delete Course</h5>

            <?php if (!empty($row)) : ?>

                <div class="alert alert-danger text-center">Are you sue you want to delete this course?!</div>


                <div class="float-end px-4">
                    <a href="<?= ROOT ?>/admin/courses">
                        <button class="btn btn-primary">Back</button>
                    </a>
                </div>
                <form method="post">
                    <div class="float-end">
                        <button class="btn btn-danger">Delete</button>
                    </div>
                    <h3 class="">Course Title: <?= esc($row->title) ?></h3>
                    <h5 class="">Primary Subject: <?= esc($row->primary_subject) ?></h5>
                    <h5 class="">Category: <?= esc($row->category_row->category) ?></h5>
                    <h5 class="">Date created: <?= get_date($row->date) ?></h5>
                </form>
            <?php else : ?>
                <div>That course was not found!</div>
            <?php endif; ?>

        </div>
    </div>

<?php elseif ($action == 'edit') : ?>
    edit

<?php else : ?>

    <div class="card">

        <div class="card-body">
            <h5 class="card-title">
                <?= 'Watch History'  ?>
            </h5>

    
            <div class="row">
            <?php if(!empty($rows)):
            foreach($rows as $row): ?>
            <div class="col-xxl-4 col-md-4">
                <div class="card info-card sales-card">
                    <?php if(user_can('delete_watch_history')): ?>
                    <div class="filter">
                        <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                            <li><a class="dropdown-item" href="<?=ROOT.'/admin/watch-history-delete/'.$row->id?>">Delete</a></li>
                        </ul>
                    </div>
                    <?php endif ?>
                    <div class="card-body">
                        <h5 class="card-title"><?=esc($row->course_now->title.'/'.$row->course_lectures->title)?></h5>
                        <div class="d-flex align-items-center">
                            <div class="">
                                <video id="myVideo" class="js-video-upload-preview" style="width: 100%;" >
                                    <source src="<?=get_video($row->course_lectures->file)?>"    type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                                <div class="progress">
                                    <div class="progress-bar progress-bar-striped" role="progressbar" style="width: <?= $row->progress.'%'?>" aria-valuenow="<?= $row->progress?>" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-center">
                        <a href="<?=ROOT.'/course/learn-lecture/'.generate_slug($row->course_now->title).'?id='.$row->course_id;?>" class="btn btn-warning" >Watch now</a>
                    </div>

                </div>
            </div>
            <?php endforeach ?>
            <?php endif ?>
            </div>
        </div>
    </div>

<?php endif; ?>




<?php $this->view('admin/admin-footer', $data) ?>