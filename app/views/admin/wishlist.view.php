<?php

use Model\Auth;

$this->view('admin/admin-header', $data) ?>

<section class="h-100" style="background-color: #eee;">
  <div class="container h-100 py-5">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-10 text-center">

        <div class="d-flex justify-content-between align-items-center mb-4">
          <h3 class="fw-normal mb-0 text-black">Shopping Cart</h3>
          
        </div>

        <?php if(!empty($rows)){
         foreach($rows as $row): ?>
        <div class="card rounded-3 mb-4">
          <div class="card-body p-4">
            <div class="row d-flex justify-content-between align-items-center">
              <div class="col-md-2 col-lg-2 col-xl-2">
                <img
                  src="<?=get_image($row->course_now->course_image)?>"
                  class="img-fluid rounded-3" alt="">
              </div>
              <div class="col-md-5 col-lg-5 col-xl-5">
                <p class="lead fw-normal mb-2"><?= esc($row->course_now->title) ?></p>
                <p><span class="text-muted"><?= esc($row->course_now->subtitle) ?></p>
              </div>
             
              <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1">
                <h5 class="mb-0"><?= esc($row->course_price) ?></h5>
              </div>
              <div class="col-md-1 col-lg-1 col-xl-1 text-end">
                <a href="<?=ROOT.'/admin/delete-wishlist/'.$row->id; ?>" class="text-danger"><i class="bi bi-trash-fill text-danger"></i></a>
              </div>
            </div>
          </div>
        </div>
        <?php endforeach ?>
        <?php }else{
          echo '<h3>Your cart us empty</h3>';
        } ?>

        <a href="<?=ROOT.'/admin/course-buy'?>" class="btn btn-warning ">Buy Now</a>
         

      </div>
    </div>
  </div>
</section>
<?php $this->view('admin/admin-footer', $data) ?>