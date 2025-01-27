<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$database = "attendance_manager";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $index = $_POST['index'];
    $subjectCode = $_POST['subjectCode'];

    // Insert data into the database
    $sql = "INSERT INTO students (name, index_number, subject_code) VALUES ('$name', '$index', '$subjectCode')";

    if ($conn->query($sql) === TRUE) {
        echo "Data saved successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
