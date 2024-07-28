<?php 

namespace Model;

/**
 * Messages model
 */
class Messages extends Model
{
	
	public $errors = [];
	protected $table = "messages";

	protected $allowedColumns = [

        'message_to',
        'message_from',
        'message',
        'date_time',
		 
	];

	protected $afterSelect = [

	];



	protected function get_message_to($data)
	{

		if(!empty($data))
		{
			
			foreach ($data as $key => $row) {
				$query = "select firstname, lastname, image from users where id = :id limit 1";
				$res = $this->query($query,['id'=>$row->message_from]);
				if($res)
				{
					$data[$key]->msg_from = $res[0];
				}
			}
		}

		return $data;
	}
    protected function get_message_from($data)
	{

		if(!empty($data))
		{
			foreach ($data as $key => $row) {
				
				$query = "select firstname, lastname, image from users where id = :id limit 1";
				$res = $this->query($query,['id'=>$row->message_to]);
				if($res)
				{
					$data[$key]->msg_to = $res[0];
				}
			}
		}

		return $data;
	}

}