<?php
// Database connection settings
$servername = "localhost";  // Change this to your database server if needed
$usernameDB = "root";       // Replace with your database username
$passwordDB = "";           // Replace with your database password
$dbname = "deptmang";  // Replace with your database name

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Create the connection
$conn = mysqli_connect($servername, $usernameDB, $passwordDB, $dbname);

// Check the connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm-password'];

    // Check if passwords match
    if ($password === $confirmPassword) {
        // Hash the password before storing it
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Prepare the SQL query to insert data into the database
        $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$hashedPassword')";

        // Execute the query
        if (mysqli_query($conn, $sql)) {
            // Redirect to the login page if signup is successful
            header("Location: login.html");
            exit();  // Exit to ensure no further code is executed
        } else {
            echo "SQL Error: " . mysqli_error($conn);
        }
    } else {
        echo "Passwords do not match!";
    }
}

// Close the connection
mysqli_close($conn);
?>
