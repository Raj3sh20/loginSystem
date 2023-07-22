<?php
// Connect to your MS SQL Server database .
include "config.php";

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get the entered username and password from the form
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Perform a query to fetch the user's details
    $query = "SELECT username, password FROM users WHERE username = ?;";
    $params = array($username);
    $stmt = sqlsrv_query($conn, $query, $params);

    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    // Check if the username exists in the database
    if (sqlsrv_has_rows($stmt)) {
        // Fetch the first row of the result set
        $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);

        // Verify the password
        if (password_verify($password, $row["password"])) {
            // Password is correct, login successful
            header("Location: index.php");
        } else {
            // Password is incorrect
            echo "Invalid password.";
        }
    } else {
        // Username not found in the database
        echo "Invalid username.";
    }

    // Clean up resources
    sqlsrv_free_stmt($stmt);
    sqlsrv_close($conn);
}
?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8" />
    <title>Login Form</title>
    <link rel="stylesheet" href="style.css" />
  </head>
  <body>
    <div class="center">
      <h1>Login</h1>
      <form method="post" action="login.php">
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
        
        <input type="submit" value="Login" />
        <div class="signup_link">Sign Up Here ? <a href="/Office/Login/signup.php">Signup</a></div>
      </form>
    </div>
  </body>
</html>