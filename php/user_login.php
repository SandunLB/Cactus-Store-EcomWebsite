<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>User Login</title>
<link rel="stylesheet" href="../css/registration.css">
</head>
<body>

<h2>User Login</h2>

<?php
// Include the connection file
include 'connection.php';

// Initialize variables
$username = $password = "";
$username_err = $password_err = "";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $username = test_input($_POST['username']);
    $password = $_POST['password'];

    // Prepare and execute the SQL statement
    $sql = "SELECT id, username, password FROM users WHERE username = ?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->store_result();
        
        // Check if username exists
        if ($stmt->num_rows == 1) {
            $stmt->bind_result($id, $db_username, $hashed_password);
            if ($stmt->fetch()) {
                // Verify password
                if (password_verify($password, $hashed_password)) {
                    // Password is correct, start a new session
                    session_start();
                    
                    // Store data in session variables
                    $_SESSION["id"] = $id;
                    $_SESSION["username"] = $username;
                    
                    // Redirect user to welcome page
                    header("location: user_panel.php");
                } else {
                    // Password is not valid
                    $password_err = "Invalid password.";
                }
            }
        } else {
            // Username not found
            $username_err = "Username not found.";
        }

        // Close statement
        $stmt->close();
    }
}

// Close connection
$conn->close();

// Helper function to sanitize input
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>
<div class="container-box">
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <div>
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" value="<?php echo $username; ?>">
        <span><?php echo $username_err; ?></span>
    </div>
    <div>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password">
        <span><?php echo $password_err; ?></span>
    </div>
    <div>
        <input type="submit" value="Login">
    </div>
    <br>
    <div>
        <a href="user_registration.php">Not Registered Yet?</a>
    </div>
</form>
</div>

</body>
</html>
