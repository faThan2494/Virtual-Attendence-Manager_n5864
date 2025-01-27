<?php
session_start();
// Database connection
$host = 'localhost';
$dbname = 'attendance_manager';
$username = 'root'; 
$password = ''; // Replace with your DB password

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Fetch total registered students
    $stmt = $pdo->query("SELECT COUNT(*) AS count FROM students");
    $registeredStudents = $stmt->fetch(PDO::FETCH_ASSOC)['count'];

    // Fetch total sessions
    $stmt = $pdo->query("SELECT COUNT(DISTINCT subject_code) AS count FROM students");
    $totalSessions = $stmt->fetch(PDO::FETCH_ASSOC)['count'];

    // Pie chart data
    $stmt = $pdo->query("SELECT 
        (SELECT COUNT(*) FROM students WHERE subject_code = 'subject1') AS present,
        (SELECT COUNT(*) FROM students WHERE subject_code = 'subject2') AS absent");
    $pieData = $stmt->fetch(PDO::FETCH_ASSOC);

    // Bar chart data
    $stmt = $pdo->query("SELECT subject_code, COUNT(*) AS count FROM students GROUP BY subject_code");
    $barChartData = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Prepare response
    $response = [
        "registeredStudents" => $registeredStudents,
        "totalSessions" => $totalSessions,
        "pieChartData" => array_values($pieData),
        "barChartLabels" => array_column($barChartData, 'subject_code'),
        "barChartData" => array_column($barChartData, 'count')
    ];

    echo json_encode($response);

} catch (PDOException $e) {
    echo json_encode(["error" => $e->getMessage()]);
}
?>
