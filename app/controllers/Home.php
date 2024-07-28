<?php

namespace Controller;

if(!defined("ROOT")) die ("direct script access denied");

/**
 * home class
 */
use \Model\Slider;

class Home extends Controller
{
	
	public function index()
	{

		$course = new \Model\Course();
		$competition = new \Model\Competition();

		$data['title'] = "Home";

		//read all courses 
		$data['rows'] = $course->where(['approved'=>1, 'published' =>1],'desc',7);
		$data['category_row'] = $course->where(['approved'=>1, 'published' =>1],'desc',100);

		//read all competitions
		$data['competitions'] = $competition->where(['disabled'=>0],'desc',10);
		
		//load slider images
		$slider = new Slider();
		$slider->order = 'asc';
		$data['images'] = $slider->where(['disabled'=>0]);
		
		// show($data['competitions']);
		// die;
		$this->view('home',$data);
	}
	
}