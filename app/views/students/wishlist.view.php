<?php
use Model\Auth;

$this->view('students/student-header', $data) ?>

<section class="h-100" style="background-color: #eee;">
  <div class="container h-100 py-5">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-10 text-center">

        <div class="d-flex justify-content-between align-items-center mb-4">
          <h3 class="fw-normal mb-0 text-black">My Cart</h3>
          
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
                <h5 class="mb-0">RM<?= esc($row->course_price) ?></h5>
              </div>
              <div class="col-md-1 col-lg-1 col-xl-1 text-end">
                <a href="<?=ROOT.'/students/delete-wishlist/'.$row->id; ?>" class="text-danger"><i class="bi bi-trash-fill text-danger"></i></a>
              </div>
            </div>
          </div>
        </div>
        <?php endforeach ?>
         <button type="button" class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#myModal">
                        Buy this Course
                      </button>
        <?php }else{
          echo '<h3>Your cart us empty</h3>';
        } ?>

      </div>
    </div>
  </div>
</section>


<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-9988" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">My Cart Items</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= ROOT . '/students/course-buy/' ?>" method="post">
      <div class="modal-body">
        <table class="table table-bordered">
        <?php if(!empty($rows)){
          $total_price = 0;
          foreach($rows as $row):
            $total_price += (int)$row->course_price;
           ?>
            <tr>
              <th>Title:</th>
              <td><?= esc($row->course_now->title) ?></td>
              <th>Price:</th>
              <td><?= esc($row->course_price) ?></td>
            </tr>
          <?php endforeach; }  ?>

          <tr>
              <th colspan="2">Total Price:</th>
              <td colspan="2"> RM <?= $total_price ?></td>
            </tr>
        </table>
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

          <?php if(!empty($rows)){
            $total_price = 0;
            foreach($rows as $key => $row):
              $total_price += (int)$row->course_price;
            ?>
            <tr>
              <input type="hidden" name="<?= 'id-'.$key ?>" value="<?= $row->id ?>">
            </tr>
          <?php endforeach; }  ?>
          <button type="submit" class="btn btn-primary">Pay now</button>

        </div>
      </form>
    </div>
  </div>
</div>

<?php $this->view('students/student-footer', $data) ?>