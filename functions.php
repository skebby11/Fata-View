<?php 

	session_set_cookie_params(2592000,"/");
	session_start([
    'cookie_lifetime' => 2592000,
	]);

	$baseurl = "https://fatastreaming2.altervista.org/";

	// connect to database
	$db = mysqli_connect('localhost', 'fatastreaming2', '', 'my_fatastreaming2');

	// variable declaration
	$username = "";
	$email    = "";
	$errors   = array(); 

	//declaring global vars
	$time = date("d/m/Y - H:i:s");
	$year = date("Y"); 
	$month = date("m"); 

	// call the register() function if register_btn is clicked
	if (isset($_POST['register_btn'])) {
		register();
	}

	// call the login() function if register_btn is clicked
	if (isset($_POST['login_btn'])) {
		login();
	}

	// call the removeserie() function if removeserie_btn is clicked
	if (isset($_POST['removeserie_btn'])) {
		removeserie();
	}

	// call the login() function if register_btn is clicked
	if (isset($_POST['removeepisode_btn'])) {
		removeepisode();
	}

	if (isset($_GET['logout'])) {
		session_destroy();
		unset($_SESSION['user']);
		header("location: login");
	}

	// REMOVE SERIE
	function removeserie(){
		
		global $db;
		
		$serietodel = e($_POST['serietodel']);
		$requestinguser = e(($_POST['requestinguser']));
		
		if($requestinguser == $_SESSION['user']['id']) {
		
			$query = "DELETE FROM `epseen` WHERE `serie` = $serietodel AND user = $requestinguser";
			mysqli_query($db, $query);
		} else {
			echo "Not allowed.";
		}
	}

	// REMOVE EPI
	function removeepisode(){
		
		global $db;
		
		$eptodel = e($_POST['eptodel']);
		$requestinguser = e(($_POST['requestinguser']));
		
		if($requestinguser == $_SESSION['user']['id']) {
		
			$query = "DELETE FROM `epseen` WHERE `epid` = $eptodel AND user = $requestinguser";
			mysqli_query($db, $query);
		} else {
			echo "Not allowed.";
		}
	}

	// REGISTER USER
	function register(){
		global $db, $errors;

		// receive all input values from the form
		$username    =  e($_POST['username']);
		$email       =  e($_POST['email']);
		$password_1  =  e($_POST['password_1']);
		$password_2  =  e($_POST['password_2']);
		$goto = e($_POST['goto']);

		// form validation: ensure that the form is correctly filled
		if (empty($username)) { 
			array_push($errors, "Username is required"); 
		}
		if (empty($email)) { 
			array_push($errors, "Email is required"); 
		}
		if (empty($password_1)) { 
			array_push($errors, "Password is required"); 
		}
		if ($password_1 != $password_2) {
			array_push($errors, "The two passwords do not match");
		}

		// register user if there are no errors in the form
		if (count($errors) == 0) {
			$password = md5($password_1);//encrypt the password before saving in the database

			if (isset($_POST['user_type'])) {
				$user_type = e($_POST['user_type']);
				$query = "INSERT INTO users (username, email, user_type, password) 
						  VALUES('$username', '$email', '$user_type', '$password')";
				mysqli_query($db, $query);
				$_SESSION['success']  = "New user successfully created!!";
				header('location: home.php');
			}else{
				$query = "INSERT INTO users (username, email, user_type, password) 
						  VALUES('$username', '$email', 'user', '$password')";
				mysqli_query($db, $query);

				// get id of the created user
				$logged_in_user_id = mysqli_insert_id($db);

				$_SESSION['user'] = getUserById($logged_in_user_id); // put logged in user in session
				$_SESSION['success']  = "You are now logged in";
				
				// view.php specific redirect if there's a goto link
					if(empty($goto)){
						header('location: /');
					} else {
					header('location: view?' . $goto . '');
					}
				
				header('location: /');				
			}

		}

	}

	// return user array from their id
	function getUserById($id){
		global $db;
		$query = "SELECT * FROM users WHERE id=" . $id;
		$result = mysqli_query($db, $query);

		$user = mysqli_fetch_assoc($result);
		return $user;
	}

	// LOGIN USER
	function login(){
		global $db, $username, $goto, $errors;

		// grap form values
		$username = e($_POST['username']);
		$password = e($_POST['password']);
		$goto = e($_POST['goto']);

		// make sure form is filled properly
		if (empty($username)) {
			array_push($errors, "Username is required");
		}
		if (empty($password)) {
			array_push($errors, "Password is required");
		}

		// attempt login if no errors on form
		if (count($errors) == 0) {
			$password = md5($password);

			$query = "SELECT * FROM users WHERE username='$username' AND password='$password' LIMIT 1";
			$results = mysqli_query($db, $query);

			if (mysqli_num_rows($results) == 1) { // user found
				// check if user is admin or user
				$logged_in_user = mysqli_fetch_assoc($results);
				if ($logged_in_user['user_type'] == 'admin') {

					$_SESSION['user'] = $logged_in_user;
					$_SESSION['success']  = "You are now logged in";
					header('location: admin/index.php');		  
				}else{
					$_SESSION['user'] = $logged_in_user;
					$_SESSION['success']  = "You are now logged in";
						
					// view.php specific redirect if there's a goto link
					if(empty($goto)){
						header('location: index.php');
					} else {
					header('location: view?' . $goto . '');
					}
				}
			}else {
				array_push($errors, "Wrong username/password combination");
			}
		}
	}

	function isLoggedIn()
	{
		if (isset($_SESSION['user'])) {
			return true;
		}else{
			return false;
		}
	}

	function isAdmin()
	{
		if (isset($_SESSION['user']) && $_SESSION['user']['user_type'] == 'admin' ) {
			return true;
		}else{
			return false;
		}
	}

	// escape string
	function e($val){
		global $db;
		return mysqli_real_escape_string($db, trim($val));
	}

	function display_error() {
		global $errors;

		if (count($errors) > 0){
			echo '<div class="error">';
				foreach ($errors as $error){
					echo $error .'<br>';
				}
			echo '</div>';
		}
	}

?>