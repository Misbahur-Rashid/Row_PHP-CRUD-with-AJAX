<?php
$con=mysqli_connect("localhost", "root", "", "phpcrud");
if(mysqli_connect_errno())
{
echo "Connection Fail".mysqli_connect_error();
}
// mysqli_select_db($dbcon,"users");  

if (isset($_POST['register'])) {
  // receive all input values from the form
  $user_name = mysqli_real_escape_string($db, $_POST['user_name']);
  $user_email = mysqli_real_escape_string($db, $_POST['user_email']);
  $user_pass = mysqli_real_escape_string($db, $_POST['user_pass']);
  //$password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($user_name)) { array_push($errors, "Username is required"); }
  if (empty($user_email)) { array_push($errors, "Email is required"); }
  if (empty($user_pass)) { array_push($errors, "Password is required"); }
//   if ($password_1 != $password_2) {
// 	array_push($errors, "The two passwords do not match");
//   }

  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM users WHERE user_name='$user_name' OR user_email='$user_email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { // if user exists
    if ($user['user_name'] === $user_name) {
      array_push($errors, "Username already exists");
    }

    if ($user['user_email'] === $user_email) {
      array_push($errors, "email already exists");
    }
  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
  	$password = md5($user_pass);//encrypt the password before saving in the database

  	$query = "INSERT INTO users (user_name, user_email, user_pass) 
  			  VALUES('$user_name', '$user_email', '$user_pass')";
  	mysqli_query($db, $query);
  	$_SESSION['user_name'] = $user_name;
  	$_SESSION['success'] = "You are now logged in";
  	header('location: index.php');
  }
}

