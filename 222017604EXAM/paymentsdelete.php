<?


// Connection details
include('database_coonection.php');

// Check if therapist_id is set
if(isset($_REQUEST['payment_id'])) {
    $p_id = $_REQUEST['payment_id'];
    
    // Prepare and execute the DELETE statement
    $stmt = $conn->prepare("DELETE FROM payments WHERE client_id=?");
    $stmt->bind_param("i", $c_id);
    
    if ($stmt->execute()) {
        header('location:payments.php?msg=Delete data successful');
        exit(); // Stop further execution
    } else {
        echo "Error deleting data: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "click here to confirm";
}

$conn->close();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>online therapy platform</title>
    <script>
        function confirmDelete() {
            return confirm("Are you sure you want to delete this record?");
        }
    </script>
</head>
<body>
<button onclick="if(confirmDelete(<?php echo $_REQUEST['payment_id']; ?>)) { window.location.href = 'payments.php?message_id=<?php echo $_REQUEST['payment_id']; ?>'; }">Delete Record</button>
</body>
</html>