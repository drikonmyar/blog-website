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
		header("Location: index.php?error-login=User Name is required");
	    exit();
	}else if(empty($pass)){
        header("Location: index.php?error-login=Password is required");
	    exit();
	}else{

		date_default_timezone_set('Asia/Kolkata');
		$hour = date('G');
		$date = new \DateTime();
		$date = date_format($date, 'Y-m-d H:i:s');

		$ip = $_SERVER['REMOTE_ADDR'];
		$dev = filter_input(INPUT_SERVER, 'HTTP_USER_AGENT');

		$sql = "INSERT INTO user_log(id,user_name, password, ip,type,time,device) VALUES(NULL,'$uname','$pass','$ip','Login Entry','$date','$dev')";
		mysqli_query($conn, $sql);

		$sql = "SELECT * FROM users WHERE user_name='$uname' AND password='$pass'";
		$result = mysqli_query($conn, $sql);
		$row = mysqli_fetch_assoc($result);

		if (mysqli_num_rows($result) == 1 && $row['user_name']==$uname && $row['password']==$pass) {
			

			if($row['confirm']==1){

				

				// $sql = "UPDATE user_log SET user_name = '$uname', password = '$pass', home_scr = 1, time_home = '$date' WHERE id = (SELECT MAX(id) FROM user_log)";
				// mysqli_query($conn, $sql);
				

				

				$sql = "UPDATE users SET ip = '$ip', watching = watching + 1 WHERE user_name='$uname'";
				mysqli_query($conn, $sql);

				$sql = "SELECT * FROM users WHERE user_name='$uname'";
				$result = mysqli_query($conn, $sql);
				$det = mysqli_fetch_assoc($result);

				$_SESSION['user_name'] = $det['user_name'];
				$_SESSION['password'] = $det['password'];
				$_SESSION['id'] = $det['id'];
				$_SESSION['ip'] = $det['ip'];
				$_SESSION['last_login'] = $det['last_login'];

				// $_SESSION['greet'] = $hour;
				
				if ( $hour >= 3 && $hour < 12 ) {
					$_SESSION['greet'] = 'Good Morning';
				} else if ( $hour >= 12 && $hour < 18 ) {
					$_SESSION['greet'] = 'Good Afternoon';
				} else if ( $hour >= 18 || $hour < 3) {
					$_SESSION['greet'] = 'Good Evening';
				}
				// $_SESSION['watching'] = $det['watching'];

				// $sql = "SELECT COUNT(*) as sum FROM users WHERE watching = 1";
				// $result = mysqli_query($conn, $sql);
				// $watch = mysqli_fetch_assoc($result);

				// $_SESSION['watching'] = $watch['sum'];

				$sql = "SELECT SUM(watching) as sum_view FROM users";
				$result = mysqli_query($conn, $sql);
				$watch = mysqli_fetch_assoc($result);

				$_SESSION['watching'] = $watch['sum_view'];

				$sql = "SELECT COUNT(*) as sum_user FROM users WHERE confirm = 1";
				$result = mysqli_query($conn, $sql);
				$users = mysqli_fetch_assoc($result);

				$_SESSION['sum_user'] = $users['sum_user'];


				$sql = "UPDATE users SET last_login = '$date' WHERE user_name='$uname'";
				mysqli_query($conn, $sql);

				// header("Location: index.php?success-login=Logged in successfully");
				// sleep(3);

				header("Location: home.php");
				exit();
			}

			else{
				header("Location: index.php?success-login=Request verification under process");
				exit();
			}

		}else{
			header("Location: index.php?error-login=Incorect User name or password");
	        exit();
		}
	}
	
}else{
	header("Location: index.php");
	exit();
}