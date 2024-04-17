<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>User Registration</title>
<link rel="stylesheet" href="../css/registration.css">
</head>
<body>

<h2>User Registration</h2>

<?php
// Include the connection file
include 'connection.php';

// Initialize variables
$username = $password = $email = $address = $phone_number = $postal_code = "";
$username_err = $password_err = $email_err = $address_err = $phone_number_err = $postal_code_err = "";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $username = test_input($_POST['username']);
    $password = $_POST['password'];
    $email = test_input($_POST['email']);
    $address = test_input($_POST['address']);
    $phone_number = test_input($_POST['phone_number']);
    $postal_code = test_input($_POST['postal_code']);

    // Validate username
    if (empty($username)) {
        $username_err = "Please enter a username.";
    }

    // Validate password
    if (empty($password)) {
        $password_err = "Please enter a password.";
    }

    // Validate email
    if (empty($email)) {
        $email_err = "Please enter an email address.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $email_err = "Invalid email format.";
    }

    // Validate address
    if (empty($address)) {
        $address_err = "Please enter an address.";
    }

    // Validate phone number
    if (empty($phone_number)) {
        $phone_number_err = "Please enter a phone number.";
    }

    // Validate postal code
    if (empty($postal_code)) {
        $postal_code_err = "Please enter a postal code.";
    }

    // Check if there are no errors before inserting into database
    if (empty($username_err) && empty($password_err) && empty($email_err) && empty($address_err) && empty($phone_number_err) && empty($postal_code_err)) {
        // Check if username or email already exists
        $sql = "SELECT id FROM users WHERE username = ? OR email = ?";
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("ss", $username, $email);
            $stmt->execute();
            $stmt->store_result();
            
            if ($stmt->num_rows > 0) {
                // User already exists
                echo "Username or email already registered. Please login.";
                header("refresh:3;url=user_login.php"); // Redirect to login page after 3 seconds
                exit();
            }
            $stmt->close();
        }

        // Insert new user into database
        $sql = "INSERT INTO users (username, password, email, address, phone_number, postal_code) VALUES (?, ?, ?, ?, ?, ?)";
        if ($stmt = $conn->prepare($sql)) {
            // Hash password for security
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            
            $stmt->bind_param("ssssss", $username, $hashed_password, $email, $address, $phone_number, $postal_code);
            if ($stmt->execute()) {
                echo "User registered successfully. Redirecting to login page...";
                header("refresh:3;url=user_login.php"); // Redirect to login page after 3 seconds
                exit();
            } else {
                echo "Error: " . $stmt->error;
            }
            $stmt->close();
        }
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
        <span><?php echo $username_err; ?></span>
        <input type="text" id="username" name="username" value="<?php echo $username; ?>">
        
    </div>
    <div>
        <label for="password">Password:</label>
        <span><?php echo $password_err; ?></span>
        <input type="password" id="password" name="password">
        
    </div>
    <div>
        <label for="email">Email:</label>
        <span><?php echo $email_err; ?></span>
        <input type="email" id="email" name="email" value="<?php echo $email; ?>">
        
    </div>
    <div>
        <label for="address">Address:</label>
        <span><?php echo $address_err; ?></span>
        <input type="text" id="address" name="address" value="<?php echo $address; ?>">
        
    </div>
    <div>
        <label for="phone_number">Phone Number:</label>
        <span><?php echo $phone_number_err; ?></span>
        <input type="tel" id="phone_number" name="phone_number" value="<?php echo $phone_number; ?>">
        
    </div>
    <div>
        <label for="postal_code">Postal Code:</label>
        <span><?php echo $postal_code_err; ?></span>
        <input type="text" id="postal_code" name="postal_code" value="<?php echo $postal_code; ?>">
        
    </div>
    <div>
        <input type="submit" value="Register">
    </div>
</form>
</div>

</body>
</html>
