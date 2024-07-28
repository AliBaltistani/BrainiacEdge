<?php

namespace Controller;

if(!defined("ROOT")) die ("direct script access denied");

/**
 * Competitions class
 */

class Competitions extends Controller
{
	
	public function index($slug = null)
	{

		$competition = new \Model\Competition();
		$course = new \Model\Course();
		$data['row'] = $competition->where(['slug'=>$slug])[0]?? '';
		if(!empty($data['row'])){
			$views = $data['row']->views + 1;
			$competition->update($data['row']->id,['views'=>$views]);
		}

		//reed all courses order by trending value
		$query = "select * from courses where approved != 0 order by trending desc limit 5";
		$data['trending'] = $course->query($query);

		//reed all courses order by Popular value
		$query = "select * from courses where approved != 0 order by views desc limit 5";
		$data['populars'] = $course->query($query);

		//reed all Comments order by Post id 
		// $data['cart_item'] = $cart_item->where(['course_id' => $data['row']->id, 'user_of_id' => Auth::getId()]);
		// $data['buy_item'] = $course_enroll->where(['course_id' => $data['row']->id, 'user_id' => Auth::getId()]);

		// show($data);
		// die;
		$this->view('competitions',$data);
	}

	public function all(){

		
		$competition = new \Model\Competition();
		$course = new \Model\Course();
		$data['competitions'] = $competition->findAll();
		

		//reed all courses order by trending value
		$query = "select * from courses where approved != 0 order by trending desc limit 5";
		$data['trending'] = $course->query($query);

		//reed all courses order by Popular value
		$query = "select * from courses where approved != 0 order by views desc limit 5";
		$data['populars'] = $course->query($query);

		//reed all Comments order by Post id 
		// $data['cart_item'] = $cart_item->where(['course_id' => $data['row']->id, 'user_of_id' => Auth::getId()]);
		// $data['buy_item'] = $course_enroll->where(['course_id' => $data['row']->id, 'user_id' => Auth::getId()]);

		// show($data);
		// die;
		$this->view('competitions-all',$data);
	}
	
}