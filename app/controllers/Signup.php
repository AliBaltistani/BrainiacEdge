<?php 

namespace Controller;

/**
 * signup class
 */
use Model\User;
use Model\Email;
class Signup extends Controller
{
	
	public function index()
	{
	
		$data['errors'] = [];

		$user = new \Model\User();
		$roles = new \Model\Role();

		if($_SERVER['REQUEST_METHOD'] == "POST")
		{

			if($user->validate($_POST))
			{
				$_POST['date'] = date("Y-m-d H:i:s");
				$_POST['role'] =  $_POST['role'] ?? 1;
				$_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);

				$user->insert($_POST);
			
				message("Your profile was successfuly created. Please verify email");
				redirect('signup/verify_email');
				// $this->verify_email();
			}
		}

		//red all courses order by trending value
		$query = "select id, role from roles where disabled = 0 AND (role = 'instructor' OR role =  'student')";
		$data['roles'] = $roles->query($query);

		$data['errors'] = $user->errors;
		$data['title'] = "Signup";

		$this->view('signup',$data);
	}

	public function verify_email() {

		
		$data['title'] = "Email Verification";

		$this->view('email-verification',$data);
	}

	public function sent_otp()
    {
        $data['errors'] = [];
        $data['success'] = [];

		$data['title'] = "Forget Password";
		$user = new User();

		if($_SERVER['REQUEST_METHOD'] == "POST")
		{
			//validate
			$row = $user->first([
				'email'=>$_POST['email']
			]);

			if($row){

                $user_id = $row->id;
                // Usage
                $to = $row->email;
                $subject = 'Email Verification OTP';
                $otp = Email::generateOTP(); // Generate OTP
                $message = "<p>Your Email Verification code is \r\n : <a href='".ROOT.'/signup/validate_otp?otp='.$otp.'&uid='.$user_id. "' class='btn btn-success'>Verify Email</a> </p>";

                $email = new Email($to, $otp, $subject, $message);

                if ($email->send()) {
                    $data['success']['email'] = 'email verification code successfully.';
                } else {
                    $data['errors']['email'] = 'Failed to send email verification code.';
                }

			}else{

                $data['errors']['email'] = "Wrong email, Please enter a registered email";
            }

		}
        
        $this->view('password-forget',$data);
    }

	public function validate_otp(){

		// show($_REQUEST);
		// die;
        $data['errors'] = [];
        $data['success'] = [];

        $data['title'] = "Verify Email";

		$user = new User();
        
         // Validate form submission
        if ($_SERVER["REQUEST_METHOD"] == "GET" && (isset($_GET["otp"]) && isset($_GET["uid"])) ) {
        // Retrieve form data
        $otpEntered = $_GET["otp"];
        $user_id = $_GET["uid"];

        // Retrieve stored OTP and expiration time from session or database
        $storedOTP = (isset($_SESSION['email']["otp"]))? $_SESSION['email']["otp"]: '';
        $expiration = (isset($_SESSION['email']["otp_expires"]))? $_SESSION['email']["otp_expires"]: '';


            // Validate OTP
            if ($otpEntered == $storedOTP && time() < $expiration) {
				
                // OTP is valid
				$data['user_info']  = array(
					'status' => 'approved'
			   );

			   $user->update($user_id,$data['user_info']);
		   
			   message("Your Email has been successfuly verified.");
			   redirect('login');

            } else {
                // OTP is invalid or expired
                $data['errors']['email'] = "Invalid or expired OTP. Please try again or request a new OTP.";
                $view_file = 'password-forget';
            }
            if(isset($_SESSION['email'])){ unset($_SESSION['email']);} 

        }else{
            $data['errors']['email'] = "Invalid or expired OTP. Please try again or request a new OTP.";
        }

        $this->view('email-verification',$data);
    
    }
	
}