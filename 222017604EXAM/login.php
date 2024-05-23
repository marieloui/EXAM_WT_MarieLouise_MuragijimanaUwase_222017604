<?php
include('database_coonection.php');
if (isset($_POST['username'], $_POST['password'])) {
    $username = $_POST['username']; 
    $password = $_POST['password'];

    // Prepare an SQL statement to select the user by username
    $stmt = $conn->prepare("SELECT * FROM register WHERE Username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Fetch the user data
        $user = $result->fetch_assoc();
        
        // Verify the password
        if (password_verify($password, $user['Password'])) {
            // Password is correct, redirect to home page
            header("Location: home.html");
            exit();
        } else {
            echo "Error: Incorrect password.";
        }
    } else {
        echo "Error: Username not found.";
    }

    // Close the statement
    $stmt->close();
} else {
    echo "Error: Please provide both username and password.";
}

// Close the connection
$conn->close();
?>
 