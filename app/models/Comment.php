<?php 

namespace Model;

/**
 * Comment model
 */
class Comment extends Model
{
	
	public $errors = [];
	protected $table = "comments";

	protected $afterSelect = [
        'get_user',
    ];

	protected $allowedColumns = [

		'id',
        'post_id',
        'to_id',
        'from_id',
        'message',
        'read_status',	
	];

	public function validate($data)
	{
		$this->errors = [];

		if(empty($data['post_id']))
		{
			$this->errors['post_id'] = "A Post Id is required";
		}
        if(empty($data['to_id']))
		{
			$this->errors['to_id'] = "A User Id is required";
		}
        
        if(empty($data['from_id']))
		{
			$this->errors['from_id'] = "A your Id is required";
		}

        if(empty($data['message']))
		{
			$this->errors['message'] = "A message is required";
		}
 
		if(empty($this->errors))
		{
			return true;
		}

		return false;
	}

    protected function get_user($rows){

		$db = new \Database();
		if(!empty($rows))
		{
			foreach ($rows as $key => $row) {
				
				$query = "select firstname, lastname, image, role from users where id = :id limit 1";
				$user = $db->query($query,['id'=>$row->from_id]);
				if(!empty($user)){

					$user[0]->name = $user[0]->firstname . ' '. $user[0]->lastname;
					$rows[$key]->user_row = $user[0];
				}
			}
		}

		return $rows;
	}

	
}