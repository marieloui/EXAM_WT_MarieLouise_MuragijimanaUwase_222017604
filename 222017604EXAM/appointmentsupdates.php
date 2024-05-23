<?php


// Connection details
include('database_coonection.php');
// Initialize ID variable
$appointment_id = null;

// Check if ID is set and form is submitted
if (isset($_GET['updateID']) && isset($_POST['submit'])) {


    // Get ID from hidden 
    
    $c_id = $_POST['client_id'];
    $t_id = $_POST['therapist_id'];
    $date = $_POST['appointment_date'];
    $time = $_POST['appointment_time'];
    $appointment_notes = $_POST['appointment_notes'];
    
   

    // Prepare and execute the UPDATE statement
    $stmt = $conn->prepare("UPDATE appointments SET  therapist_id=?, client_id=?,appointment_time,appointment_notes WHERE appointment_id=?");
    $stmt->bind_param("sssi",, $time, $t_id,$c_id, $appointment_notes,);

    if ($stmt->execute()) {
        header('Location: appointments.php?msg=Record updated successfully');
        exit();
    } else {
        echo "Error updating record: " . $stmt->error;
    }

    $stmt->close();
}

// Fetch existing data for the selected ID
if (isset($_GET['updateappointment_id'])) {
    $appointment_id = $_GET['updateappointment_id'];
    $sql_select = "SELECT * FROM appointments WHERE client_id=$client_id";
    $result = $conn->query($sql_select);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (!$row) {
            echo "Error fetching appointment data.";
            exit(); // Terminate script
        }
    } else {
        echo "No record found for ID: $appointment_id";
        exit(); // Terminate script
    }
}

$conn->close();







?>