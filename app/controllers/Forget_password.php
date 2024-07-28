<?php

namespace Controller;


/**
 * login class
 */

use Model\Auth;
use Model\User;
use Model\Email;

class Forget_password extends Controller
{

    public function index()
    {

        $data['title'] = "Forget Password";
        $this->view('password-forget',$data);
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
                $subject = 'Your OTP';
                $otp = Email::generateOTP(); // Generate OTP
                $message = "<p>To reset your password click 'Reset Password' link\r\n : <a href='".ROOT.'/forget_password/validate_otp?otp='.$otp.'&uid='.$user_id. "' class='btn btn-success'>Reset Password</a> </p>";

                $email = new Email($to, $otp, $subject, $message);

                if ($email->send()) {
                    $data['success']['email'] = 'OTP email sent successfully.';
                } else {
                    $data['errors']['email'] = 'Failed to send OTP email.';
                }

			}else{

                $data['errors']['email'] = "Wrong email, Please enter a registered email";
            }

		}
        
        $this->view('password-forget',$data);
    }

    public function validate_otp(){

        $data['errors'] = [];
        $data['success'] = [];

        $data['title'] = "Reset Password";
        $view_file = 'password-forget';
        
         // Validate form submission
        if ($_SERVER["REQUEST_METHOD"] == "GET" && (isset($_GET["otp"]) && isset($_GET["uid"])) ) {
        // Retrieve form data
        $otpEntered = $_GET["otp"];
        $data['user_id'] = $_GET["uid"];

        // Retrieve stored OTP and expiration time from session or database
        $storedOTP = (isset($_SESSION['email']["otp"]))? $_SESSION['email']["otp"]: '';
        $expiration = (isset($_SESSION['email']["otp_expires"]))? $_SESSION['email']["otp_expires"]: '';

            // Validate OTP
            if ($otpEntered == $storedOTP && time() < $expiration) {
                // OTP is valid
                $data['success']['email'] = "OTP is verify successfully.";
                $view_file = 'password-reset';
            } else {
                // OTP is invalid or expired
                $data['errors']['email'] = "Invalid or expired OTP. Please try again or request a new OTP.";
                $view_file = 'password-forget';
            }
            if(isset($_SESSION['email'])){ unset($_SESSION['email']);} 

        }else{
            $data['errors']['email'] = "Invalid or expired OTP. Please try again or request a new OTP.";
        }

        $this->view('password-reset',$data);
    
    }

    public function password_update(){

        $data['errors'] = [];
        $data['user_id'] = $_POST['user_id'];
		$user = new User();

		if($_SERVER['REQUEST_METHOD'] == "POST" && !empty($_POST['user_id']))
		{
			if($user->password_validate($_POST))
			{
                $data['user_info']  = array(
                     'password' => password_hash($_POST['password'], PASSWORD_DEFAULT)
                );
                $user_id = $_POST['user_id'];
				$user->update($user_id,$data['user_info']);
			
				message("Your password was successfuly updated. Please login");
				redirect('login');
			}
		}else{
            $data['errors']['email'] = "Invalid or expired OTP. Please try again or request a new OTP.";
        }

		$data['errors'] = $user->errors;
		$data['title'] = "Reset Password";

		$this->view('password-reset',$data);
    
    }

  
}
