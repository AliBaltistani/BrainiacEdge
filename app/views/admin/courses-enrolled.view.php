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
        <?= 'Enrolled Courses'  ?>
      </h5>
      <!-- Table with stripped rows -->
      <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Title</th>
            <th scope="col">Image</th>
            <th scope="col">Instructor</th>
            <th scope="col">Category</th>
            <th scope="col">Price</th>
            <th scope="col">Date</th>
            <th scope="col">Progress</th>
            <th scope="col">Action</th>
          </tr>
        </thead>

        <?php if (!empty($rows)) : 


            $num = 1; ?>
          <tbody>

            <?php  foreach ($rows as $row) : ?>
              <tr>
                <th scope="row"><?= $num++ ?></th>
                <td><?= esc($row->course_enrolled->title)?? 'Unknown' ?></td>
                <td><img src="<?= get_image($row->course_enrolled->course_image)?? '' ?>" style="width: 100px;height: 100px;object-fit: cover;" /></td>
                <td><?= esc($row->course_instructor->name ?? 'Unknown') ?></td>
                <td><?= esc($row->course_enrolled->category_row->category ?? 'Unknown') ?></td>
                <td><?= esc($row->course_enrolled->price_row->name ?? 'Unknown') ?></td>
                <td><?= get_date($row->course_enrolled->date) ?></td> 
                <td> 
                    <?php
                        $progress  = 0;
                        if(!empty($row->course_progress)){
                            $count = count($row->course_progress);
                            $pc = 0;
                            foreach($row->course_progress as $progress_single){
                                $pc +=  (int) $progress_single->progress;
                            }
                            $total = $count*100;
                            $progress = ($pc/$total)* 100;
                        } 
                    ?>
                    <div class="progress">
                        <div class="progress-bar progress-bar-striped" role="progressbar" style="width: <?=$progress?>%" aria-valuenow="<?=$progress?>" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </td >
                <td>
                
                  <?php if(user_can('delete_enrolled_courses')){ ?>
                  <a href="<?= ROOT ?>/admin/delete-enrolled-course/<?= '?cid='.$row->id.'&inst_id='.$row->instructor_id ?>">
                    <i class="bi bi-trash-fill text-danger"></i>
                  </a>
                  
                  <?php } ?>
                </td>
              </tr>

            <?php endforeach; ?>

          </tbody>
        <?php else : ?>
          <tr>
            <td colspan="10">No records found!</td>
          </tr>
        <?php endif; ?>

        </table>
      <!-- End Table with stripped rows -->

    </div>
  </div>

<?php endif; ?>




<?php $this->view('admin/admin-footer', $data) ?>