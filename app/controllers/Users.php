<?php 

namespace Controller;

/**
 * login class
 */
use Model\Auth;
use Model\User;

class Users extends Controller
{
	
	public function index()
	{
		if (!Auth::logged_in()) {
			message('please login to view the user dashboard');
			redirect('login');
		}

		$data['title'] = "Page not found";

		$this->view('users/404', $data);
	}

	public function students()
	{

		if (!Auth::logged_in()) {
			message('please login to view the admin section');
			redirect('login');
		}


		$data = [];
		$data['message']['errors'] = [];
		$data['message']['success'] = [];

		 $user_id = Auth::getId();
		$users = new \Model\User();
		$course_enroll = new \Model\Course_enroll();
		
		    $query = "select * from course_enrollments where instructor_id = $user_id";
			$data['rows'] = $course_enroll->query($query);
			// show($data['rows']);
			// die;
			
		$data['title'] = "Users";

		$this->view('admin/my-students', $data);
	}

	public function my_chats(){
		$data['title'] = "Users Messages";

		$user_id = Auth::getId();
		$course_enroll = new \Model\Course_enroll();
		
		$query = "select * from course_enrollments where instructor_id = $user_id";
		$data['rows'] = $course_enroll->query($query);
		
		$this->view('admin/chats', $data);
	}
	public function load_messages($id){

		$data['title'] = "Users Messages";

		$user_id = Auth::getId();
		$users =  new \Model\User();
		$messages = new \Model\Messages();
		
		
		$course_enroll = new \Model\Course_enroll();
		
		$query = "select * from course_enrollments where instructor_id = $user_id";
		$data['rows'] = $course_enroll->query($query);

		$query = "select * from messages where (message_from = $user_id AND message_to =$id) OR (message_from =$id AND message_to =$user_id)";
		$data['messages'] = $messages->query($query);
		$data['user_now'] = $users->where(['id'=>$id]); 
		
		$this->view('admin/chats', $data);

	}

	public function post_message(){
		$_POST['message_from'] = Auth::getId();

		
		$messages = new \Model\Messages();
		$messages->insert($_POST);
        $url = 'users/load-messages/'.$_POST['message_to'];
		redirect($url);
	}
	
}