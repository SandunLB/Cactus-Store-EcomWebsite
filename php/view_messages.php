<?php
// Include the connection file
include 'connection.php';

// Query to retrieve messages from the database
$sql = "SELECT * FROM messages";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>View Messages</title>
<link rel="stylesheet" href="../css/user.css">
</head>
<body>

<h2>Messages</h2>

<div class="container">
    <table>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Message</th>
        </tr>
        <?php
        // Check if there are any messages in the database
        if ($result->num_rows > 0) {
            // Output data of each row
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                echo "<td>" . htmlspecialchars($row['message']) . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='3'>No messages found.</td></tr>";
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
