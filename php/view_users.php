<?php
// Include the connection file
include 'connection.php';

// Query to retrieve user details from the database
$sql = "SELECT * FROM users";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Registered Users</title>
<link rel="stylesheet" href="../css/user.css">
</head>
<body>

<h2>Registered Users</h2>

<div class="container">
    <table>
        <tr>
            <th>Username</th>
            <th>Email</th>
            <th>Address</th>
            <th>Phone Number</th>
            <th>Postal Code</th>
        </tr>
        <?php
        // Check if there are any users in the database
        if ($result->num_rows > 0) {
            // Output data of each row
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['username'] . "</td>";
                echo "<td>" . $row['email'] . "</td>";
                echo "<td>" . $row['address'] . "</td>";
                echo "<td>" . $row['phone_number'] . "</td>";
                echo "<td>" . $row['postal_code'] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No users registered yet.</td></tr>";
        }
        ?>
    </table>
</div>

</body>
</html>

<?php
// Close connection
$conn->close();
?>
