<?php 

namespace Model;

/**
 * Watch history model
 */
class Watch_history extends Model
{
	
	public $errors = [];
	protected $table = "Watch_history";

	protected $afterSelect = [
        'get_instructor',
		'get_lectures',
		'get_courses',
    ];

	protected $allowedColumns = [

		'user_id',
        'instructor_id',
        'course_id',
        'lecture_id',
        'progress',
        'isCompleted'	

		 
	];

	public function validate($data)
	{
		$this->errors = [];

		if(empty($data['user_id']))
		{
			$this->errors['user_id'] = "A user id is required";
		}

		if(empty($data['instructor_id']))
		{
			$this->errors['instructor_id'] = "A instructor id is required";
		}
		if(empty($data['course_id']))
		{
			$this->errors['course_id'] = "A course id is required";
		}
		if(empty($data['lecture_id']))
		{
			$this->errors['lecture_id'] = "A lecture id is required";
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
				
				$query = "select firstname, lastname, image, role from users where id = :id limit 1";
				$user = $db->query($query,['id'=>$row->instructor_id]);
				if(!empty($user)){
					$user[0]->name = $user[0]->firstname . ' '. $user[0]->lastname;
					$rows[$key]->course_instructor = $user[0];
				}
			}
		}

		return $rows;
	}

	protected function get_lectures($rows){

		$db = new \Database();
		if(!empty($rows))
		{
			foreach ($rows as $key => $row) {
				
				$query = "select * from courses_lectures where id = :id limit 1";
				$user = $db->query($query,['id'=>$row->lecture_id]);
				if(!empty($user)){
					$rows[$key]->course_lectures = $user[0];
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
				$query = "select title from courses where id = :id limit 1";
				$course = $db->query($query,['id'=>$row->course_id]);
				if(!empty($course)){
					$rows[$key]->course_now = $course[0];
				}
			}
		}

		return $rows;
	}


}