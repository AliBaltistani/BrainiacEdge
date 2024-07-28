<?php

namespace Controller;

/**
 * Students  class
 */

use \Model\Auth;
use Model\Course_enroll;
use \Model\Slider;

class Students extends Controller
{

	public function index()
	{

		if (!Auth::logged_in()) {
			message('please login to continue');
			redirect('login');
		}

		$data['title'] = "Student Area";
		redirect('students/enrolled-courses');
	}

    public function enrolled_courses()
    {

        if(!Auth::logged_in()){
            redirect('login');
        }elseif(!user_can('view_enrolled_courses') ){
            no_access();
        }
         
 
         $course_enroll = new \Model\Course_enroll();
 
         $data = array();
         $data['rows'] = array();
         $data['course_enrolled'] = array();
         $data['course_instructor'] = array();
         $data['course_progress'] = array();
 
         if(Auth::is_admin()){
             $data['rows'] = $course_enroll->findAll();
         }else{
             $data['rows'] = $course_enroll->where(['user_id'=> Auth::getId()]);
         }
 
         $data['title'] = "Enrolled Courses";
         $data['action'] = "";
         $this->view('students/courses-enrolled', $data);

         
    }

	public function profile($id = null)
	{

		if (!Auth::logged_in()) {
			message('please login to continue');
			redirect('login');
		}

		$id = $id ?? Auth::getId();

		$user = new \Model\User();
		$data['row'] = $row = $user->first(['id' => $id]);

		if ($_SERVER['REQUEST_METHOD'] == "POST" && $row) {

			if (isset($_POST['action']) &&  $_POST['action'] == 'change-password') {
				if ($user->password_validate($_POST)) {
					$_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
					$user->update($id, $_POST);
				}
			} else {
				$folder = "uploads/images/";
				if (!file_exists($folder)) {
					mkdir($folder, 0777, true);
					file_put_contents($folder . "index.php", "<?php //silence");
					file_put_contents("uploads/index.php", "<?php //silence");
				}
				if ($user->edit_validate($_POST, $id)) {

					$allowed = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];


					if (!empty($_FILES['image']['name'])) {

						if ($_FILES['image']['error'] == 0) {

							if (in_array($_FILES['image']['type'], $allowed)) {
								//everything good
								$destination = $folder . time() . $_FILES['image']['name'];
								move_uploaded_file($_FILES['image']['tmp_name'], $destination);

								// resize_image($destination);
								$_POST['image'] = $destination;
                                $_SESSION['USER_DATA']->image = $destination;
								if (file_exists($row->image)) {
									unlink($row->image);
								}
							} else {
								$user->errors['image'] = "This file type is not allowed";
							}
						} else {
							$user->errors['image'] = "Could not upload image";
						}
					}

					$user->update($id, $_POST);

					//message("Profile saved successfully");
					//redirect('admin/profile/'.$id);
				}
			}


			if (empty($user->errors)) {
				$arr['message'] = "Profile saved successfully";
			} else {
				$arr['message'] = "Please correct these errors";
				$arr['errors'] = $user->errors;
			}

			echo json_encode($arr);

			die;
		}

		$data['title'] = "My Profile";
		$data['errors'] = $user->errors;

		$this->view('students/profile', $data);
	}

	public function my_carts()
    {
		if(!Auth::logged_in()){
		 redirect('login');
		}
		if(!user_can('view_cart_items')){
			no_access();
		}else{
			$cart_item = new \Model\Cart_item();
			$data['rows'] = $cart_item->where(['user_of_id'=>Auth::getId()]);

			
			$data['title'] = "My Cart";
		    $this->view('students/wishlist', $data);
			
		}
	
	}

    public function delete_wishlist($id){
		
		if(!Auth::logged_in()){
		 redirect('login');
		}elseif(!user_can('delete_cart_items')){
			no_access();
		}

			$cart_item = new \Model\Cart_item();
			$data['rows'] = $cart_item->delete($id);
			redirect('students/my-carts');

	}

	public function delete_enrolled_course(){
		
		if(!user_can('delete_enrolled_courses') || !Auth::logged_in()){
			no_access();
		}elseif(!empty($_REQUEST['cid']) || !empty($_REQUEST['inst_id']) ){
			$course_enroll = new \Model\Course_enroll();
			$watch_history = new \Model\Watch_history();
			$course_enroll->delete($_REQUEST['cid']);

			//Delete all watched lectures by user id , course_id 
			$user_id = Auth::getId();
			$cid = $_REQUEST['cid'];
			$inst_id = $_REQUEST['inst_id'];
			$query = "delete from watch_history where user_id = $user_id and instructor_id = $inst_id and course_id = $cid";
			$data['delete'] = $watch_history->query($query);
		}
		redirect('students/enrolled-courses');
	}

	// public function course_buy(){
	// 	show($_POST);
    //     die;

	// 	if(!Auth::logged_in()){
	// 	 redirect('login');
	// 	}
	// 		$cart_item = new \Model\Cart_item();
	// 		$course_enroll = new \Model\Course_enroll();
	// 		$data['rows'] = $cart_item->where(['user_of_id'=> Auth::getId()]);
	// 		if($data['rows']){
	// 			foreach($data['rows'] as $row){
	// 				$arr['course_id'] = $row->course_id;
	// 				$arr['user_id'] = Auth::getId();
	// 				$arr['instructor_id'] = $row->user_to_id;

	// 				$data['res'] = $course_enroll->where($arr);
	// 				if(empty($data['res'])){
	// 					$course_enroll->insert($arr);
	// 				}
	// 			}

	// 		$user_id = Auth::getId();
	// 			//red all courses order by Popular value
	// 		$query = "delete from cart_items where user_of_id = $user_id";
	// 		$data['delete'] = $cart_item->query($query);
	// 		}
	// 		redirect('students/my-carts');
	
	// }

	public function course_buy($slug = null)
	{

		$course_enroll = new \Model\Course_enroll();
		$cart_item = new \Model\Cart_item();

		if ($_SERVER['REQUEST_METHOD'] == "POST") {
			if (!(Auth::logged_in())) {
				redirect('login');
			} else {
				$total_items = count($_POST);
				for($i=0; $i<$total_items; $i++){
					$cid = $_POST['id-'.$i]; 
					$res['records'] = $cart_item->where(['id'=>$cid])[0] ?? '';
					if(!empty($res['records'])){
						$data['course_id'] =  $res['records']->course_id;
						$data['user_id'] = Auth::getId();
						$data['instructor_id'] = $res['records']->user_to_id;
						$course_enroll->insert($data);
						$cart_item->delete($res['records']->id);
					}
				}
			}
		}

		redirect('students/my-carts');
	}

}
