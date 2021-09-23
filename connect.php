<?php
	function checkemail($str) {
		return (!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $str)) ? FALSE : TRUE;
  }
  function validate_phone_number($phone)
{
     // Allow +, - and . in phone number
     $filtered_phone_number = filter_var($phone, FILTER_SANITIZE_NUMBER_INT);
     // Remove "-" from number
     $phone_to_check = str_replace("-", "", $filtered_phone_number);
     // Check the lenght of number
     // This can be customized if you want phone number from a specific country
     if (strlen($phone_to_check) < 10 || strlen($phone_to_check) > 14) {
        return false;
     } else {
       return true;
     }
}
	$firstName = $_POST['firstName'];
	$email = $_POST['email'];
	$subject = $_POST['subject'];
	$message = $_POST['message'];

	$host="localhost";
    $username="root";
    $user_pass="usbw";
    $database_in_use="pharmacy_database";
    $mysqli = new mysqli($host,$username,$user_pass,$database_in_use);
    if ($mysqli->connect_errno) 
    {
		header('Location: error-page.html');
    }
	else 
	{
		if($firstName==''|!checkemail($email)|!validate_phone_number($subject)|$message=='')
		{
			header("Location:invalid_input.html");
		}
		else
		{
			$sql= "INSERT INTO  visitors (name,email,sub,message) VALUES('". $_POST['firstName'] ."','". $email ."','". $subject ."','". $message ."')";
			$mysqli->query($sql);
			header("Location:thankyou_page.html");
		}
		$mysqli->close();
		exit();
		}
?>