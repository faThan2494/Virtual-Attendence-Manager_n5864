<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$database = "attendance_manager";

$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize variables
$search_code = isset($_POST['subject_code']) ? $_POST['subject_code'] : '';
$filtered_students = [];
$error_message = "";

// Fetch data based on the search subject code
if ($search_code) {
    $stmt = $conn->prepare("SELECT * FROM students WHERE subject_code = ? ORDER BY submission_time");
    $stmt->bind_param("s", $search_code);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $submission_date = date("Y-m-d", strtotime($row['submission_time']));
            $filtered_students[$submission_date][] = $row;
        }
    } else {
        $error_message = "No records found for subject code '$search_code'.";
    }
    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Subject Code Search</title>
  <link href="5864.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
        font-family: Arial, sans-serif;
        display: flex;
        flex-direction: column;
        min-height: 100vh;
    }
    h1, h3, h4 {
      text-align: center;
      color: #333;
    }
    h1{
      margin: 20px;
    }
    .alert {
      margin-top: 15px;
    }
    table {
      width: 100%;
      margin-top: 20px;
      border-collapse: collapse;
    }
    table, th, td {
      border: 1px solid #ddd;
    }
    th, td {
      padding: 10px;
      text-align: center;
    }
    th {
      background-color: #f4f4f4;
    }
    .search-bar {
      margin: 20px auto;
      max-width: 400px;
      text-align: center;
    }
    .container {
      flex: 1; 
     }

     footer {
      background-color: rgb(33, 37, 41);
      padding: 30px;
      text-align: center;
      color: rgb(42, 205, 210);
    }

    .github, .linkedin {
      color: lightgray;
      text-decoration: none;
      margin: 0 10px;
    }

    .navbar-dark .navbar-nav .nav-link {
    color: rgb(42, 205, 210); 
    transition: color 0.3s; 
    }
    .navbar-dark .navbar-nav .nav-link:hover {
    color: rgb(255, 255, 255); 
  }

  /* Change brand color */
  .navbar-dark .navbar-brand {
    color:rgb(42, 205, 210); 
  }

  .navbar-dark .navbar-brand:hover {
    color: rgb(255, 255, 255); 
  }
  </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="afterloginhome.html">Virtual Attendance Manager</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="afterloginhome.html">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="qrcode.html">Generate QR Code</a>
          </li>
          
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="dashbord.html" id="dashboardDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Dashboard
            </a>
            <ul class="dropdown-menu" aria-labelledby="dashboardDropdown">
              <li><a class="dropdown-item" href="dashbord.html">Overview</a></li>
              <li><a class="dropdown-item" href="info.php">Data Panel</a></li>
              <li><a class="dropdown-item" href="individual_data.php">Individual Data</a></li>
              
            </ul>
          </li>
          
          <li class="nav-item">
            <a class="nav-link" href="#">Help</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="logout.php">Logout</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container">
    <h1>Subject Code Search</h1>

    <!-- Search Bar -->
    <div class="search-bar">
      <form method="POST" action="">
        <input 
          type="text" 
          name="subject_code" 
          class="form-control mb-3" 
          placeholder="Enter Subject Code" 
          value="<?= htmlspecialchars($search_code); ?>" 
          required>
        <button type="submit" class="btn btn-info">Search</button>
      </form>
    </div>

    <!-- Error Message -->
    <?php if ($error_message): ?>
      <div class="alert alert-danger"><?= $error_message; ?></div>
    <?php endif; ?>

    <!-- Table Section -->
    <?php if (!empty($filtered_students)): ?>
      <div class="table-section">
        <h3>Details for Subject Code: <?= htmlspecialchars($search_code); ?></h3>
        <?php foreach ($filtered_students as $date => $students): ?>
          <h4>Submission Date: <?= $date; ?></h4>
          <table>
            <thead>
              <tr>
                <th>Name</th>
                <th>Index Number</th>
                <th>Subject Code</th>
                <th>Submission Time</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($students as $student): ?>
                <tr>
                  <td><?= htmlspecialchars($student['name']); ?></td>
                  <td><?= htmlspecialchars($student['index_number']); ?></td>
                  <td><?= htmlspecialchars($student['subject_code']); ?></td>
                  <td><?= htmlspecialchars($student['submission_time']); ?></td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
  </div>




  <footer>
     <p>&copy;2025 Muhammed Thanweer Fahim. All rights reserved.<br>Contact Us : 0771379613<br>Email : fahimthanweer09@gmail.com</p>
  
    <a href="https://github.com/faThan2494/Virtual-attendence-manager.git" class="github">
     <i class="bi bi-github"></i>
    </a>

    <a href="https://www.linkedin.com/notifications/?filter=all" class="linkedin">
     <i class="bi bi-linkedin"></i>
    </a>

  </footer>














</body>
</html>

