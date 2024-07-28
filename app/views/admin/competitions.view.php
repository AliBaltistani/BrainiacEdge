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

	<div class="card col-md-12 mx-auto">
		<div class="card-body">
			<h5 class="card-title">New Competition</h5>

			<?php if (user_can('add_competitions')) : ?>
				<!-- No Labels Form -->
				<form method="post" class="row g-3" enctype="multipart/form-data">

					<div class="col-md-6">
						<label>Title:</label>
						<input value="<?= set_value('title') ?>" name="title" type="text" class="form-control <?= !empty($errors['title']) ? 'border-danger' : ''; ?>" placeholder="Title name">
						<?php if (!empty($errors['title'])) : ?>
							<small class="text-danger"><?= $errors['title'] ?></small>
						<?php endif; ?>
					</div>

					<div class="col-md-6">
						<label>Google Form Link:</label>
						<input value="<?= set_value('google_form_link') ?>" name="google_form_link" type="text" class="form-control <?= !empty($errors['google_form_link']) ? 'border-danger' : ''; ?>" placeholder="Enter google form link">
						<?php if (!empty($errors['google_form_link'])) : ?>
							<small class="text-danger"><?= $errors['google_form_link'] ?></small>
						<?php endif; ?>
					</div>

					<div class="col-md-6">
						<label>Address:</label>
						<input value="<?= set_value('address') ?>" name="address" type="text" class="form-control <?= !empty($errors['address']) ? 'border-danger' : ''; ?>" placeholder="Enter competition address">
						<?php if (!empty($errors['address'])) : ?>
							<small class="text-danger"><?= $errors['address'] ?></small>
						<?php endif; ?>
					</div>

					<div class="col-md-6">
						<label>Tags:</label>
						<input value="<?= set_value('tags') ?>" name="tags" type="text" class="form-control <?= !empty($errors['tags']) ? 'border-danger' : ''; ?>" placeholder="Enter tags (business plan, case study etc)">
						<?php if (!empty($errors['tags'])) : ?>
							<small class="text-danger"><?= $errors['tags'] ?></small>
						<?php endif; ?>
					</div>

					<div class="col-md-6">
						<label>Start Date:</label>
						<input value="<?= set_value('start_date') ?>" name="start_date" type="date" class="form-control <?= !empty($errors['start_date']) ? 'border-danger' : ''; ?>" placeholder="Start date">
						<?php if (!empty($errors['start_date'])) : ?>
							<small class="text-danger"><?= $errors['start_date'] ?></small>
						<?php endif; ?>
					</div>
					<div class="col-md-6">
						<label>End Date:</label>
						<input value="<?= set_value('end_date') ?>" name="end_date" type="date" class="form-control <?= !empty($errors['end_date']) ? 'border-danger' : ''; ?>" placeholder="End date">
						<?php if (!empty($errors['end_date'])) : ?>
							<small class="text-danger"><?= $errors['end_date'] ?></small>
						<?php endif; ?>
					</div>

					<div class="col-md-6">
						<label>Description:</label>
						<textarea name="description" class="form-control <?= !empty($errors['description']) ? 'border-danger' : ''; ?>" placeholder="Write description here... " cols="30" rows="3"><?= trim(set_value('description') )?></textarea>
						<?php if (!empty($errors['description'])) : ?>
							<small class="text-danger"><?= $errors['description'] ?></small>
						<?php endif; ?>
					
					</div>

					
					<div class="col-md-6">
						<label>Active:</label>
						<select name="disabled" class="form-select">
							<option value="0" selected="">Yes</option>
							<option value="1">No</option>
						</select>
					</div>

					<div class="col-md-12">
						<div class="row">
							<div class="col-sm-4">
								<img id="selectedImage" src="<?=get_image('')?>" class="w-100" height="150">
							</div>
							<div class="col-sm-8">
							<label>Select Image:</label>
								<input value="" name="image" type="file" id="imageInput" accept="image/*" class="form-control <?= !empty($errors['image']) ? 'border-danger' : ''; ?>" placeholder="image name"  >
								<?php if (!empty($errors['image'])) : ?>
									<small class="text-danger"><?= $errors['image'] ?></small><br>
								<?php endif; ?>
								  <small>Upload your Competition image here. It must meet our Competition image quality standards to be accepted. Important guidelines: 750x422 pixels; .jpg, .jpeg,. gif, or .png. no text on the image.</small>
							</div>
						</div>
					</div>



					<div class="text-center">
						<button type="submit" class="btn btn-primary">Save</button>

						<a href="<?= ROOT ?>/admin/categories">
							<button type="button" class="btn btn-secondary">Cancel</button>
						</a>
					</div>
				</form><!-- End No Labels Form -->
			<?php else : ?>
				<div class="alert alert-danger text-center">You dont have permission to perform this action!</div>
				<a href="<?= ROOT ?>/admin/categories">
					<button type="button" class="btn btn-secondary">Back</button>
				</a>
			<?php endif; ?>

		</div>
	</div>

<?php elseif ($action == 'delete') : ?>

	<div class="card">
		<div class="card-body">
			<h5 class="card-title">Delete Competition</h5>

			<?php if (!empty($row)) : ?>

				<?php if (user_can('delete_competition')) : ?>

					<div class="alert alert-danger text-center">Are you sue you want to delete this record?!</div>

					<!-- No Labels Form -->
					<form method="post" class="row g-3">

						<div class="col-md-12">
							<div class="form-control"><?= set_value('title', $row->title) ?></div>
							<?php if (!empty($errors['title'])) : ?>
								<small class="text-danger"><?= $errors['title'] ?></small>
							<?php endif; ?>

						</div>

						<div class="col-md-12">
							<div class="form-control">Active: <?= set_value('disabled', $row->disabled ? 'No' : 'Yes') ?></div>

						</div>

						<div class="text-center">
							<button type="submit" class="btn btn-danger">Delete</button>

							<a href="<?= ROOT ?>/admin/competitions">
								<button type="button" class="btn btn-secondary">Cancel</button>
							</a>
						</div>
					</form><!-- End No Labels Form -->

				<?php else : ?>
					<div class="alert alert-danger text-center">You dont have permission to perform this action!</div>
					<a href="<?= ROOT ?>/admin/competitions">
						<button type="button" class="btn btn-secondary">Back</button>
					</a>
				<?php endif; ?>

			<?php else : ?>
				<div>That course was not found!</div>
			<?php endif; ?>

		</div>
	</div>

<?php elseif ($action == 'edit') : ?>

	<div class="card col-md-12 mx-auto">
		<div class="card-body">
			<h5 class="card-title">Edit Competition</h5>

			<?php if (user_can('edit_competitions')) : ?>
				<!-- No Labels Form -->
				<?php if (!empty($row)) : ?>
					<form method="post" class="row g-3" enctype="multipart/form-data">

						<div class="col-md-6">
							<label>Title:</label>
							<input value="<?= (set_value('title'))?set_value('title'):esc($row->title); ?>" name="title" type="text" class="form-control <?= !empty($errors['title']) ? 'border-danger' : ''; ?>" placeholder="Title name">
							<?php if (!empty($errors['title'])) : ?>
								<small class="text-danger"><?= $errors['title'] ?></small>
							<?php endif; ?>
						</div>

						<div class="col-md-6">
						<label>Google Form Link:</label>
						<input value="<?= (set_value('google_form_link'))?set_value('google_form_link'):esc($row->google_form_link); ?>" name="google_form_link" type="text" class="form-control <?= !empty($errors['google_form_link']) ? 'border-danger' : ''; ?>" placeholder="Enter google form link">
						<?php if (!empty($errors['google_form_link'])) : ?>
							<small class="text-danger"><?= $errors['google_form_link'] ?></small>
						<?php endif; ?>
					</div>

					<div class="col-md-6">
						<label>Address:</label>
						<input value="<?= (set_value('address'))?set_value('address'):esc($row->address); ?>" name="address" type="text" class="form-control <?= !empty($errors['address']) ? 'border-danger' : ''; ?>" placeholder="Enter competition address">
						<?php if (!empty($errors['address'])) : ?>
							<small class="text-danger"><?= $errors['address'] ?></small>
						<?php endif; ?>
					</div>

					<div class="col-md-6">
						<label>Tags:</label>
						<input value="<?= (set_value('tags'))?set_value('tags'):esc($row->tags); ?>" name="tags" type="text" class="form-control <?= !empty($errors['tags']) ? 'border-danger' : ''; ?>" placeholder="Enter tags (business plan, case study etc)">
						<?php if (!empty($errors['tags'])) : ?>
							<small class="text-danger"><?= $errors['tags'] ?></small>
						<?php endif; ?>
					</div>

						<div class="col-md-6">
							<label>Start Date:</label>
							<input value="<?= (set_value('start_date'))?date("Y-m-d", strtotime(set_value('start_date'))):date("Y-m-d", strtotime($row->start_date)); ?>" name="start_date" type="date" class="form-control <?= !empty($errors['start_date']) ? 'border-danger' : ''; ?>" placeholder="Start date">
							<?php if (!empty($errors['start_date'])) : ?>
								<small class="text-danger"><?= $errors['start_date'] ?></small>
							<?php endif; ?>
						</div>
						<div class="col-md-6">
							<label>End Date:</label>
							<input value="<?= (set_value('end_date'))?date("Y-m-d", strtotime(set_value('end_date'))):date("Y-m-d", strtotime($row->end_date)); ?>" name="end_date" type="date" class="form-control <?= !empty($errors['end_date']) ? 'border-danger' : ''; ?>" placeholder="End date">
							<?php if (!empty($errors['end_date'])) : ?>
								<small class="text-danger"><?= $errors['end_date'] ?></small>
							<?php endif; ?>
						</div>

						<div class="col-md-6">
							<label>Description:</label>
							<textarea name="description" class="form-control <?= !empty($errors['description']) ? 'border-danger' : ''; ?>" placeholder="Write description here... " cols="30" rows="3">
							<?= (set_value('description'))?trim(set_value('description')):trim($row->description); ?>
						</textarea>
							<?php if (!empty($errors['description'])) : ?>
								<small class="text-danger"><?= $errors['description'] ?></small>
							<?php endif; ?>
						</div>

						<div class="col-md-6">
							<label>Active:</label>
							<select name="disabled" class="form-select">
								<option <?=($row->disabled == "0")? 'selected':'' ?> value="0" selected="">Yes</option>
								<option <?=($row->disabled == "1")? 'selected':'' ?> value="1">No</option>
							</select>

						</div>

						<div class="col-md-12">
						<div class="row">
							<div class="col-sm-4">
								<img id="selectedImage" src="<?=get_image($row->image)?>" class="w-100" height="150">
							</div>
							<div class="col-sm-8">
							<label>New Image:</label>
								<input value="<?=$row->image?>" name="image" type="file" id="imageInput" accept="image/*" class="form-control <?= !empty($errors['image']) ? 'border-danger' : ''; ?>" placeholder="image name"  >
								<?php if (!empty($errors['image'])) : ?>
									<small class="text-danger"><?= $errors['image'] ?></small><br>
								<?php endif; ?>
								  <small>Upload your Competition image here. It must meet our Competition image quality standards to be accepted. Important guidelines: 750x422 pixels; .jpg, .jpeg,. gif, or .png. no text on the image.</small>
							</div>
						</div>
					</div>

						<div class="text-center">
							<button type="submit" class="btn btn-primary">Save</button>
							<a href="<?= ROOT ?>/admin/competitions">
								<button type="button" class="btn btn-secondary">Cancel</button>
							</a>
						</div>
					</form><!-- End No Labels Form -->
				<?php else : ?>
					<div class="alert alert-danger text-center">No records found...</div>
					<a href="<?= ROOT ?>/admin/competitions">
						<button type="button" class="btn btn-secondary">Back</button>
					</a>
				<?php endif; ?>
			<?php else : ?>
				<div class="alert alert-danger text-center">You dont have permission to perform this action!</div>
				<a href="<?= ROOT ?>/admin/competitions">
					<button type="button" class="btn btn-secondary">Back</button>
				</a>
			<?php endif; ?>

		</div>
	</div>

<?php else : ?>

	<div class="card">

		<div class="card-body">
			<h5 class="card-title">
				Competition
				<?php if (user_can('add_competitions')) : ?>
					<a href="<?= ROOT ?>/admin/competitions/add">
						<button class="btn btn-primary float-end"><i class="bi bi-camera-video-fill"></i> New competition</button>
					</a>
				<?php endif; ?>
			</h5>

			<?php if (user_can('view_competitions')) : ?>

				<!-- Table with stripped rows -->
				<table class="table table-striped">
					<thead>
						<tr>
							<th scope="col">#</th>
							<th scope="col">title</th>
							<th scope="col">Image</th>
							<th scope="col">Description</th>
							<th scope="col">Address</th>
							<th scope="col">Start Date</th>
							<th scope="col">End Date</th>
							<th scope="col">Active</th>
							<th scope="col">Google Form</th>
							<th scope="col">Action</th>
						</tr>
					</thead>

					<?php if (!empty($rows)) : ?>
						<tbody>

							<?php foreach ($rows as $key => $row) : ?>
								<tr>
									<th scope="row"><?= ++$key ?></th>
									<td><?= esc($row->title) ?></td>
									<td><img src="<?= get_image($row->image) ?>" height="50" width="50" srcset=""></td>
									<td><p ><?= substr(esc($row->description),0,50)."..."?></p>
									<?= ($row->tags)?'<span class="badge bg-dark">'.esc($row->tags).'</span>':'' ?>
								   </td>
									 <td><?= substr(esc($row->address),0,20)."..."?></td>
									<td><?= get_date($row->start_date) ?></td>
									<td><?= get_date($row->end_date) ?></td>
									<td><?= esc($row->disabled ? 'No' : 'Yes') ?></td>
									<td><a href="<?= esc($row->google_form_link) ?>">View Form</a></td>
									<td>
										<?php if (user_can('edit_competitions')) : ?>
											<a href="<?= ROOT ?>/admin/competitions/edit/<?= $row->id ?>">
												<i class="bi bi-pencil-square"></i>
											</a>
										<?php endif;
										if (user_can('delete_competitions')) :
										?>
											<a href="<?= ROOT ?>/admin/competitions/delete/<?= $row->id ?>">
												<i class="bi bi-trash-fill text-danger"></i>
											</a>
										<?php endif; ?>
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
			<?php else : ?>
				<div class="alert alert-danger text-center">You dont have permission to perform this action!</div>
			<?php endif; ?>

		</div>
	</div>

<?php endif; ?>

<script>
	// Get references to the input field and the image element
const imageInput = document.getElementById('imageInput');
const selectedImage = document.getElementById('selectedImage');

// Add event listener to input field
imageInput.addEventListener('change', function() {
    const file = this.files[0]; // Get the selected file

    if (file) {
        // Create a FileReader object
        const reader = new FileReader();

        // Set onload event handler
        reader.onload = function() {
            // Set the source of the image element to the data URL
            selectedImage.src = reader.result;
            // Display the image
            selectedImage.style.display = 'block';
        };

        // Read the contents of the file as a data URL
        reader.readAsDataURL(file);
    }
});

</script>

<?php $this->view('admin/admin-footer', $data) ?>