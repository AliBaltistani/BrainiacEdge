<?php 

namespace Model;

/**
 * Reply model
 */
class Comment_reply extends Model
{
	
	public $errors = [];
	protected $table = "comments_reply";

	protected $afterSelect = [
        'get_user',
    ];

	protected $allowedColumns = [

		'id',
		'post_id',
		'comment_id',
		'to_id',
		'from_id',
		'reply_message',
		'read_status',	
	];

	public function validate($data)
	{
		$this->errors = [];

		if(empty($data['post_id']))
		{
			$this->errors['post_id'] = "A Post id is required";
		}
		if(empty($data['comment_id']))
		{
			$this->errors['comment_id'] = "A Comment id is required";
		}
        if(empty($data['to_id']))
		{
			$this->errors['to_id'] = "A User Id is required";
		}
        
        if(empty($data['from_id']))
		{
			$this->errors['from_id'] = "A your Id is required";
		}

        if(empty($data['reply_message']))
		{
			$this->errors['reply_message'] = "A message is required";
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
				
				$query = "select firstname AS fname, lastname AS lname, image AS rpimage, role AS urole from users where id = :id limit 1";
				$user = $db->query($query,['id'=>$row->from_id]);
				if(!empty($user)){
					$user[0]->rpname = $user[0]->fname . ' '. $user[0]->lname;
					$rows[$key]->user_reply = $user[0];
				}
			}
		}

		return $rows;
	}

	
}