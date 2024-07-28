<?php 

namespace Model;

/**
 * Course Enroll model
 */
class Course_enroll extends Model
{
	
	public $errors = [];
	protected $table = "course_enrollments";

	protected $afterSelect = [
		'get_users',
        'get_courses',
        'get_instructor',
		'get_progress',
    ];

	protected $allowedColumns = [

		'id',
        'course_id',
        'user_id',
        'instructor_id',
        'status',

	];

	public function validate($data)
	{
		$this->errors = [];

		if(empty($data['course_id']))
		{
			$this->errors['course_id'] = "A Course id is required";
		}
		if(empty($data['user_id']))
		{
			$this->errors['user_id'] = "A user id id is required";
		}
        
        if(empty($data['instructor_id']))
		{
			$this->errors['instructor_id'] = "A Instructor id  is required";
		}
 
		if(empty($this->errors))
		{
			return true;
		}

		return false;
	}

    protected function get_courses($rows){

		$db = new \Database();
		if(!empty($rows))
		{
			foreach ($rows as $key => $row) {
				
				$course = new \Model\Course();
				$course = $course->where(['id'=> $row->course_id]);
				if(!empty($course)){
					$rows[$key]->course_enrolled = $course[0];
				}
			}
		}

		return $rows;
	}
	protected function get_progress($rows){

		$db = new \Database();
		if(!empty($rows))
		{
			foreach ($rows as $key => $row) {
				$query = "select progress,isCompleted from watch_history where user_id = :user_id AND instructor_id = :inst_id AND course_id = :course_id";
				$course_progress = $db->query($query,[
					'user_id'=> $row->user_id,
					'inst_id' => $row->instructor_id,
					'course_id' => $row->course_id
				]);
				if(!empty($course_progress)){
					$rows[$key]->course_progress = $course_progress;
				}
			}
		}

		return $rows;
	}

	protected function get_instructor($rows){

		$db = new \Database();
		if(!empty($rows))
		{
			foreach ($rows as $key => $row) {
				
				$query = "select firstname, lastname, image, email, role from users where id = :id limit 1";
				$user = $db->query($query,['id'=>$row->instructor_id]);
				if(!empty($user)){
					$user[0]->name = $user[0]->firstname . ' '. $user[0]->lastname;
					$rows[$key]->course_instructor = $user[0];
				}
			}
		}

		return $rows;
	}
	protected function get_users($rows){

		$db = new \Database();
		if(!empty($rows))
		{
			foreach ($rows as $key => $row) {
				
				$query = "select firstname, lastname, image, email, role from users where id = :id limit 1";
				$user = $db->query($query,['id'=>$row->user_id]);
				if(!empty($user)){
					$user[0]->name = $user[0]->firstname . ' '. $user[0]->lastname;
					$rows[$key]->instructor_std = $user[0];
				}
			}
		}

		return $rows;
	}

	

	
}