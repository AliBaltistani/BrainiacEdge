<?php 

namespace Model;

/**
 * Competition model
 */
class Competition extends Model
{
	
	public $errors = [];
	protected $table = "competitions";

	protected $allowedColumns = [
		
		'title',
		'slug',
		'description',
		'image',
		'start_date',
		'end_date',
		'google_form_link',
		'tags',
		'address',
		'views',
		'disabled'
		 
	];

	public function validate($data)
	{
		$this->errors = [];

		if(empty($data['title']))
		{
			$this->errors['title'] = "A Title is required";
		}
		if(empty($data['description']))
		{
			$this->errors['description'] = "A Description is required";
		}
		if(empty($data['address']))
		{
			$this->errors['address'] = "A address is required";
		}
		if(empty($_FILES['image']['name']))
		{
			$this->errors['image'] = "A image is required";
		}elseif($this->validate_image() != ""){
				$this->errors['image'] = $this->validate_image();
		}
		if(empty($data['description']))
		{
			$this->errors['description'] = "A Description is required";
		}
		if(empty($data['start_date']))
		{
			$this->errors['start_date'] = "A Start Date is required";
		}
		if(empty($data['end_date']))
		{
			$this->errors['end_date'] = "A End Date is required";
		}

		if(empty($data['google_form_link']))
		{
			$this->errors['google_form_link'] = "A Google Form Link is required";
		}
        elseif(!empty($data['google_form_link']))
		{
			if(!filter_var($data['google_form_link'],FILTER_VALIDATE_URL))
			{
				$this->errors['google_form_link'] = "A Google Form Link is not valid";
			}
		}
        
		
		if(empty($this->errors))
		{
			
			return true;
		}

		return false;
	}
	public function validate_edit($data)
	{
		$this->errors = [];

		if(empty($data['title']))
		{
			$this->errors['title'] = "A Title is required";
		}
		if(empty($data['description']))
		{
			$this->errors['description'] = "A Description is required";
		}
		if(empty($data['address']))
		{
			$this->errors['address'] = "A address is required";
		}
		

		if(empty($data['description']))
		{
			$this->errors['description'] = "A Description is required";
		}
		if(empty($data['start_date']))
		{
			$this->errors['start_date'] = "A Start Date is required";
		}
		if(empty($data['end_date']))
		{
			$this->errors['end_date'] = "A End Date is required";
		}

		if(empty($data['google_form_link']))
		{
			$this->errors['google_form_link'] = "A Google Form Link is required";
		}
        elseif(!empty($data['google_form_link']))
		{
			if(!filter_var($data['google_form_link'],FILTER_VALIDATE_URL))
			{
				$this->errors['google_form_link'] = "A Google Form Link is not valid";
			}
		}
        
		
		if(empty($this->errors))
		{
			
			return true;
		}

		return false;
	}

	public function validate_image()
	{
		$res = '';
		// Check if the form was submitted
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			// Check if file was uploaded without errors
			if (isset($_FILES["image"]) && $_FILES["image"]["error"] == 0) {
				$targetDir = "uploads/"; // Directory where the file will be stored
				$targetFile = $targetDir . basename($_FILES["image"]["name"]); // Get the file name
				// Check if the file is an actual image
				$check = getimagesize($_FILES["image"]["tmp_name"]);
				if ($check !== false) {
					// Check file size (max 5MB)
					if ($_FILES["image"]["size"] > 5 * 1024 * 1024) {
						$res = "Sorry, your file is too large. (image < 5MB)";
					} else {
						// Allow only certain file formats
						$allowedTypes = array("jpg", "jpeg", "png", "gif");
						$fileExtension = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
						if (!in_array($fileExtension, $allowedTypes)) {
							$res = "Sorry, only JPG, JPEG, PNG, and GIF files are allowed.";
						} else {
							// If everything is ok, try to upload the file
							$res = '';
						}
					}
				} else {
					$res =  "File is not an image.";
				}
			} else {
				$res =  "A Image is requried.";
			}
		}

		return $res;
	}


}