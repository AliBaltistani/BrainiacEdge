<?php 

namespace Controller;

/**
 * 404 class page not found
 */
class _404 extends Controller
{
	
	public function index()
	{
		$data['title'] = "404";

		$this->view('404',$data);
	}

	public function no_access()
	{
		$data['title'] = "404";

		$this->view('admin/no-access',$data);
	}
}