<?php

namespace Controller;

/**
 * login class
 */

use Model\Auth;
use Model\User;

class Login extends Controller
{

	public function index()
	{

		$data['errors'] = [];

		$data['title'] = "Login";
		$user = new User();

		if ($_SERVER['REQUEST_METHOD'] == "POST") {
			//validate
			$row = $user->first([
				'email' => $_POST['email']
			]);

			if ($row) {
				// for only developer mode
				if (password_verify($_POST['password'], $row->password)) {
					//get user role name
					$query = "select role from roles where id = :id limit 1";
					$id = $row->role;

					$role = $user->query($query, ['id' => $id]);

					if ($role) {
						$row->role_name = $role[0]->role;
					} else {
						$row->role_name = '';
					}

					//authenticate
					Auth::authenticate($row);

					// role wise redirects after successfully logged in
					if (strtolower($row->role_name) == "admin") {
						redirect('admin');
					}elseif (strtolower($row->role_name) == "student") {
						redirect('students');
					}elseif(strtolower($row->role_name) == "instructor"){
						redirect('instructors');
					}else {
						redirect('home');
					}
				} else {
					$data['errors']['email'] = "Wrong email or password";
				}
                
				// for Production mode
				// if($row->status == "approved")
				// {
				// 	if(password_verify($_POST['password'], $row->password))
				// 	{
				// 		//get user role name
				// 		$query = "select role from roles where id = :id limit 1";
				// 		$id = $row->role;

				// 		$role = $user->query($query,['id'=>$id]);

				// 		if($role)
				// 		{
				// 			$row->role_name = $role[0]->role;
				// 		}else{
				// 			$row->role_name = '';
				// 		}

				// 		//authenticate
				// 		Auth::authenticate($row);

				// 		// role wise redirects after successfully logged in
					// if (strtolower($row->role_name) == "admin") {
					// 	redirect('admin');
					// }elseif (strtolower($row->role_name) == "student") {
					// 	redirect('students');
					// }elseif(strtolower($row->role_name) == "instructor"){
					// 	redirect('instructors');
					// }else {
					// 	redirect('home');
					// }

				// 	}else{
				// 		$data['errors']['email'] = "Wrong email or password";
				// 	}
				// }else{
				// 	$data['errors']['email'] = "Email verification failed!!!. please verify your email and try again later! thanks  <a href='".ROOT."/signup/verify-email' > Verify now </a>";
				// }

			} else {
				$data['errors']['email'] = "Wrong email or password";
			}
		}

		$this->view('login', $data);
	}
}
