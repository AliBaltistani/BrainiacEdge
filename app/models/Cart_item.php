<?php 

namespace Model;

/**
 * Cart item model
 */
class Cart_item extends Model
{
	
	public $errors = [];
	protected $table = "cart_items";

	protected $afterSelect = [
        'get_instructor',
		'get_courses',
    ];

	protected $allowedColumns = [

		'id',
        'course_id',
        'user_to_id',
        'user_of_id',
        'course_title',
        'course_price',
        'user_name',	
	];

	public function validate($data)
	{
		$this->errors = [];

		if(empty($data['course_id']))
		{
			$this->errors['course_id'] = "A Course id is required";
		}
		if(empty($data['user_to_id']))
		{
			$this->errors['user_to_id'] = "A user to_id id is required";
		}
        if(empty($data['user_of_id']))
		{
			$this->errors['user_of_id'] = "A user of_id is required";
		}
        
        if(empty($data['course_title']))
		{
			$this->errors['course_title'] = "A Course title  is required";
		}

        if(empty($data['course_price']))
		{
			$this->errors['course_price'] = "A course price is required";
		}

        if(empty($data['user_name']))
		{
			$this->errors['user_name'] = "A user name is required";
		}
 
		if(empty($this->errors))
		{
			return true;
		}

		return false;
	}

    protected function get_instructor($rows){

		$db = new \Database();
		if(!empty($rows))
		{
			foreach ($rows as $key => $row) {
				
				$query = "select firstname AS fname, lastname AS lname, image AS rpimage, role AS urole from users where id = :id limit 1";
				$user = $db->query($query,['id'=>$row->user_to_id]);
				if(!empty($user)){
					$user[0]->rpname = $user[0]->fname . ' '. $user[0]->lname;
					$rows[$key]->instructor_now = $user[0];
				}
			}
		}

		return $rows;
	}

	
	protected function get_courses($rows){

		$db = new \Database();
		if(!empty($rows))
		{
			foreach ($rows as $key => $row) {
				
				$query = "select title, subtitle, course_image  from courses where id = :id limit 1";
				$course = $db->query($query,['id'=>$row->course_id]);
				if(!empty($course)){
					$rows[$key]->course_now = $course[0];
				}
			}
		}

		return $rows;
	}

	
}