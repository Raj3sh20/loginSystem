


<?php
  // Connect to your MS SQL Server database .
include "config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Validate and sanitize the data (you can add more validation here)
    $username = trim($username);
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);

   

    // Prepare and execute the SQL query to insert user data into the database
    $sql = "INSERT INTO users(username, email, password) VALUES (?, ?, ?)";
    $params = array($username, $email, password_hash($password, PASSWORD_DEFAULT));
    $stmt = sqlsrv_query($conn, $sql, $params);

    if ($stmt === false) {
        // Display an error message if the registration failed
        echo "Error: " . print_r(sqlsrv_errors(), true);
    } else {
        // Registration successful, redirect to a thank you page or login page
        header("Location: index.php");
        exit();
    }

    // Close the database connection
    sqlsrv_close($conn);
}

?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8" />
    <title>Signup Form</title>
    <link rel="stylesheet" href="style.css" />
  </head>
  <body>
    <div class="center">
      <h1>Sign Up</h1>
      <form method="post" action="signup.php">
        <div class="txt_field">
          <input type="text" name="username" required />
          <span></span>
          <label>Username</label>
        </div>
        <div class="txt_field">
          <input type="password" name="password" required />
          <span></span>
          <label>Password</label>
        </div>
          <div class="txt_field">
            <input type="text" name="email"required />
            <span></span>
            <label>Email</label>
          </div>
        
        <input type="submit" value="Signup" />
        <div class="signup_link">Login Here ? <a href="/Office/Login/login.php">Login</a></div>
      </form>
    </div>
  </body>
</html>