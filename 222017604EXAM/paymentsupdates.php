<?php
// Connection details
include('database_coonection.php');

// Check if ID is set and form is submitted
if (isset($_GET['updateclient_id']) && isset($_POST['submit'])) {
    
   
    $t_id = $_POST['therapist_id'];
    $c_id = $_POST['client_id'];
    
    $am = $_POST['amount'];
    $p_d = $_POST['payment_date'];
    
   

    // Prepare and execute the UPDATE statement
    $stmt = $conn->prepare("UPDATE payments SET  therapist_id=?, client_id=?, amount=?,payment_date=?WHERE client_id=?");
    $stmt->bind_param("sssss", $p_id,  $t_id, $c_id, $am,$p_d);

    if ($stmt->execute()) {
        header('Location: payments .php?msg=Record updated successfully');
        exit();
    } else {
        echo "Error updating record: " . $stmt->error;
    }

    $stmt->close();
}

// Fetch existing data for the selected ID
if (isset($_GET['updatepayment_id'])) {
    $m_id = $_GET['updatepayment_id'];
    $sql_select = "SELECT * FROM payments WHERE payment_id=$p_id";
    $result = $conn->query($sql_select);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "No record found for ID: $id";
    }
}

$conn->close();






?>