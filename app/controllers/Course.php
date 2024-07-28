<?php

namespace Controller;

use Model\Auth;

if (!defined("ROOT")) die("direct script access denied");

/**
 * single course class
 */

class Course extends Controller
{

	public function index($slug = null)
	{
		$course = new \Model\Course();
		$course_meta = new \Model\Course_meta();
		$comment = new \Model\Comment();
		$comment_reply = new \Model\Comment_reply();
		$cart_item = new \Model\Cart_item();
		$course_enroll = new \Model\Course_enroll();

		$data['title'] = "Course";
		$data['row_learners'] = array();
		$data['row_contents'] = array();
		$data['comments']     = array();
		$data['replies']     = array();
		$data['cart_item']     = array();
		//red the course data
		$data['row'] = $course->first(['slug' => $slug]);

		if (!empty($data['row'])) {

			$course_id = $data['row']->id;
			$inc = ((int)$data['row']->views + 1);
			$query = "UPDATE `courses` SET `views`= $inc WHERE id = $course_id ";
			$data['inc_views'] = $course->query($query);

			$row_meta = $course_meta->where(['course_id' => $data['row']->id]);
			if (!empty($row_meta)) {
				foreach ($row_meta as $half) {
					if ($half->tab == "intended-learners") {
						array_push($data['row_learners'], $half);
					} elseif ($half->tab == "curriculum") {
						array_push($data['row_contents'], $half);
					}

					$data['row_learners'] = array_reverse($data['row_learners']);
					$data['row_contents'] = array_reverse($data['row_contents']);
				}
			}
		}

		//reed all courses order by trending value
		$query = "select * from courses where approved != 0 order by trending desc limit 5";
		$data['trending'] = $course->query($query);

		//reed all courses order by Popular value
		$query = "select * from courses where approved != 0 order by views desc limit 5";
		$data['populars'] = $course->query($query);

		//reed all Comments order by Post id 
		$data['comments'] = $comment->where(['post_id' => $data['row']->id]);
		$data['replies'] = $comment_reply->where(['post_id' => $data['row']->id]);
		$data['cart_item'] = $cart_item->where(['course_id' => $data['row']->id, 'user_of_id' => Auth::getId()]);
		$data['buy_item'] = $course_enroll->where(['course_id' => $data['row']->id, 'user_id' => Auth::getId()]);

		$this->view('course', $data);
	}

	public function latest(){

		$course = new \Model\Course();
		$category = new \Model\Category();

		$data['title'] = "Home";

		//red all courses 
		$data['rows'] = $course->where(['approved'=>1, 'published' =>1],'desc');
		
		//red all courses order by trending value
		$query = "select * from courses where approved = 1 and published = 1 order by trending desc limit 5";
		$data['trending'] = $course->query($query);
		
		
		$this->view('latest',$data);

	}

	public function comments($slug = null)
	{
		$comment = new \Model\Comment;

		if ($_SERVER['REQUEST_METHOD'] == "POST") {
			if (!(Auth::logged_in())) {
				redirect('login');
			} elseif ($comment->validate($_POST)) {
				$comment->insert($_POST);
			}
		}

		redirect('course/' . $slug);
	}

	public function comment_reply($slug = null)
	{
		$comment_reply = new \Model\Comment_reply;

		if ($_SERVER['REQUEST_METHOD'] == "POST") {
			if (!(Auth::logged_in())) {
				redirect('login');
			} elseif ($comment_reply->validate($_POST)) {
				$comment_reply->insert($_POST);
			}
		}

		redirect('course/' . $slug);
	}
	public function add_to_cart($slug = null)
	{
		$cart_item = new \Model\Cart_item;

		if ($_SERVER['REQUEST_METHOD'] == "POST") {
			if (!(Auth::logged_in())) {
				redirect('login');
				
			} else {
				$cart_item->insert($_POST);
			}
		}


		redirect('course/' . $slug);
	}

	public function search_tags($slug = null)
	{

		$course = new \Model\Course();

		$tags = str_replace('-', ' ', $slug);
		$data['title'] = "" . $tags;
		//red all courses 
		$query = "SELECT c.*,cat.category,cat.slug as catslug FROM courses as c join categories as cat on cat.id = c.category_id where c.tags like :slug";
		$data['rows'] = $course->query($query, ['slug' => '%' . $tags . '%']);

		//red all courses order by trending value
		$query = "select * from courses where approved != 0 order by trending desc limit 5";
		$data['trending'] = $course->query($query);

		$this->view('category', $data);
	}

	public function make_payment(){
		if (!(Auth::logged_in())) {
			redirect('login');
		}

		
		$course = new \Model\Course;
		$data['rows'] = $course->where(['id'=> $_POST['course_id']]);

		$data['titel'] = 'Payment';

		$this->view('payment', $data);
	}

	public function course_buy($slug = null)
	{
		
		$course_enroll = new \Model\Course_enroll;
		$course = new \Model\Course;

		if ($_SERVER['REQUEST_METHOD'] == "POST") {
			if (!(Auth::logged_in())) {
				redirect('login');
			} elseif ($course_enroll->validate($_POST)) {
				$course_enroll->insert($_POST);

				//updating trending value
				$course_id = $_POST['course_id'];
				$query = "UPDATE `courses` SET `trending`=  trending + 1 WHERE id = $course_id ";
				$data['inc_trending'] = $course->query($query);
			}
		}

		redirect('course/' . $slug);
	}
	public function learn_lecture($slug = null)
	{

		$course = new \Model\Course;
		$data['row']  = array();
		if (!(Auth::logged_in())) {
			redirect('login');
		} elseif (empty($_REQUEST['id'])) {
			redirect('course/' . $slug);
		} else {
			//red the course data

			$course = new \Model\Course;
			$course_meta = new \Model\Course_meta;
			$comment = new \Model\Comment;
			$comment_reply = new \Model\Comment_reply;
			$cart_item = new \Model\Cart_item;
			$course_enroll = new \Model\Course_enroll;

			$data['title'] = "Course";
			$data['row_learners'] = array();
			$data['row_contents'] = array();
			$data['comments']     = array();
			$data['replies']     = array();
			$data['cart_item']     = array();
			//red the course data
			$data['row'] = $course->first(['id' => $_REQUEST['id'], 'slug' => $slug]);

			if (!empty($data['row'])) {

				$row_meta = $course_meta->where(['course_id' => $data['row']->id]);
				if (!empty($row_meta)) {
					foreach ($row_meta as $half) {
						if ($half->tab == "intended-learners") {
							array_push($data['row_learners'], $half);
						} elseif ($half->tab == "curriculum") {
							array_push($data['row_contents'], $half);
						}

						$data['row_learners'] = array_reverse($data['row_learners']);
						$data['row_contents'] = array_reverse($data['row_contents']);
					}
				}
			}

			//red all courses order by trending value
			$query = "select * from courses where approved != 0 order by trending desc limit 5";
			$data['trending'] = $course->query($query);

			//red all courses order by Popular value
			$query = "select * from courses where approved != 0 order by views desc limit 5";
			$data['populars'] = $course->query($query);

			//red all Comments order by Post id 
			$data['comments'] = $comment->where(['post_id' => $data['row']->id]);
			$data['replies'] = $comment_reply->where(['post_id' => $data['row']->id]);
			$data['cart_item'] = $cart_item->where(['course_id' => $data['row']->id, 'user_of_id' => Auth::getId()]);
			$data['buy_item'] = $course_enroll->where(['course_id' => $data['row']->id, 'user_id' => Auth::getId()]);
		}

		$this->view('course-start', $data);
	}

	public function update_lecture_progress()
	{
		if (!(Auth::logged_in())) {
			redirect('login');
		} else {

			$_POST['user_id'] = Auth::getId();

			$where_arr = [
				'user_id' => $_POST['user_id'],
				'instructor_id' => $_POST['instructor_id'],
				'course_id' => $_POST['course_id'],
				'lecture_id' => $_POST['lecture_id']
			];

			$watch_history = new \Model\Watch_history();
			$row = $watch_history->where($where_arr);
			if ($row) {
				$watch_history->update($row[0]->id, $_POST);
				header('Content-Type: application/json');
				echo json_encode(['status' => 'updated']);
			} else {
				$watch_history->insert($_POST);
				header('Content-Type: application/json');
				echo json_encode(['status' => 'added']);
			}
		}
	}

	
}
