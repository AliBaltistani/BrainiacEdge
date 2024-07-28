<?php $this->view('admin/admin-header', $data) ?>

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

    <div class="card col-md-5 mx-auto">
        <div class="card-body">
            <h5 class="card-title">New User</h5>

            <!-- No Labels Form -->
            <form method="post" class="row g-3">

                <div class="col-6">
                    <input value="<?= set_value('firstname') ?>" type="text" name="firstname" class="form-control <?= !empty($errors['firstname']) ? 'border-danger' : ''; ?>" id="yourName" placeholder="First Name" required>
                    <div class="invalid-feedback">Please, enter your first name!</div>
                    <?php if (!empty($errors['firstname'])) : ?>
                        <small class="text-danger"><?= $errors['firstname'] ?></small>
                    <?php endif; ?>
                </div>
                <div class="col-6">
                    <input value="<?= set_value('lastname') ?>" type="text" name="lastname" class="form-control <?= !empty($errors['lastname']) ? 'border-danger' : ''; ?>" id="yourName2" placeholder="Last Name" required>
                    <div class="invalid-feedback">Please, enter your last name!</div>

                    <?php if (!empty($errors['lastname'])) : ?>
                        <small class="text-danger"><?= $errors['lastname'] ?></small>
                    <?php endif; ?>

                </div>

                <div class="col-12">
                    <input value="<?= set_value('email') ?>" type="email" name="email" class="form-control <?= !empty($errors['email']) ? 'border-danger' : ''; ?>" id="yourEmail" placeholder="User Email" required>
                    <div class="invalid-feedback">Please enter a valid Email adddress!</div>

                    <?php if (!empty($errors['email'])) : ?>
                        <small class="text-danger"><?= $errors['email'] ?></small>
                    <?php endif; ?>

                </div>

                <div class="col-12">
                    <input value="<?= set_value('password') ?>" type="password" name="password" class="form-control <?= !empty($errors['password']) ? 'border-danger' : ''; ?>" id="yourPassword" placeholder="Password" required>
                    <div class="invalid-feedback">Please enter your password!</div>
                </div>
                <div class="col-12">
                    <input value="<?= set_value('retype_password') ?>" type="password" name="retype_password" class="form-control" id="yourPassword" placeholder="Retype Password" required>
                    <div class="invalid-feedback">Please retype your password!</div>

                    <?php if (!empty($errors['password'])) : ?>
                        <small class="text-danger"><?= $errors['password'] ?></small>
                    <?php endif; ?>

                </div>

                <div class="col-6">
                    <select name="role" class="form-select">
                        <option value="" selected disabled>User Role</option>
                        <?php foreach ($roles as $rol) {
                            echo '<option value="' . $rol->id . '" >' . $rol->role . '</option>';
                        } ?>

                    </select>
                    <div class="invalid-feedback">Please select user role!</div>
                    <?php if (!empty($errors['role'])) : ?>
                        <small class="text-danger"><?= $errors['role'] ?></small>
                    <?php endif; ?>

                </div>

                <div class="col-6">
                    <select name="status" class="form-select">
                        <option value="" selected disabled>User Status</option>
                        <option value="pending">Pending</option>
                        <option value="approved">Approved</option>
                    </select>
                    <div class="invalid-feedback">Please select user role!</div>
                    <?php if (!empty($errors['status'])) : ?>
                        <small class="text-danger"><?= $errors['role'] ?></small>
                    <?php endif; ?>

                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Create Account</button>

                    <a href="<?= ROOT ?>/admin/users">
                        <button type="button" class="btn btn-secondary">Cancel</button>
                    </a>
                </div>
            </form><!-- End No Labels Form -->

        </div>
    </div>

<?php elseif ($action == 'delete') : ?>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Delete User</h5>

            <?php if (!empty($row)) : ?>

                <div class="alert alert-danger text-center">Are you sue you want to delete this user?!</div>

                <form method="post">
                    <div class="float-end">
                        <button class="btn btn-danger">Delete</button>
                        <a href="<?= ROOT ?>/admin/users">
                            <button class="btn btn-primary">Back</button>
                        </a>
                    </div>

                    <h3 class="">User Name: <?= esc($row->firstname . " " . $row->lastname) ?></h3>
                    <h5 class="">User Email: <?= esc($row->email) ?></h5>
                    <h5 class="">User Role: <?= esc($row->role_name) ?></h5>
                    <h5 class="">Date created: <?= get_date($row->date) ?></h5>
                </form>
            <?php else : ?>
                <div>That course was not found!</div>
            <?php endif; ?>

        </div>
    </div>

<?php elseif ($action == 'edit') : ?>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Edit User</h5>

            <?php if (!empty($row)) : ?>


                <!-- No Labels Form -->
                <form method="post" class="row g-3">

                    <div class="col-6">
                        <input value="<?= $row->firstname ?>" type="text" name="firstname" class="form-control <?= !empty($errors['firstname']) ? 'border-danger' : ''; ?>" id="yourName" placeholder="First Name" >
                        <div class="invalid-feedback">Please, enter your first name!</div>
                        <?php if (!empty($errors['firstname'])) : ?>
                            <small class="text-danger"><?= $errors['firstname'] ?></small>
                        <?php endif; ?>
                    </div>
                    <div class="col-6">
                        <input value="<?= $row->lastname ?>" type="text" name="lastname" class="form-control <?= !empty($errors['lastname']) ? 'border-danger' : ''; ?>" id="yourName2" placeholder="Last Name" >
                        <div class="invalid-feedback">Please, enter your last name!</div>

                        <?php if (!empty($errors['lastname'])) : ?>
                            <small class="text-danger"><?= $errors['lastname'] ?></small>
                        <?php endif; ?>

                    </div>

                    <div class="col-12">
                        <input value="<?= $row->email ?>" type="email" name="email" class="form-control <?= !empty($errors['email']) ? 'border-danger' : ''; ?>" id="yourEmail" placeholder="User Email" >
                        <div class="invalid-feedback">Please enter a valid Email adddress!</div>

                        <?php if (!empty($errors['email'])) : ?>
                            <small class="text-danger"><?= $errors['email'] ?></small>
                        <?php endif; ?>

                    </div>

                    <div class="col-12">
                        <input value="<?= '' ?>" type="password" name="password" class="form-control <?= !empty($errors['password']) ? 'border-danger' : ''; ?>" id="yourPassword" placeholder="New Password (optional)" >
                        <div class="invalid-feedback">Please enter your password!</div>
                    </div>
                    <div class="col-12">
                        <input value="<?= '' ?>" type="password" name="retype_password" class="form-control" id="yourPassword" placeholder="Retype Password (optional)" >
                        <div class="invalid-feedback">Please retype your password!</div>

                        <?php if (!empty($errors['password'])) : ?>
                            <small class="text-danger"><?= $errors['password'] ?></small>
                        <?php endif; ?>

                    </div>

                    <div class="col-6">
                        <select name="role" class="form-select" required>
                            <option value="" selected disabled>User Role</option>
                            <?php foreach ($roles as $rol) { ?>
                              <option value="<?= $rol->id?>" <?= ($rol->id == $row->role)? 'selected': '' ?> ><?= $rol->role?></option>
                            <?php } ?>

                        </select>
                        <div class="invalid-feedback">Please select user role!</div>
                        <?php if (!empty($errors['role'])) : ?>
                            <small class="text-danger"><?= $errors['role'] ?></small>
                        <?php endif; ?>

                    </div>

                    <div class="col-6">
                        <select name="status" class="form-select" required>
                            <option value="" selected disabled>User Status</option>
                            <option value="pending" <?= ($row->status == 'pending') ? 'selected': ''; ?> >Pending</option>
                            <option value="approved" <?= ($row->status == 'approved') ? 'selected': ''; ?>>Approved</option>
                        </select>
                        <div class="invalid-feedback">Please select user role!</div>
                        <?php if (!empty($errors['status'])) : ?>
                            <small class="text-danger"><?= $errors['status'] ?></small>
                        <?php endif; ?>

                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Save Chnages</button>

                        <a href="<?= ROOT ?>/admin/users">
                            <button type="button" class="btn btn-secondary">Cancel</button>
                        </a>
                    </div>
                </form><!-- End No Labels Form -->
            <?php else : ?>
                <div>That user was not found!</div>
            <?php endif; ?>

        </div>
    </div>

<?php else : ?>

    <div class="card">
        <?php if (!empty($message['success'])) : ?>
            <div class="alert alert-success text-center"><?= $message['success'] ?></div>
        <?php endif; ?>

        <?php if (!empty($message['errors'])) : ?>
            <div class="alert alert-danger text-center"><?= $message['errors'] ?></div>
        <?php endif; ?>

        <div class="card-body">
            <h5 class="card-title">
                All Users
                <a href="<?= ROOT ?>/admin/users/add">
                    <button class="btn btn-primary float-end"><i class="bi bi-camera-video-fill"></i> New User</button>
                </a>
            </h5>

            <!-- Table with stripped rows -->
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Full Name</th>
                        <th scope="col">image</th>
                        <th scope="col">email</th>
                        <th scope="col">Role</th>
                        <th scope="col">Status</th>
                        <th scope="col">Join Date</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>

                <?php if (!empty($rows)) : ?>
                    <tbody>

                        <?php
                        $count = 0;
                        foreach ($rows as $row) : ?>
                            <tr>
                                <th scope="row"><?= ++$count ?></th>
                                <td><?= esc($row->firstname . ' ' . $row->lastname) ?></td>
                                <td><img src="<?= get_image($row->image) ?>" style="width: 100px;height: 100px;object-fit: cover;" /></td>
                                <td><?= esc($row->email ?? 'Unknown') ?></td>
                                <td><?= esc($row->role_name ?? 'Unknown') ?></td>
                                
                                <td>
                                    <?php if($row->status == "approved"){
                                        echo '<span class="bg-success p-2">Approved</span>';
                                     }elseif($row->status == "pending"){
                                        
                                        echo '<span class="bg-warning p-2">Pending</span>';
                                     }else{  echo 'Unknown'; } ?>
                                    
                                </td>
                                <td><?= get_date($row->date) ?></td>
                                <td>
                                    <a href="<?= ROOT ?>/admin/users/edit/<?= $row->id ?>">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <a href="<?= ROOT ?>/admin/users/delete/<?= $row->id ?>">
                                        <i class="bi bi-trash-fill text-danger"></i>
                                    </a>
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