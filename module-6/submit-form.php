<?php
// Ensure that all form fields are filled out
if (empty($_POST['name']) || empty($_POST['email']) || empty($_POST['password'])) {
  die("Please fill out all form fields");
}

// Ensure that the email is in a valid format
if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
  die("Invalid email format");
}

// Save the profile picture to the server with a unique filename that includes the current date and time
$uploads_dir = "uploads/";
$profile_picture_name = date('Ymd_His') . '_' . $_FILES["profile_picture"]["name"];
$profile_picture_tmp_name = $_FILES["profile_picture"]["tmp_name"];
move_uploaded_file($profile_picture_tmp_name, "$uploads_dir/$profile_picture_name");

// Save the user's name, email, and profile picture filename to a CSV file
$user_data = array($_POST['name'], $_POST['email'], $profile_picture_name);
$users_file = fopen("users.csv", "a");
fputcsv($users_file, $user_data);
fclose($users_file);

// Start a new session and set a cookie with the user's name
session_start();
$_SESSION['name'] = $_POST['name'];
setcookie("user_name", $_POST['name'], time() + 3600);

// Redirect to a new HTML page that displays the contents of the "users.csv" file in a table
header("Location: users.php");
exit();
?>
