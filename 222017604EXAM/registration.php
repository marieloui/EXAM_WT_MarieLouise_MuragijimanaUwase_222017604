<?php
include('database_coonection.php');

// Retrieve and sanitize form inputs
$firstname = htmlspecialchars($_POST['firstname'], ENT_QUOTES, 'UTF-8');
$lastname = htmlspecialchars($_POST['lastname'], ENT_QUOTES, 'UTF-8');
$username = htmlspecialchars($_POST['username'], ENT_QUOTES, 'UTF-8');
$email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
$telephone = htmlspecialchars($_POST['telephone'], ENT_QUOTES, 'UTF-8');
$password = $_POST['password']; // We'll hash this later

// Hash the password before storing
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Prepare an SQL statement for safe insertion
$stmt = $conn->prepare("INSERT INTO register (Firstname, Lastname, Username, Email, telephone, Password) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssss", $firstname, $lastname, $username, $email, $telephone, $hashed_password);

// Execute the statement and check for errors
if ($stmt->execute()) {
    echo "Successfully registered!";
    // Redirect to login page
    header("Location: login.html");
    exit();
} else {
    echo "Error: " . $stmt->error;
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>
