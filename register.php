<?php # DISPLAY COMPLETE REGISTRATION PAGE.

# Set page title.
$page_title = 'Registration Form' ;

# Check form submitted.
if ( $_SERVER[ 'REQUEST_METHOD' ] == 'POST' )
{
  # Connect to the database.
  require ('connect_db.php'); 
  
  # Initialize an error array.
  $errors = array();

  # Check for a first name.
  if ( empty( $_POST[ 'first_name' ] ) )
  { $errors[] = 'Enter your first name.' ; }
  else
  { $fn = mysqli_real_escape_string( $dbc, trim( $_POST[ 'first_name' ] ) ) ; }

  # Check for a last name.
  if (empty( $_POST[ 'last_name' ] ) )
  { $errors[] = 'Enter your last name.' ; }
  else
  { $ln = mysqli_real_escape_string( $dbc, trim( $_POST[ 'last_name' ] ) ) ; }
  
  # Check for an address.
  if (empty( $_POST[ 'address' ] ) )
  { $errors[] = 'Enter your address.' ; }
  else
  { $ln = mysqli_real_escape_string( $dbc, trim( $_POST[ 'address' ] ) ) ; }

  # Check for a city.
  if (empty( $_POST[ 'city' ] ) )
  { $errors[] = 'Enter your city.' ; }
  else
  { $ln = mysqli_real_escape_string( $dbc, trim( $_POST[ 'city' ] ) ) ; }
  
  
  # Check for gender.
  if (empty( $_POST[ 'gender' ] ) )
  { $errors[] = 'Enter your gender.' ; }
  else
  { $ln = mysqli_real_escape_string( $dbc, trim( $_POST[ 'gender' ] ) ) ; }
  
  # Check for an email address:
  if ( empty( $_POST[ 'email' ] ) )
  { $errors[] = 'Enter your email address.'; }
  else
  { $e = mysqli_real_escape_string( $dbc, trim( $_POST[ 'email' ] ) ) ; }

  # Check for a password and matching input passwords.
  if ( !empty($_POST[ 'pass1' ] ) )
  {
    if ( $_POST[ 'pass1' ] != $_POST[ 'pass2' ] )
    { $errors[] = 'Passwords do not match.' ; }
    else
    { $p = mysqli_real_escape_string( $dbc, trim( $_POST[ 'pass1' ] ) ) ; }
  }
  else { $errors[] = 'Enter your password.' ; }
  
  # Check if email address already registered.
  if ( empty( $errors ) )
  {
    $q = "SELECT user_id FROM users WHERE email='$e'" ;
    $r = @mysqli_query ( $dbc, $q ) ;
    if ( mysqli_num_rows( $r ) != 0 ) $errors[] = 'Email address already registered. <a href="login.php">Login</a>' ;
  }
  
  # On success register user inserting into 'users' database table.
  if ( empty( $errors ) ) 
  {
    $q = "INSERT INTO users (first_name, last_name, address, city, gender, email, pass, reg_date) VALUES ('$fn', '$ln', $addr , $city , $gen , '$e', SHA1('$p'), NOW() )";
    $r = @mysqli_query ( $dbc, $q ) ;
    if ($r)
    { echo '<h1>Registered!</h1><p>You are now registered.</p><p><a href="login.php">Login</a></p>'; }
  
    # Close database connection.
    mysqli_close($dbc); 

  }
  # Or report errors.
  else 
  {
    echo '<h1>Error!</h1><p id="err_msg">The following error(s) occurred:<br>' ;
    foreach ( $errors as $msg )
    { echo " - $msg<br>" ; }
    echo 'Please try again.</p>';
    # Close database connection.
    mysqli_close( $dbc );
  }  
}
?>

<!-- Display body section with sticky form. -->
<h1>Registration Form</h1>
<form action="register.php" method="post">
<p>
First Name: <input type="text" name="first_name" size="20" value="<?php if (isset($_POST['first_name'])) echo $_POST['first_name']; ?>"> 
Last Name: <input type="text" name="last_name" size="20" value="<?php if (isset($_POST['last_name'])) echo $_POST['last_name']; ?>">
</p>

<p>
Address: <input type="text" name="address" size="40" value="<?php if (isset($_POST['address'])) echo $_POST['address']; ?>">
</p>
<p>
City: <select type="text" name="city" size="20" value="<?php if (isset($_POST['city'])) echo $_POST['city']; ?>">
<option value=""> -- Please select -- </option>
<option>Port of Spain</option>
<option>San Fernando</option>
<option>Penal</option>
<option>Chaguanas</option>
<option>Other</option>
</select>
</p>

<p>
Gender:<input type="radio" name="gender" value="female">Female<?php if (isset($_POST['gender'])) echo $_POST['gender']; ?>">
</p>
<input type="radio" name="gender" value="male">Male<?php if (isset($_POST['gender'])) echo $_POST['gender']; ?>">
</p>

<p>
Email Address: <input type="text" name="email" size="50" value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>">
</p>

<p>
Password: <input type="password" name="pass1" size="20" value="<?php if (isset($_POST['pass1'])) echo $_POST['pass1']; ?>" >
Confirm Password: <input type="password" name="pass2" size="20" value="<?php if (isset($_POST['pass2'])) echo $_POST['pass2']; ?>">
</p>

<p>
<input type="reset" name="reset" value="Reset">
</p>

<p>
<input type="submit" name="submit" value="Submit">
</p>
</form>


