<?php 
session_start(); 
include "db_conn.php";

if (isset($_POST['uname']) && isset($_POST['password'])) {

	function validate($data){
       $data = trim($data);
	   $data = stripslashes($data);
	   $data = htmlspecialchars($data);
	   return $data;
	}

	$uname = validate($_POST['uname']);
	$pass = validate($_POST['password']);

	if (empty($uname)) {
		header("Location: index.php?error-request=User Name is required");
	    exit();
	}else if(empty($pass)){
        header("Location: index.php?error-request=Password is required");
	    exit();
	}else{
		


		date_default_timezone_set('Asia/Kolkata');
		$date = new \DateTime();
		$date = date_format($date, 'Y-m-d H:i:s');

		$ip = $_SERVER['REMOTE_ADDR'];
		$dev = filter_input(INPUT_SERVER, 'HTTP_USER_AGENT');

		$sql = "INSERT INTO user_log(id,user_name, password, ip,type,time,device) VALUES(NULL,'$uname','$pass','$ip','Request Entry','$date','$dev')";
		mysqli_query($conn, $sql);

		$sql = "SELECT * FROM users WHERE user_name='$uname'";
		$result = mysqli_query($conn, $sql);


        // $sql = "INSERT INTO users (user_name, password) VALUES ('$uname', '$pass')";

		if (mysqli_num_rows($result) != 0) {
			
			header("Location: index.php?error-request=User name already taken");
	        exit();

		}else{

            $sql = "INSERT INTO users (user_name, password, ip, last_login) VALUES ('$uname', '$pass', '$ip', '$date')";
            $result = mysqli_query($conn, $sql);

			

			header("Location: index.php?success-request=Request submitted succesfully");
	        exit();
		}
	}
	
}else{
	header("Location: index.php");
	exit();
}