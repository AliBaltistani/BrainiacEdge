<?php $this->view('admin/admin-header',$data) ?>

<style>
  
  .tabs-holder{
    display: flex;
    margin-top: 10px; 
    margin-bottom: 10px;
    justify-content: center;
    text-align: center;
    flex-wrap: wrap;
  }

  .my-tab{
    flex:1;
    border-bottom: solid 2px #ccc;
    padding-top: 10px;
    padding-bottom: 10px;
    cursor: pointer;
    user-select: none;
    min-width: 150px;

  }
  .my-tab:hover{
    color: #4154f1;
  }

  .active-tab{
    color: #4154f1;
    border-bottom: solid 2px #4154f1;
  }

  .hide{
    display: none;
  }

  .loader{
    position: relative;
    width:200px;
    height:200px;
    left: 50%;
    top: 50%;
    transform: translateX(-50%);
    opacity: 0.5;
  }

</style>
<?php if($action == 'add'):?>

  <div class="card col-md-5 mx-auto">
    <div class="card-body">
      <h5 class="card-title">New Price</h5>
      <!-- No Labels Form -->
      <form action="<?=ROOT?>/admin/pricies/save" method="post" class="row g-3">
        
        <div class="col-md-12">
          <input value="<?=set_value('name')?>" name="name" type="text" class="form-control <?=!empty($errors['name']) ? 'border-danger':'';?>" placeholder="Price name">
          <?php if(!empty($errors['name'])):?>
            <small class="text-danger"><?=$errors['name']?></small>
          <?php endif;?>
        
        </div>
        <div class="col-md-12">
        <input value="<?=set_value('price')?>" name="price" type="number" class="form-control <?=!empty($errors['price']) ? 'border-danger':'';?>" placeholder="Price ">
          <?php if(!empty($errors['price'])):?>
            <small class="text-danger"><?=$errors['price']?></small>
          <?php endif;?>
          
        </div>
        <div class="col-md-12">
        <input value="<?=set_value('symbol')?>" name="symbol" type="text" class="form-control <?=!empty($errors['symbol']) ? 'border-danger':'';?>" placeholder="Price Symbol">
          <?php if(!empty($errors['symbol'])):?>
            <small class="text-danger"><?=$errors['symbol']?></small>
          <?php endif;?>
        </div>
 
        <div class="col-md-12">
          <label>Active:</label>
          <select name="disabled" class="form-select">
            
            <option value="0" selected="">Yes</option>
            <option value="1">No</option>

          </select>

        </div>
    
        <div class="text-center">
          <button type="submit" class="btn btn-primary">Save</button>

          <a href="<?=ROOT?>/admin/pricies">
            <button type="button" class="btn btn-secondary">Cancel</button>
          </a>
        </div>
      </form><!-- End No Labels Form -->
    </div>
  </div>
<?php elseif($action == 'edit'):?>

  
    <div class="card col-md-5 mx-auto">
    <div class="card-body">
      <h5 class="card-title">Edit Price</h5>
      <!-- No Labels Form -->
      <form action="<?=ROOT?>/admin/pricies/save-edit/<?=$rows[0]->id?>" method="post" class="row g-3">
        
        <div class="col-md-12">
          <input value="<?=(set_value('name')?set_value('name'):$rows[0]->name)?>" name="name" type="text" class="form-control <?=!empty($errors['name']) ? 'border-danger':'';?>" placeholder="Price name">
          <?php if(!empty($errors['name'])):?>
            <small class="text-danger"><?=$errors['name']?></small>
          <?php endif;?>
        
        </div>
        <div class="col-md-12">
        <input value="<?=(set_value('price')?set_value('price'):$rows[0]->price)?>" name="price" type="number" class="form-control <?=!empty($errors['price']) ? 'border-danger':'';?>" placeholder="Price ">
          <?php if(!empty($errors['price'])):?>
            <small class="text-danger"><?=$errors['price']?></small>
          <?php endif;?>
          
        </div>
        <div class="col-md-12">
        <input value="<?=(set_value('symbol')?set_value('symbol'):$rows[0]->symbol)?>" name="symbol" type="text" class="form-control <?=!empty($errors['symbol']) ? 'border-danger':'';?>" placeholder="Price Symbol">
          <?php if(!empty($errors['symbol'])):?>
            <small class="text-danger"><?=$errors['symbol']?></small>
          <?php endif;?>
        </div>
 
        <div class="col-md-12">
          <label>Active:</label>
          <select name="disabled" class="form-select">
            
            <option value="0" selected="">Yes</option>
            <option value="1">No</option>

          </select>

        </div>
    
        <div class="text-center">
          <button type="submit" class="btn btn-primary">Save</button>

          <a href="<?=ROOT?>/admin/pricies">
            <button type="button" class="btn btn-secondary">Cancel</button>
          </a>
        </div>
      </form><!-- End No Labels Form -->
    </div>
  </div>

<?php else:?>

  <div class="card">

    <div class="card-body">
      <h5 class="card-title">
        Prices 
        <a href="<?=ROOT?>/admin/pricies/add">
          <button class="btn btn-primary float-end"> New Price</button>
        </a>
      </h5>

      <?php if(user_can('view_prices')):?>

          <!-- Table with stripped rows -->
          <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Price Name</th>
                <th scope="col">price</th>
                <th scope="col">symbol</th>
                <th scope="col">Active</th>
                <th scope="col">Action</th>
              </tr>
            </thead>

            <?php if(!empty($rows)):?>
              <tbody>

                <?php foreach($rows as $row):?>
                  <tr>
                    <th scope="row"><?=$row->id?></th>
                    <td><?=esc($row->name) ?></td>
                    <td><?=esc($row->price) ?></td>
                    <td><?=esc($row->symbol) ?></td>
                    <td><?=esc($row->disabled ? 'No':'Yes')?></td>
                    <td>
                      <a href="<?=ROOT?>/admin/pricies/edit/<?=$row->id?>">
                        <i class="bi bi-pencil-square"></i> 
                      </a>
                      <a href="<?=ROOT?>/admin/pricies/delete/<?=$row->id?>">
                        <i class="bi bi-trash-fill text-danger"></i>
                      </a>
                    </td>
                  </tr>
                <?php endforeach;?>

              </tbody>
            <?php else:?>
              <tr><td colspan="10">No records found!</td></tr>
            <?php endif;?>

          </table>
          <!-- End Table with stripped rows -->
      <?php else:?>
        <div class="alert alert-danger text-center">You dont have permission to perform this action!</div>
      <?php endif;?>

    </div>
  </div>

<?php endif;?>


<?php $this->view('admin/admin-footer',$data) ?>