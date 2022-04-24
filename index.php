<!DOCTYPE html>
<html>
<head>

	<script async src="https://www.googletagmanager.com/gtag/js?id=G-LRH5QV3J4S"></script>
	<script>
  	window.dataLayer = window.dataLayer || [];
  	function gtag(){dataLayer.push(arguments);}
  	gtag('js', new Date());

  	gtag('config', 'G-LRH5QV3J4S');
	</script>

	<title>LOGIN</title>
	<link rel="stylesheet" href="style.css">
</head>
<body>

	<?php
		include "db_conn.php";

		$ip = $_SERVER['REMOTE_ADDR'];
		$dev = filter_input(INPUT_SERVER, 'HTTP_USER_AGENT');
		
		date_default_timezone_set('Asia/Kolkata');
		$date = new \DateTime();
		$date = date_format($date, 'Y-m-d H:i:s');
		
		$sql = "INSERT INTO user_log(id,ip,type,time,device) VALUES(NULL,'$ip','Index Entry','$date','$dev')";
		mysqli_query($conn, $sql);
	?>
	
     <form action="login.php" method="post">
     	<h2>LOGIN</h2>
     	<?php if (isset($_GET['error-login'])) { ?>
     		<p class="error-login"><?php echo $_GET['error-login']; ?></p>
     	<?php } ?>
		 <?php if (isset($_GET['success-login'])) { ?>
     		<p class="success-login"><?php echo $_GET['success-login']; ?></p>
     	<?php } ?>
     	<label>User Name</label>
     	<input type="text" name="uname" placeholder="User Name"><br>

     	<label>Password</label>
     	<input type="password" name="password" placeholder="Password"><br>

		

     	<button type="submit">Login</button>

     </form>



	 <form action="request.php" method="post">
     	<h2>REQUEST ACCESS</h2>
     	<?php if (isset($_GET['error-request'])) { ?>
     		<p class="error-request"><?php echo $_GET['error-request']; ?></p>
     	<?php } ?>
		 <?php if (isset($_GET['success-request'])) { ?>
     		<p class="success-request"><?php echo $_GET['success-request']; ?></p>
     	<?php } ?>
     	<label>User Name</label>
     	<input type="text" name="uname" placeholder="User Name"><br>

     	<label>Create Password</label>
     	<input type="password" name="password" placeholder="New Password"><br>

		

     	<button type="request">Send Request</button>

     </form>
</body>
</html>