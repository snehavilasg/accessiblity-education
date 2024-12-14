<?php
// Include database connection file
include('config.php');

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $usn = $_POST['usn'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $dob = $_POST['dob'];
    $area = $_POST['area'];
    $location = $_POST['location'];
    $income = $_POST['income'];
    $disability = $_POST['disability'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirmpassword'];

    // Check if passwords match
    if ($password !== $confirm_password) {
        echo "Passwords do not match!";
        exit;
    }

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Prepare the SQL query to insert data into the users table
    $sql = "INSERT INTO registration (usn, name, email, phone, dob, area, location, income, disability, password, confirmpassword) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
?,
    // Prepare statement
    if ($stmt = $conn->prepare($sql)) {
        // Bind parameters
        $stmt->bind_param($usn, $name, $email, $phone, $dob, $area, $location, $income, $disability, $hashed_password);

        // Execute the query
        if ($stmt->execute()) {
            echo "Registration successful!";
            // Redirect to login page or another page
            header("Location: login.php");
            exit;
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    } else {
        echo "Error: " . $conn->error;
    }
}

// Close the connection
$conn->close();
?>
