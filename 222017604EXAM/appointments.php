<?php

// Connection
include('database_coonection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Assuming you have a valid database connection in $conn

    // Prepare and bind the parameters
    $stmt = $conn->prepare("INSERT INTO appointments (therapist_id, client_id, appointment_time, appointment_notes) VALUES (?, ?, ?, ?)");

    // Check if the statement was prepared successfully
    if (!$stmt) {
        die("Error in preparing statement: " . $conn->error);
    }

    // Bind parameters
    $stmt->bind_param("ssss", $t_id, $c_id, $p_t, $p_n);

    // Set parameters (assuming you've received these values from the form)
    $t_id = $_POST['therapist_id'];
    $c_id = $_POST['client_id'];
    $p_t = $_POST['appointment_time'];
    $p_n = $_POST['appointment_notes'];

    // Execute the statement
    if ($stmt->execute()) {
        echo "Appointment added successfully!";
    } else {
        echo "Error executing statement: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
}

  

// Selecting data from the database
$sql_select = "SELECT * FROM appointments";

// Check if search form is submitted
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['search'])) {
    $search = $_GET['search'];
    // Add search condition to SQL query
    $sql_select .= " WHERE therapist_id LIKE '%$search%' OR client_id LIKE '%$search%' OR appointment_time LIKE '%$search%' OR appointment_notes LIKE '%$search%'  ";
}

$result = $conn->query($sql_select);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>online therapy PLATFORM</title>
    <link rel="stylesheet" href="style.css">
    <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="
sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap-theme.min.css
" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js" integrity="
sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

<style>
    /* Add your CSS styles here */
    table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
  </style>
</head>
<body>
    
<label class="logo" >CMS <br>
            (online therapist PLATFORM)</label>
        <ul>
            <li><a href="home.html">Home</a></li>
            <li><a href="about.html">About us</a></li>
            <li><a href="contact.html">Contact us</a></li>
           
            
            <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                Services  <span class="caret"></span></a>
                <ul class="dropdown-menu">

                <li><a href="clients.php">Patient Records</a></li>
                    <li><a href="therapist.php">Doctor Records</a></li>
                    <li><a href="messages.php"> RESULT FROM SESSION </a></li>
                    <li><a href="payments.php"> PAYMENT Records</a></li>
                    <li><a href="appointments.php">Appointment Records</a></li>
                    <li><a href="review.php"> RATE THE SESSION  </a></li>
                    <li><a href="sessions.php">  HEALING TIME   </a></li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="#" class="btn btn-success dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                Settings <span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="registration.html">Register</a></li>
                    <li><a href="login.html">Login</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </li>
            
        </ul>
    </nav>
    
    <h2>APPOINTment page </h2>
    <div class="container">
        <?php
        if(isset($_GET['msg'])){
            $msg = $_GET['msg'];
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">' . $msg . '
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
        }
        ?>
        <a href="appointments.html" class="btn btn-success">Add New</a>
    </div>
    <br>
    <form method="GET" action="">
        <input type="text" name="search" placeholder="Search...">
        <button type="submit" class="btn btn-primary">Search</button>
    </form>

    <table id="dataTable" class="table table-hover text-center">
        <tr>
            <th>therapist_id</th>
            <th>client_id</th>
            
            <th>appointment_time</th>
            <th>appointment_notes</th>
            <th>action</th>
           
        </tr>
        <?php
        // Output data of each row
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["therapist_id"] . "</td>";
                echo "<td>" . $row["client_id"] . "</td>";
                
                echo "<td>" . $row["appointment_time"] . "</td>";
                echo "<td>" . $row["appointment_notes"] . "</td>";
                
                

                echo "<td>";
                echo "<a href='appointmentsupdate.php?updateappointment_notes=" . $row['appointment_notes'] . "'><i class='fas fa-edit'></i></a>";
                echo "<a href='appointmentstdelete.php?appointment_notes=" . $row['appointment_notes'] . "'><i class='fas fa-trash'></i></a>";
                echo "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='9'>No data found</td></tr>";
        }
        ?>
    </table>


    <!-- Include Bootstrap and Font Awesome JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>

</section><br><br><br>
    <footer>
        <ul>
            <li><a href="home.html">Home</a></li>
            <li><a href="about.html">About us</a></li>
            <li><a href="contact.html">Contact us</a></li>
            
        </ul>
        <p>&copy; 2024 My Website. All rights reserved.</p>
    </footer>
</body>
</html>