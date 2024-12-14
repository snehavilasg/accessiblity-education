<?php
// Include the database connection
include('config.php');

// Start a session
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get email and password from POST request
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validate inputs
    if (empty($email) || empty($password)) {
        echo "Email and password are required!";
        exit;
    }

    // Prepare the SQL query to fetch the user by email
    $sql = "SELECT * FROM login WHERE email = ?";

    // Prepare the statement
    if ($stmt = $conn->prepare($sql)) {
        // Bind parameters (s = string, b = blob, etc)
        $stmt->bind_param("s", $email);

        // Execute the query
        $stmt->execute();

        // Get the result
        $result = $stmt->get_result();

        // Check if user exists
        if ($result->num_rows > 0) {
            // Fetch the user data
            $row = $result->fetch_assoc();

            // Verify the password (ensure the password in the database is hashed)
            if (password_verify($password, $row['password'])) 
            {
                // If password matches
                echo "Login successful!";
                // Start session and store user data
                $_SESSION['email'] = $row['email'];  // Store email in session
                $_SESSION['name'] = $row['name'];    // Optionally, store other user details
                
                // Redirect to dashboard (or another page)
                header("Location: dashboard.php");
                exit();
            } 
            else 
            {
                // Password doesn't match
                echo "Invalid password!";
            }
        } else {
            // User does not exist
            echo "No user found with that email!";
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
