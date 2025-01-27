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

// Fetch data from the database
$sql = "SELECT * FROM students";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Student Info</title>
  <link href="5864.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  
  <style>
        body {
      display: flex;
      flex-direction: column;
      min-height: 100vh;
      margin: 0; /* Remove any default margin */
    }
    table {
      width: 100%;
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
    footer {
      margin-top: auto;
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
    h1 {
     margin-top: 20px; 
     text-align: center;
     color: #333;
    }
   
  </style>
</head>
<body>
<body class="bg-transparent">
  
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

  <h1>Student Information</h1>
  <div class="table-responsive">
  <table class="table">
  
  <table>
    <tr>
      <th>ID</th>
      <th>Name</th>
      <th>Index Number</th>
      <th>Subject Code</th>
      <th>Submission Time</th>
    </tr>
    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['name']}</td>
                    <td>{$row['index_number']}</td>
                    <td>{$row['subject_code']}</td>
                    <td>{$row['submission_time']}</td>
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='5'>No records found</td></tr>";
    }
    $conn->close();
    ?>
  </table>
  </table>
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
