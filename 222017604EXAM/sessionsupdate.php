<?php
/ Connection details
include('database_coonection.php');

// Check if ID is set and form is submitted
if (isset($_GET['updatesession_id']) && isset($_POST['submit'])) {
    $s_id = $_POST['session_id'];
    $t_id = $_POST['therapist_id'];
    $c_id = $_POST['client_id'];
    
    $s_d = $_POST['session_date'];
    $s_n = $_POST['session_notes'];
    $str = $_POST['start_time'];
    $end= $_POST['end_time']
   ;

    // Prepare and execute the UPDATE statement
    $stmt = $conn->prepare("UPDATE sessions SET session_id=?,therapist_id=?, client_id=?, rating=?, review_text=?,  WHERE therapist_id=?");
    $stmt->bind_param("iisssss",$s_id,$t_id,$c_id,$s_d,$s_n,$str,$end );

    if ($stmt->execute()) {
        header('Location: sessions.php?msg=Record updated successfully');
        exit();
    } else {
        echo "Error updating record: " . $stmt->error;
    }

    $stmt->close();
}

// Fetch existing data for the selected ID
if (isset($_GET['updatesession_id'])) {
    $id = $_GET['updatesession_id'];
    $sql_select = "SELECT * FROM sessions WHERE session_id=$s_id";
    $result = $conn->query($sql_select);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "No record found for ID: $id";
    }
}

$conn->close();
?>