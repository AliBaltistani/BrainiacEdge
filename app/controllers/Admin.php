<?php

namespace Controller;

/**
 * admin class
 */

use \Model\Auth;
use Model\Course_enroll;
use \Model\Slider;

class Admin extends Controller
{

	public function index()
	{

		if (!Auth::logged_in()) {
			message('please login to view the admin section');
			redirect('login');
		}

		$data['title'] = "Admin Dashboard";
		redirect('admin/dashboard');
		// $this->view('admin/404', $data);
	}

	public function dashboard()
	{
		if (strtolower(Auth::getRole_name()) == 'student') {
			redirect('admin/lessons');
		}

		if (!Auth::logged_in()) {
			message('please login to view the admin section');
			redirect('login');
		}

		$course = new \Model\Course();
		$users = new \Model\User();
		$course_enroll = new \Model\Course_enroll();

		if (Auth::is_admin()) {

			$data['sales'] = $course_enroll->findAll();
			$data['users'] = $users->findAll();
			$data['courses'] = $course->findAll();
		} else {
			$data['sales'] = $course_enroll->where(['instructor_id' => Auth::getId()]);
			$data['users'] = $users->where(['id' => Auth::getId()]);
			$data['courses'] = $course->where(['user_id' => Auth::getId()]);
		}

		$data['title'] = "Dashboard";

		$this->view('admin/dashboard', $data);
	}

	public function users($action = null, $id = null)
	{

		if (!Auth::logged_in()) {
			message('please login to view the admin section');
			redirect('login');
		}


		$data = [];
		$data['message']['errors'] = [];
		$data['message']['success'] = [];

		$user_id = Auth::getId();
		$data['action'] = $action;
		$data['id'] = $id;

		$users = new \Model\User();
		$roles = new \Model\Role();

		if ($action == 'add') {

			$data['roles'] = $roles->findAll('asc');

			if ($_SERVER['REQUEST_METHOD'] == "POST") {

				$_POST['terms'] = '1';
				if ($users->validate($_POST)) {
					$_POST['date'] = date("Y-m-d H:i:s");
					$_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);

					$users->insert($_POST);
					message("New user has been successfuly created.");
					redirect('admin/users');
				} else {
					$data['errors'] = $users->errors;
				}
			}
		} elseif ($action == 'delete') {
			//get user information
			$data['row'] = $row = $users->first(['id' => $id]);
			if ($_SERVER['REQUEST_METHOD'] == "POST" && $row) {

				$users->delete($row->id);
				message("User deleted successfully");
				redirect('admin/users');
			}
		} elseif ($action == 'edit') {
			//get user information
			$data['row'] = $row = $users->first(['id' => $id]);
			$data['roles'] = $roles->findAll('asc');

			if ($_SERVER['REQUEST_METHOD'] == "POST") {

				$_POST['date'] = date("Y-m-d H:i:s");
				if (!empty($_POST['password'])) {
					if ($users->password_validate($_POST)) {
						$_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
					} else {
						$data['errors'] = $users->errors;
						$this->view('admin/users', $data);
					}
				} else {
					unset($_POST['password']);
					unset($_POST['retype_password']);
				}

				$users->update($id, $_POST);
				message("user data updated successfuly.");
				redirect('admin/users');
			}
		} else {
			if (Auth::is_admin()) {
				$data['rows'] = $users->findAll();
			} else {
				$data['rows'] = $users->where(['id' => $user_id]);
			}
		}

		$data['title'] = "Users";

		$this->view('admin/users', $data);
	}

	public function courses($action = null, $id = null)
	{
		// show($_POST);
		// die;

		if (!Auth::logged_in()) {
			message('please login to view the admin section');
			redirect('login');
		}
		if (!user_can('view_courses')) {
			redirect('_404/no-access');
		}

		$user_id = Auth::getId();
		$course = new \Model\Course();
		$category = new \Model\Category();
		$language = new \Model\Language_model();
		$level = new \Model\Level_model();
		$price = new \Model\Price_model();
		$currency = new \Model\Currency_model();

		$data = [];
		$data['action'] = $action;
		$data['id'] = $id;

		if ($_SERVER['REQUEST_METHOD'] == "POST" && $_POST['data_type'] == "change-status") {
			$course->update($_POST['course_id'], $_POST);
			message("Course Update successfully");
			// redirect('admin/courses');
		}
		if ($action == 'add') {

			if (!user_can('add_courses')) {
				redirect('_404/no-access');
			}

			$data['categories'] = $category->findAll('asc');

			if ($_SERVER['REQUEST_METHOD'] == "POST") {

				if ($course->validate($_POST)) {

					$_POST['slug'] = generate_slug($_POST['title']);
					$_POST['date'] = date("Y-m-d H:i:s");
					$_POST['user_id'] = $user_id;
					$_POST['price_id'] = 1;

					$course->insert($_POST);

					$row = $course->first(['user_id' => $user_id, 'published' => 0]);
					message("Your Course was successfuly created");
					if ($row) {
						redirect('admin/courses/edit/' . $row->id);
					} else {
						redirect('admin/courses');
					}
				}

				$data['errors'] = $course->errors;
			}
		} elseif ($action == 'delete') {
			if (!user_can('delete_courses')) {
				redirect('_404/no-access');
			}

			$categories = $category->findAll('asc');
			$languages = $language->findAll('asc');
			$levels = $level->findAll('asc');
			$prices = $price->findAll('asc');
			$currencies = $currency->findAll('asc');


			//get course information
			$data['row'] = $row = $course->first(['id' => $id]);


			if ($_SERVER['REQUEST_METHOD'] == "POST" && $row) {

				$course->delete($row->id);
				message("Course deleted successfully");
				redirect('admin/courses');
			}
		} elseif ($action == 'edit') {
			if (!user_can('edit_courses')) {
				redirect('_404/no-access');
			}

			$categories = $category->findAll('asc');
			$languages = $language->findAll('asc');
			$levels = $level->findAll('asc');
			$prices = $price->findAll('asc');
			$currencies = $currency->findAll('asc');


			//get course information
			$data['row'] = $row = $course->first(['id' => $id]);
			// $data['row']->user_row->uid = $user_id;

			if ($_SERVER['REQUEST_METHOD'] == "POST" && $row) {


				// show($_POST);
				// die;
				if (!empty($_POST['data_type']) && $_POST['data_type'] == "read") {

					if ($_POST['tab_name'] == "course-landing-page") {
						include views_path('course-edit-tabs/course-landing-page');
					} else
						if ($_POST['tab_name'] == "course-messages") {

						include views_path('course-edit-tabs/course-messages');
					} else
						if ($_POST['tab_name'] == "intended-learners") {

						include views_path('course-edit-tabs/intended-learners');
					} else
						if ($_POST['tab_name'] == "curriculum") {

						include views_path('course-edit-tabs/curriculum');
					}
				} else if (!empty($_POST['data_type']) && $_POST['data_type'] == "get-meta") {
					// show($rows);
					// die;
					//get meta data for inputs on the tab
					$course_meta = new \Model\Course_meta();

					$rows = $course_meta->where(['course_id' => $_POST['course_id'], 'disabled' => 0]);

					$info['data'] = [];
					if ($rows) {
						$course_lecture = new \Model\Course_lecture;
						foreach ($rows as $akey => $course_meta_row) {

							$row_lectures = $course_lecture->where(['uid' => $course_meta_row->uid, 'disabled' => 0]);

							if ($row_lectures) {
								foreach ($row_lectures as $zkey => $zrow) {
									$row_lectures[$zkey]->base_file = $zrow->file;
									$row_lectures[$zkey]->file = get_video($zrow->file);
								}

								$rows[$akey]->lectures = $row_lectures;
							}
						}

						$info['data'] = $rows;
					}
					$info['data_type'] = "get-meta";

					echo json_encode($info);
				} else if (!empty($_POST['data_type']) && $_POST['data_type'] == "save") {

					//check if form is valid
					if ($_SESSION['csrf_code'] == $_POST['csrf_code']) {

						if ($course->edit_validate($_POST, $id, $_POST['tab_name'])) {

							if ($_POST['tab_name'] == "intended-learners") {

								$course_meta = new \Model\Course_meta();

								$meta_data = [];
								foreach ($_POST as $key => $value) {

									if (!empty($value) && preg_match("/^[a-zA-Z\-]+_[0-9]+$/", $key)) {
										$key = preg_replace("/_[0-9]+$/", "", $key);
										$meta_data[$key][] = $value;
									}
								}

								//disabled all records from this course id
								$old_records = $course_meta->where(['course_id' => $id, 'tab' => $_POST['tab_name']]);
								$old_ids = [];
								if ($old_records) {


									$old_ids = array_column($old_records, 'id');

									foreach ($old_records as $record) {

										$course_meta->update($record->id, ['disabled' => 1]);
									}
								}

								if (!empty($meta_data)) {

									foreach ($meta_data as $key => $rows) {

										$data_type = $key;
										foreach ($rows as $value) {


											$arr = [];
											$arr['data_type'] 	= $data_type;
											$arr['course_id'] 	= $id;
											$arr['value'] 		= $value;
											$arr['disabled'] 	= 0;
											$arr['tab'] 		= $_POST['tab_name'];
											// $arr['uid'] 		= $_POST['uid'];
											// show($arr);
											// show($arr);
											// show($old_ids);
											// die;
											if (count($old_ids) > 0) {
												$my_old_id = array_pop($old_ids);
												$course_meta->update($my_old_id, $arr);
											} else {

												$arr['uid'] = time() . rand(100, 999);

												while ($course_meta->where(['uid' => $arr['uid']])) {
													$arr['uid'] = time() . rand(100, 999);
												}

												$course_meta->insert($arr);
											}
										}
									}
								}

								$info['data'] = "Course saved successfully";
								$info['data_type'] = "save";
							} else
								if ($_POST['tab_name'] == "curriculum") {

								$course_meta = new \Model\Course_meta();
								$course_lecture = new \Model\Course_lecture;

								$meta_data = [];
								$meta_data_uids = [];
								$meta_data_descriptions = [];
								$meta_data_index = [];

								$lecture_data = [];
								$lecture_data_uids = [];
								$lecture_data_descriptions = [];
								$lecture_data_files = [];
								$lecture_data_new_files = [];
								$lecture_data_index = [];

								foreach ($_POST as $key => $value) {

									/** for sections **/
									if (!empty($value) && preg_match("/^curriculum_[0-9]+$/", $key)) {
										$mainkey = preg_replace("/_[0-9]+$/", "", $key);
										$subkey = preg_replace("/^curriculum_/", "", $key);
										$meta_data[$mainkey][$subkey] = $value;
									} else

										if (!empty($value) && preg_match("/^uid_curriculum_[0-9]+$/", $key)) {
										$mainkey = preg_replace("/_[0-9]+$/", "", $key);
										$subkey = preg_replace("/^uid_curriculum_/", "", $key);
										$meta_data_uids[$mainkey][$subkey] = $value;
									} else

										if (!empty($value) && preg_match("/^description_curriculum_[0-9]+$/", $key)) {
										$mainkey = preg_replace("/_[0-9]+$/", "", $key);
										$subkey = preg_replace("/^description_curriculum_/", "", $key);
										$meta_data_descriptions[$mainkey][$subkey] = $value;
									}

									/** for lectures **/
									if (preg_match("/^lecture_[0-9]+_curriculum_[0-9]+$/", $key)) {
										$key = preg_replace("/^lecture_[0-9]+_curriculum_/", "", $key);
										$lecture_data[$key][] = $value;
									}

									if (preg_match("/^description_lecture_[0-9]+_curriculum_[0-9]+$/", $key)) {
										$key = preg_replace("/^description_lecture_[0-9]+_curriculum_/", "", $key);
										$lecture_data_descriptions[$key][] = $value;
									}

									if (preg_match("/^file_lecture_[0-9]+_curriculum_[0-9]+$/", $key)) {
										$key = preg_replace("/^file_lecture_[0-9]+_curriculum_/", "", $key);
										$lecture_data_files[$key][] = $value;
										$lecture_data_new_files[$key][] = "";

										//check for new video files
										foreach ($_FILES as $newkey => $file) {

											if (preg_match("/^new_file_lecture_[0-9]+_curriculum_{$key}$/", $newkey)) {

												$filename = "";
												$folder = "uploads/courses/";
												if (!file_exists($folder)) {
													mkdir($folder, 0777, true);
												}

												if (!empty($file['name'])) {

													$filename = $folder . time() . $file['name'];
													move_uploaded_file($file['tmp_name'], $filename);
												}

												$thiskey = str_replace(['new_file_lecture_', '_curriculum_' . $key], "", $newkey);
												$lecture_data_new_files[$key][$thiskey] = $filename;
											}
										}
									}
								}


								//disabled all records from this course lectures
								// if(empty($lecture_data_new_files)){

								// $old_records = $course_lecture->where(['uid' => $id, 'tab' => $_POST['tab_name']]);
								// $old_ids = [];

								// if ($old_records) {
								// 	$old_ids = array_column($old_records, 'id');

								// 	foreach ($old_records as $record) {

								// 		$course_meta->update($record->id, ['disabled' => 1]);
								// 	}
								// }
								// }

								//disabled all records from this course id
								$old_records = $course_meta->where(['course_id' => $id, 'tab' => $_POST['tab_name']]);
								$old_ids = [];
								if ($old_records) {
									$old_ids = array_column($old_records, 'id');

									foreach ($old_records as $record) {

										$course_meta->update($record->id, ['disabled' => 1]);
									}
								}


								if (!empty($meta_data)) {

									foreach ($meta_data as $key => $rows) {

										$data_type = $key;

										foreach ($rows as $key2 => $value) {


											$arr = [];
											$arr['data_type'] 	= $data_type;
											$arr['course_id'] 	= $id;
											$arr['value'] 		= $value;
											$arr['disabled'] 	= 0;
											$arr['tab'] 		= $_POST['tab_name'];

											if (!empty($meta_data_uids['uid_' . $key][$key2]))
												$arr['uid'] 		= $meta_data_uids['uid_' . $key][$key2];

											if (!empty($meta_data_descriptions['description_' . $key][$key2]))
												$arr['description'] = $meta_data_descriptions['description_' . $key][$key2];


											if (count($old_ids) > 0) {
												$my_old_id = array_pop($old_ids);
												$course_meta->update($my_old_id, $arr);
											} else {

												$arr['uid'] = time() . rand(100, 999);

												while ($course_meta->where(['uid' => $arr['uid']])) {
													$arr['uid'] = time() . rand(100, 999);
												}
												$course_meta->insert($arr);
											}

											/** save to lectures table **/
											if (!empty($lecture_data[$key2])) {

												$myuid = $arr['uid'] ?? time() . rand(100, 999);;

												//disabled all records from this course lectures table
												$old_lecture_records = $course_lecture->where(['uid' => $myuid]);
												$old_lecture_ids = [];
												if ($old_lecture_records) {
													$old_lecture_ids = array_column($old_lecture_records, 'id');
													$old_lecture_files = array_column($old_lecture_records, 'file');

													foreach ($old_lecture_records as $record) {

														$course_lecture->update($record->id, ['disabled' => 1]);
													}
												}


												foreach ($lecture_data[$key2] as $key3 => $lec_title) {

													$arr = [];
													$arr['uid'] = $myuid;
													$arr['disabled'] = 0;
													$arr['title'] = $lec_title;
													$arr['description'] = $lecture_data_descriptions[$key2][$key3] ?? "";
													$arr['file'] = $lecture_data_new_files[$key2][$key3] ?? "";

													$delete_old_file = false;
													$old_filename = "";
													if (empty($arr['file'])) {
														$arr['file'] = $lecture_data_files[$key2][$key3] ?? "";
													} else {
														$delete_old_file = true;
														$old_filename = $lecture_data_files[$key2][$key3] ?? "";
													}

													if (count($old_lecture_ids) > 0) {
														$my_old_lecture_id = array_pop($old_lecture_ids);
														$course_lecture->update($my_old_lecture_id, $arr);

														//delete old video files if any
														if ($delete_old_file && file_exists($old_filename))
															unlink($old_filename);
													} else {

														$course_lecture->insert($arr);
													}
												}
											}
										}
									}
								}

								$info['data'] = "Course saved successfully";
								$info['data_type'] = "save";
							} else if ($_POST['tab_name'] == "course-landing-page") {

								//check if a temp image exists
								if ($row->course_image_tmp != "" && file_exists($row->course_image_tmp) && $row->csrf_code == $_POST['csrf_code']) {
									//delete currect course image
									if (file_exists($row->course_image)) {
										unlink($row->course_image);
									}

									$_POST['course_image'] = $row->course_image_tmp;
									$_POST['course_image_tmp'] = "";
								}


								$course->update($id, $_POST);

								$info['data'] = "Course saved successfully";
								$info['data_type'] = "save";
							} else if ($_POST['tab_name'] == "course-messages") {

								$course->update($id, $_POST);

								$info['data'] = "Course saved successfully";
								$info['data_type'] = "save";
							}
						} else {

							$info['errors'] = $course->errors;
							$info['data'] = "Please fix the errors";
							$info['data_type'] = "save";
						}
					} else {

						$info['errors'] = ['key' => 'value'];
						$info['data'] = "This form is not valid";
						$info['data_type'] = $_POST['data_type'];
					}


					echo json_encode($info);
				} else
					if (!empty($_POST['data_type']) && $_POST['data_type'] == "upload_course_image") {

					$folder = "uploads/courses/";
					if (!file_exists($folder)) {
						mkdir($folder, 0777, true);
					}

					$errors = [];
					if (!empty($_FILES['image']['name'])) {

						$destination = $folder . time() . $_FILES['image']['name'];
						move_uploaded_file($_FILES['image']['tmp_name'], $destination);

						//delete old temp file
						if (file_exists($row->course_image_tmp)) {
							unlink($row->course_image_tmp);
						}

						$course->update($id, ['course_image_tmp' => $destination, 'csrf_code' => $_POST['csrf_code']]);
					}
					//show($_POST);
					//show($_FILES);

				} else if (!empty($_POST['data_type']) && $_POST['data_type'] == "upload_course_video") {

					$folder = "uploads/courses/";
					if (!file_exists($folder)) {
						mkdir($folder, 0777, true);
					}

					$errors = [];
					if (!empty($_FILES['video']['name'])) {

						$destination = $folder . time() . $_FILES['video']['name'];
						move_uploaded_file($_FILES['video']['tmp_name'], $destination);

						//delete old temp file
						if (file_exists($row->course_promo_video)) {
							unlink($row->course_promo_video);
						}

						$course->update($id, ['course_promo_video' => $destination, 'csrf_code' => $_POST['csrf_code']]);
					}
					//show($_POST);
					//show($_FILES);

				}

				die;
			}
		} else {

			if (Auth::is_admin()) {
				$data['rows'] = $course->findAll();
			} else {
				$data['rows'] = $course->where(['user_id' => $user_id]);
			}
			//courses view
			// $data['rows'] = $course->where(['user_id' => $user_id]);
		}

		$this->view('admin/courses', $data);
	}

	public function categories($action = null, $id = null)
	{

		if (!Auth::logged_in()) {
			message('please login to view the admin section');
			redirect('login');
		}

		$user_id = Auth::getId();
		$category = new \Model\Category();

		$data = [];
		$data['action'] = $action;
		$data['id'] = $id;

		if ($action == 'add') {


			if ($_SERVER['REQUEST_METHOD'] == "POST") {
				if (user_can('add_categories')) {
					if ($category->validate($_POST)) {

						$_POST['slug'] = str_to_url($_POST['category']);
						$category->insert($_POST);
						message("Your category was successfuly created");
						redirect('admin/categories');
					}
				} else {
					$category->errors['category'] = "You are not allowed to perform this action";
				}

				$data['errors'] = $category->errors;
			}
		} elseif ($action == 'delete') {

			//get category information
			$data['row'] = $row = $category->first(['id' => $id]);

			if ($_SERVER['REQUEST_METHOD'] == "POST" && $row) {


				$category->delete($row->id);
				message("Your category was successfuly edited");
				redirect('admin/categories');

				$data['errors'] = $category->errors;
			}
		} elseif ($action == 'edit') {

			//get category information
			$data['row'] = $row = $category->first(['id' => $id]);

			if ($_SERVER['REQUEST_METHOD'] == "POST" && $row) {
				if ($category->validate($_POST)) {

					$category->update($row->id, $_POST);
					message("Your category was successfuly edited");
					redirect('admin/categories');
				}

				$data['errors'] = $category->errors;
			}
		} else {

			//courses view
			if (Auth::is_admin()) {
				$data['rows'] = $category->findAll();
			} else {
				$data['rows'] = $category->where(['id' => $user_id]);
			}
			// $data['rows'] = $category->findAll();
		}

		$this->view('admin/categories', $data);
	}

	public function roles($action = null, $id = null)
	{

		if (!Auth::logged_in()) {
			message('please login to view the admin section');
			redirect('login');
		}

		$user_id = Auth::getId();
		$role = new \Model\Role();

		$data = [];
		$data['action'] = $action;
		$data['id'] = $id;

		if ($action == 'add') {


			if ($_SERVER['REQUEST_METHOD'] == "POST") {
				if (user_can('add_roles')) {
					if ($role->validate($_POST)) {

						$_POST['slug'] = str_to_url($_POST['role']);
						$role->insert($_POST);
						message("Your role was successfuly created");
						redirect('admin/roles');
					}
				} else {
					$role->errors['role'] = "You are not allowed to perform this action";
				}

				$data['errors'] = $role->errors;
			}
		} elseif ($action == 'delete') {

			//get role information
			$data['row'] = $row = $role->first(['id' => $id]);

			if ($_SERVER['REQUEST_METHOD'] == "POST" && $row) {


				$role->delete($row->id);
				message("Your role was successfuly edited");
				redirect('admin/roles');

				$data['errors'] = $role->errors;
			}
		} elseif ($action == 'edit') {

			//get role information
			$data['row'] = $row = $role->first(['id' => $id]);

			if ($_SERVER['REQUEST_METHOD'] == "POST" && $row) {
				if ($role->validate($_POST)) {

					$role->update($row->id, $_POST);
					message("Your role was successfuly edited");
					redirect('admin/roles');
				}

				$data['errors'] = $role->errors;
			}
		} else {

			//courses view
			// $data['rows'] = $role->findAll();
			if (Auth::is_admin()) {
				$data['rows'] = $role->findAll();
			} else {
				$data['rows'] = $role->where(['id' => $user_id]);
			}

			if ($_SERVER['REQUEST_METHOD'] == "POST") {

				//disable all permissions
				$query = "update permissions_map set disabled = 1 where id > 0";
				$role->query($query);

				foreach ($_POST as $key => $permission) {

					if (preg_match("/[0-9]+\_[0-9]+/", $key)) {
						$role_id = preg_replace("/\_[0-9]+/", "", $key);

						$arr = [];
						$arr['role_id'] = $role_id;
						$arr['permission'] = $permission;

						//check if record exists
						$query = "select id from permissions_map where permission = :permission && role_id = :role_id limit 1";
						$check = $role->query($query, $arr);
						if ($check) {
							//update
							$query = "update permissions_map set disabled = 0 where permission = :permission && role_id = :role_id limit 1";
						} else {
							//insert into permissions table
							$query = "insert into permissions_map (role_id,permission) values (:role_id,:permission)";
						}

						$role->query($query, $arr);
					}
				}

				redirect('admin/roles');
			}
		}

		$this->view('admin/roles', $data);
	}

	public function profile($id = null)
	{

		if (!Auth::logged_in()) {
			message('please login to view the admin section');
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

		$data['title'] = "Profile";
		$data['errors'] = $user->errors;

		$this->view('admin/profile', $data);
	}

	public function slider_images($id = null)
	{

		if (!Auth::logged_in()) {
			message('please login to view the admin section');
			redirect('login');
		}

		$slider = new Slider();
		$data['rows'] = [];
		$rows = $slider->where(['disabled' => 0]);

		if ($rows) {
			foreach ($rows as $key => $obj) {
				$num = $obj->id;
				$data['rows'][$num] = $obj;
			}
		}

		$id = $_POST['id'] ?? 0;
		$row = $slider->first(['id' => $id]);

		if ($_SERVER['REQUEST_METHOD'] == "POST") {

			$folder = "uploads/images/";
			if (!file_exists($folder)) {
				mkdir($folder, 0777, true);
				file_put_contents($folder . "index.php", "<?php //silence");
				file_put_contents("uploads/index.php", "<?php //silence");
			}

			$allowed = ['image/jpeg', 'image/png'];

			if (!empty($_FILES['image']['name'])) {

				if ($_FILES['image']['error'] == 0) {

					if (in_array($_FILES['image']['type'], $allowed)) {
						//everything good
						$destination = $folder . time() . $_FILES['image']['name'];

						$_POST['image'] = $destination;
					} else {
						$slider->errors['image'] = "This file type is not allowed";
					}
				} else {
					$slider->errors['image'] = "Could not upload image";
				}
			}

			if ($slider->validate($_POST, $id)) {

				if (!empty($destination)) {
					move_uploaded_file($_FILES['image']['tmp_name'], $destination);

					resize_image($destination);
					if ($row && file_exists($row->image)) {
						unlink($row->image);
					}
				}

				if ($row) {
					unset($_POST['id']);
					$slider->update($id, $_POST);
				} else {
					$slider->insert($_POST);
				}

				//message("Image saved successfully");
				//redirect('admin/profile/'.$id);
			}

			if (empty($slider->errors)) {
				$arr['message'] = "Image saved successfully";
			} else {
				$arr['message'] = "Please correct these errors";
				$arr['errors'] = $slider->errors;
			}

			echo json_encode($arr);

			die;
		}

		$data['title'] = "Slider images";
		$data['errors'] = $slider->errors;

		$this->view('admin/slider-images', $data);
	}

	public function lessons()
	{
		if (!user_can('view_enrolled_courses')) {
			no_access();
		}
		if (!Auth::logged_in()) {
			redirect('login');
		}

		$course_enroll = new \Model\Course_enroll();

		$data = array();
		$data['rows'] = array();
		$data['course_enrolled'] = array();
		$data['course_instructor'] = array();
		$data['course_progress'] = array();

		if (Auth::is_admin()) {
			$data['rows'] = $course_enroll->findAll();
		} else {
			$data['rows'] = $course_enroll->where(['user_id' => Auth::getId()]);
		}

		$data['title'] = "Enrolled Courses";
		$data['action'] = "";
		$this->view('admin/courses-enrolled', $data);
	}

	public function delete_enrolled_course()
	{

		if (!user_can('delete_enrolled_courses') || !Auth::logged_in()) {
			no_access();
		}

		if (empty($_REQUEST['cid']) || empty($_REQUEST['inst_id'])) {
			redirect('admin/lessons');
		} else {
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
		redirect('admin/lessons');
	}

	public function watch_history()
	{

		if (!Auth::logged_in()) {
			redirect('login');
		}
		if (!user_can('view_watch_history')) {
			no_access();
		} else {
			// $course_enroll = new \Model\Course_enroll();

			$user_id = Auth::getId();
			$watch_history = new \Model\Watch_history();
			$data['rows'] = $watch_history->where(['user_id' => Auth::getId()]);

			$data['title'] = "Watch History";
			$data['action'] = "";

			$this->view('admin/watch-history', $data);
		}
	}

	public function watch_history_delete($id)
	{

		if (!Auth::logged_in()) {
			redirect('login');
		}
		if (!user_can('delete_watch_history')) {
			no_access();
		} else {
			$watch_history = new \Model\Watch_history();
			$data['rows'] = $watch_history->delete($id);

			redirect('admin/watch-history');
		}
	}

	public function wishlist()
	{
		if (!Auth::logged_in()) {
			redirect('login');
		}
		if (!user_can('view_cart_items')) {
			no_access();
		} else {
			$cart_item = new \Model\Cart_item();
			$data['rows'] = $cart_item->where(['user_of_id' => Auth::getId()]);


			$data['title'] = "Wishlist";
			$this->view('admin/wishlist', $data);
		}
	}

	public function delete_wishlist($id)
	{

		if (!Auth::logged_in()) {
			redirect('login');
		}
		if (!user_can('delete_cart_items')) {
			no_access();
		}

		$cart_item = new \Model\Cart_item();
		$data['rows'] = $cart_item->delete($id);
		redirect('admin/wishlist');
	}

	public function course_buy()
	{

		if (!Auth::logged_in()) {
			redirect('login');
		}
		$cart_item = new \Model\Cart_item();
		$course_enroll = new \Model\Course_enroll();
		$data['rows'] = $cart_item->where(['user_of_id' => Auth::getId()]);
		if ($data['rows']) {
			foreach ($data['rows'] as $row) {
				$arr['course_id'] = $row->course_id;
				$arr['user_id'] = Auth::getId();
				$arr['instructor_id'] = $row->user_to_id;

				$data['res'] = $course_enroll->where($arr);
				if (empty($data['res'])) {
					$course_enroll->insert($arr);
				}
			}

			$user_id = Auth::getId();
			//red all courses order by Popular value
			$query = "delete from cart_items where user_of_id = $user_id";
			$data['delete'] = $cart_item->query($query);
		}
		redirect('admin/wishlist');
	}

	public function all_students()
	{

		if (!Auth::logged_in()) {
			message('please login to continue');
			redirect('login');
		}


		$data = [];
		$data['message']['errors'] = [];
		$data['message']['success'] = [];

		$user_id = Auth::getId();
		$users = new \Model\User();
		$course_enroll = new \Model\Course_enroll();

		$data['rows'] = $course_enroll->findAll();


		$data['title'] = "All Students";

		$this->view('admin/all-students', $data);
	}

	public function pricies($action = null, $id = null)
	{

		$data['title'] = "All Students";
		$data['action'] = '';

		$price_tbl =  new \Model\Price_model();

		if ($action == 'add') {
			$data['action'] = 'add';
		} else if ($_SERVER['REQUEST_METHOD'] == "POST" && $action == 'save') {
			if ($price_tbl->validate($_POST)) {
				$price_tbl->insert($_POST);
				message("New Price has been successfuly created.");
				redirect('admin/pricies');
				$_SERVER['REQUEST_METHOD'] = "GET";
				$action = '';
			} else {
				$data['errors'] = $price_tbl->errors;
			}
		}
		if ($action == 'delete') {
			$price_tbl->delete($id);
			message("Price has been successfuly deleted.");
			redirect('admin/pricies');
			$_SERVER['REQUEST_METHOD'] = "GET";
			$action = '';
		}

		if ($_SERVER['REQUEST_METHOD'] == "POST" && $action == 'save-edit'  && $id != null) {
			if ($price_tbl->validate($_POST)) {
				$price_tbl->update($id, $_POST);
				message("Price has been successfuly Updated.");
				redirect('admin/pricies');
				$_SERVER['REQUEST_METHOD'] = "GET";
				$action = '';
			} else {
				$data['action'] = 'edit';
				$data['errors'] = $price_tbl->errors;
			}
		} else if ($action == 'edit' && $id != null) {
			$data['action'] = 'edit';
			$data['rows'] = $price_tbl->where(['id' => $id]);
		}

		$data['rows'] = $price_tbl->findAll();
		$this->view('admin/pricies', $data);
	}

	public function  competitions($action = null, $id = null): void
	{

		$competitions = new \Model\Competition();
		$data['rows'] = $competitions->findAll();
		$data['action'] = '';

		if ($action == 'add') {
			$data['action'] = 'add';
			if ($_SERVER['REQUEST_METHOD'] == "POST") {

				if ($competitions->validate($_POST)) {

					$_POST['slug'] = generate_slug($_POST['title']);
					$_POST['image'] = $this->uploadImage();
					$competitions->insert($_POST);
					message("New Competition has been successfuly created.");
					redirect('admin/competitions');
					$data['action'] = '';

				}
				$data['errors'] = $competitions->errors;
			}
		}
		if ($action == 'edit' && $id != null) {
			$data['action'] = 'edit';
			$compet = $competitions->where(['id' => $id]);
			$data['row'] = $compet[0];
			if ($_SERVER['REQUEST_METHOD'] == "POST") {
				if ($competitions->validate_edit($_POST)) {

					$_POST['slug'] = generate_slug($_POST['title']);
					if(!empty($_FILES['image']['name'])){
						  if($competitions->validate($_POST)){
							  $_POST['image'] = $this->uploadImage();
						  }
					}

					if(empty($competitions->errors)){
						$competitions->update($id, $_POST);

						message("New Competition has been successfuly updated.");
						redirect('admin/competitions');
						$data['action'] = '';
					}
					
				}
				$data['errors'] = $competitions->errors;
			}
		}

		if ($action == 'delete' && $id != null) {
			$data['action'] = 'delete';
			$data['row'] = $record = $competitions->where(['id' => $id])[0] ?? '';

			show($_SERVER['REQUEST_METHOD']);

			if ($_SERVER['REQUEST_METHOD'] == "POST" && !empty($record)) {

				$competitions->delete($id);

				message("New Competition has been successfuly deleted.");
				redirect('admin/competitions');
				$data['action'] = '';
			}
		}

		$data['title'] = 'Competitions';

		$this->view('admin/competitions', $data);
	}


	function uploadImage()
	{
		$res = "";
		$targetDir = "uploads/competitions/"; // Directory where the file will be stored
		if (!file_exists($targetDir)) {
			mkdir($targetDir, 0777, true);
		}
		$img_name = $_FILES["image"]["name"];
		$filename = $targetDir . time() . substr($img_name,0,10);
		
		// If everything is ok, try to upload the file
		if (move_uploaded_file($_FILES["image"]["tmp_name"], $filename)) {
			$res =  $filename;
		}

		return $res;
		
	}
}
