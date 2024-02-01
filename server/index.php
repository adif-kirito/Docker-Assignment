<!DOCTYPE html>
<html>
<head>
    <title>Simple Form</title>
</head>
<body>

<h2>Enter Name and Phone Number</h2>
<form method="post" action="submit.php">
    Name: <input type="text" name="name"><br>
    Phone Number: <input type="text" name="phone"><br>
    <input type="submit" value="Submit">
</form>

<?php
// Database connection
$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "myDB";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $phone = $_POST['phone'];

    // Insert data into database
    $sql = "INSERT INTO contacts (name, phone) VALUES ('$name', '$phone')";
    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Output all data from the database
$sql = "SELECT * FROM contacts";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<h2>Contacts</h2>";
    echo "<table border='1'><tr><th>Name</th><th>Phone Number</th></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["name"]. "</td><td>" . $row["phone"]. "</td></tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}

$conn->close();
?>

</body>
</html>
