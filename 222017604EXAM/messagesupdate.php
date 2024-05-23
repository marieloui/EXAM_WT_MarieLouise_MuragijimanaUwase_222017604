<?
// Connection details
include('database_coonection.php');

// Check if ID is set and form is submitted
if (isset($_GET['updatemessage_id']) && isset($_POST['submit'])) {
    
    
    $t_id = $_POST['therapist_id'];
    $c_id = $_POST['client_id'];
    
    $m_c = $_POST['message_content'];
    
   

    // Prepare and execute the UPDATE statement
    $stmt = $conn->prepare("UPDATE messages SET  therapist_id=?, client_id=?, message_content=?WHERE client_id=?");
    $stmt->bind_param("sss",   $t_id, $c_id, $m_c );

    if ($stmt->execute()) {
        header('Location: messages.php?msg=Record updated successfully');
        exit();
    } else {
        echo "Error updating record: " . $stmt->error;
    }

    $stmt->close();
}

// Fetch existing data for the selected ID
if (isset($_GET['updatemessage_id'])) {
    $m_id = $_GET['updatemessage_id'];
    $sql_select = "SELECT * FROM messages WHERE message_id=$c_id";
    $result = $conn->query($sql_select);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "No record found for ID: $id";
    }
}

$conn->close();





?>