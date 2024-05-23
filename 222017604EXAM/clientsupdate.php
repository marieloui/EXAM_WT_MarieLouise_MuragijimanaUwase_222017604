<?php
// Connection details
include('database_coonection.php');

// Check if ID is set and form is submitted
if (isset($_GET['updateID']) && isset($_POST['submit'])) {
    
    $fname = $_POST['full_name'];
    
    $email = $_POST['email'];
    $phone = $_POST['telephone'];
   

    // Prepare and execute the UPDATE statement
    $stmt = $conn->prepare("UPDATE clients SET full_name=?,  email=?, telephone=? WHERE client_id=?");
    $stmt->bind_param("sssi", $full_name, $email, $phone, $c_id);

    if ($stmt->execute()) {
        header('Location: clients.php?msg=Record updated successfully');
        exit();
    } else {
        echo "Error updating record: " . $stmt->error;
    }

    $stmt->close();
}

// Fetch existing data for the selected ID
if (isset($_GET['updateclient_id'])) {
    $c_id = $_GET['updateclient_id'];
    $sql_select = "SELECT * FROM clients WHERE clients=$c_id";
    $result = $conn->query($sql_select);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "No record found for ID: $id";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Online therapy platform</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css">
    <style>
        /* Add your CSS styles here */
        body {
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 600px;
            margin: auto;
            padding: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="email"],
        textarea,
        select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        .btn-secondary {
            background-color: #ccc;
            color: #000;
        }

        .btn-secondary:hover {
            background-color: #999;
        }

        /* Responsive styles */
        @media (max-width: 768px) {
            .container {
                padding: 10px;
            }
        }

    </style>
</head>
<body>
    <div class="container">
        <?php
        if (isset($_GET['msg'])) {
            $msg = $_GET['msg'];
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">' . $msg . '
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
        }
        ?>
        <h2>Update Doctor Record</h2>
        <form method="POST" action="" onsubmit="return confirmUpdate();">
            <input type="hidden" name="client_id" value="<?php echo $row['client_id']; ?>">

            <div class="form-group">
                <label for="full_name">Fullname:</label>
                <input type="text" id="full_name" name="full_name" value="<?php echo $row['full_name']; ?>" required>
            </div>
            
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?php echo $row['email']; ?>" required>
            </div>
            <div class="form-group">
                <label for="telephone">Phone Number:</label>
                <input type="text" id="telephone" name="telephone" value="<?php echo $row['telephone']; ?>" required>
            </div>
           
          
            <div class="form-group">
                <input type="submit" name="submit" value="Update" class="btn btn-primary">
                <a href="clients.php" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</body>
</html>
