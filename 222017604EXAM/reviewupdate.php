<?php
/ Connection details
include('database_connection.php');

// Check if ID is set and form is submitted
if (isset($_GET['updatetherapist_id']) && isset($_POST['submit'])) {
    $t_id = $_POST['therapist_id'];
    $c_id = $_POST['client_id'];
    
    $rat = $_POST['rating'];
    $revi = $_POST['review_text'];
    
   

    // Prepare and execute the UPDATE statement
    $stmt = $conn->prepare("UPDATE reviews SET therapist_id=?, client_id=?, rating=?, review_text=?,  WHERE therapist_id=?");
    $stmt->bind_param("iiss",$t_id,$c_id,$rat,$revi );

    if ($stmt->execute()) {
        header('Location: reviews.php?msg=Record updated successfully');
        exit();
    } else {
        echo "Error updating record: " . $stmt->error;
    }

    $stmt->close();
}

// Fetch existing data for the selected ID
if (isset($_GET['updatetherapist_id'])) {
    $id = $_GET['updatetherapist_id'];
    $sql_select = "SELECT * FROM reviews WHERE therapist_id=$t_id";
    $result = $conn->query($sql_select);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "No record found for ID: $id";
    }
}

$conn->close();



?>