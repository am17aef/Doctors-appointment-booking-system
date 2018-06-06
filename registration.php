
<?php include "header.php"; ?>

<?php 

	if($_SERVER["REQUEST_METHOD"] == 'POST'){
		require "connection.php";

	$first_name = mysqli_real_escape_string($conn, trim($_POST["first_name"]));
	$last_name = mysqli_real_escape_string($conn, trim($_POST["last_name"]));
	$home_address = mysqli_real_escape_string($conn, trim($_POST["home_address"]));
	$email = mysqli_real_escape_string($conn, trim($_POST["email"]));
	$password = mysqli_real_escape_string($conn, trim($_POST["password"]));
	$contact = mysqli_real_escape_string($conn, trim($_POST["contact"]));

	$sql = "INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `email`, `password`, `contact`, `user_type`, `registration_date`) VALUES (NULL, '$first_name', '$last_name', '$email', sha1('$password'), '$contact', 'user', CURRENT_TIMESTAMP);";

if (mysqli_query($conn, $sql)) {
    echo "Successfully Registered. Please go to the login page";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}




	}

 ?>

<h1>Registration Page</h1>


<form action="registration.php" method="post">
	
	First Name <br>
	<input type="text" name="first_name"> <br>
	Last Name <br>
	<input type="text" name="last_name"> <br>
	Home Address <br>
	<input type="text" name="home_address"> <br>
	Email <br>
	<input type="text" name="email"> <br>
	Password <br>
	<input type="password" name="password"> <br>
	Contact <br>
	<input type="text" name="contact"> <br>
	<br>
	<input type="submit" name="registration">

	<br>
	<p><a href="login.php">Login here</a></p>

</form>


<?php include "footer.php"; ?>
