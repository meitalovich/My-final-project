<?php 
session_start(); 
include "db_conn.php";

if (isset($_POST['uname']) && isset($_POST['password'])
    && isset($_POST['name']) && isset($_POST['re_password'])) {

	function validate($data){
       $data = trim($data);
	   $data = stripslashes($data);
	   $data = htmlspecialchars($data);
	   return $data;
	}

	$uname = validate($_POST['uname']);
	$pass = validate($_POST['password']);

	$re_pass = validate($_POST['re_password']);
	$name = validate($_POST['name']);
	$email = validate($_POST['email']);
	$user_data = 'uname='. $uname. '&name='. $name;


	if (empty($uname)) {
		header("Location: signup.php?error=Please enter a username&$user_data");
	    exit();
	}else if(empty($pass)){
        header("Location: signup.php?error=Please enter a password&$user_data");
	    exit();
	}
	else if(empty($re_pass)){
        header("Location: signup.php?error=Please re-enter the password&$user_data");
	    exit();
	}
	else if(empty($name)){
        header("Location: signup.php?error=Please enter your first and last name&$user_data");
	    exit();
	}
	else if($pass !== $re_pass){
        header("Location: signup.php?error=Passwords do not match&$user_data");
	    exit();
	}
	else{
		$sql = "SELECT * FROM users WHERE user_name='$uname' ";
		$result = mysqli_query($conn, $sql);

		if (mysqli_num_rows($result) > 0) {
			header("Location: signup.php?error=Username already exists. Please try another username&$user_data");
	        exit();
		}else {
           $sql2 = "INSERT INTO users(user_name, password, name, mail) VALUES('$uname', '$pass', '$name', '$email')";
           $result2 = mysqli_query($conn, $sql2);
           if ($result2) {
           	 header("Location: signup.php?success=Account created successfully");
	         exit();
           }else {
	           	header("Location: signup.php?error=An error occurred. Please try again&$user_data");
		        exit();
           }
		}
	}
	
}else{
	header("Location: signup.php");
	exit();
}
?>
