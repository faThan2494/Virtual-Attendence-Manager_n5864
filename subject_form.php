<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Database connection
$servername = "localhost";
$username = "root"; // your database username
$password = ""; // your database password
$dbname = "subject_db"; // your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Insert data when the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the form data
    $name = $_POST['name'];
    $index = $_POST['index'];

    // Capture subject code from the URL
    $subjectCode = $_POST['subjectCode']; // No need to get it from the form; we pass it from the URL.

    // Check if the form data is not empty
    if (empty($name) || empty($index) || empty($subjectCode)) {
        echo "All fields are required.";
    } else {
        // Prepare and bind
        $stmt = $conn->prepare("INSERT INTO subjects (name, index_code, subject_code) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $index, $subjectCode); // "sss" means 3 strings
        
        if ($stmt->execute()) {
            echo "New record created successfully!";
            // Redirect to the info page after a 45-second delay
            header("Refresh:45; url=info.php");
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    }
}

// Close the connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Subject Page</title>
  <style>
    /* Your CSS Styles Here */
  </style>
</head>
<body>
  <div class="container">
    <h1 id="subject-header">Subject Code</h1>
    <form method="POST" id="student-form">
      <input type="text" id="name" name="name" placeholder="Enter your name" required>
      <input type="text" id="index" name="index" placeholder="Enter your index number" required>
      <!-- Hidden field for subjectCode, passed through the URL -->
      <input type="hidden" name="subjectCode" value="<?php echo isset($_GET['subjectCode']) ? $_GET['subjectCode'] : ''; ?>" />
      <input type="submit" value="Submit">
    </form>
  </div>

  <script>
    // Extract subject code from URL query parameters
    const urlParams = new URLSearchParams(window.location.search);
    const subjectCode = urlParams.get('subjectCode');

    // Set the subject code in the header
    if (subjectCode) {
      document.getElementById('subject-header').textContent = `Subject Code: ${subjectCode}`;
    } else {
      document.getElementById('subject-header').textContent = "No Subject Code Provided";
    }

    // Handle form submission (handled by PHP via POST)
    document.getElementById('student-form').addEventListener('submit', function (event) {
      event.preventDefault(); // Prevent form reload
    });

    // Close the page after 45 seconds
    setTimeout(function() {
      window.close();  // This will close the Home page
    }, 45000); // 45 seconds
  </script>
</body>
</html>
