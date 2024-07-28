<?php

namespace Model;

/**
 * course meta model
 */
class Course_meta extends Model
{

	public $errors = [];
	protected $table = "courses_meta";

	protected $afterSelect = [

		'get_lectures',
	];

	protected $beforeUpdate = [];

	protected $allowedColumns = [

		'course_id',
		'tab',
		'uid',
		'data_type',
		'value',
		'description',
		'disabled',

	];

	public function validate($data)
	{
		$this->errors = [];

		if (empty($data['currency'])) {
			$this->errors['currency'] = "A currency is required";
		}

		if (empty($data['symbol'])) {
			$this->errors['symbol'] = "A currency symbol is required";
		}




		if (empty($this->errors)) {
			return true;
		}

		return false;
	}

	protected function get_lectures($rows)
	{

		$db = new \Database();
		if (!empty($rows[0]->uid)) {

			foreach ($rows as $key => $row) {
				if ($row->tab == "curriculum") {
					$query = "select * from courses_lectures where uid = :uid AND disabled = 0 ";
					$curriculum_lecture = $db->query($query, ['uid' => $row->uid]);
					if (!empty($curriculum_lecture)) {
						$rows[$key]->row_lectures = $curriculum_lecture;
					}
				}
			}
		}
		return $rows;
	}
}
