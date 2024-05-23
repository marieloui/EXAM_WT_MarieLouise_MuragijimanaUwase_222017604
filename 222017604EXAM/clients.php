<?php
// Connection
include('database_coonection.php');

// Insert data if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Prepare and bind the parameters
    $stmt = $conn->prepare("INSERT INTO clients (full_name, email, telephone) VALUES (?,  ?, ?)");

    // Check if the statement was prepared successfully
    if ($stmt === false) {
        die("Error in preparing statement: " . $conn->error);
    }

    // Bind parameters
    $stmt->bind_param("sss", $full_name, $email,  $phone);

    // Set parameters and execute
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    
    $phone = $_POST['telephone'];

    if ($stmt->execute()) {
        echo "New record has been added successfully";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}

// Selecting data from the database
$sql_select = "SELECT * FROM clients";

// Check if search form is submitted
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['search'])) {
    $search = $_GET['search'];
    // Add search condition to SQL query
    $sql_select .= " WHERE client_id LIKE '%$search%' OR full_name LIKE '%$search%' OR email LIKE  '%$search%' OR telephone LIKE '%$search%' ";
}

$result = $conn->query($sql_select);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> ONLINE THERAPY PLAFORMt</title>
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
<label class="logo" >otp <br>
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
    
    <h2>Patient page </h2>
    <div class="container">
        <?php
        if(isset($_GET['msg'])){
            $msg = $_GET['msg'];
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">' . $msg . '
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
        }
        ?>
        <a href="clients.html" class="btn btn-success">Add New</a>
    </div>
    <br>
    <form method="GET" action="">
        <input type="text" name="search" placeholder="Search...">
        <button type="submit" class="btn btn-primary">Search</button>
    </form>

    <table id="dataTable" class="table table-hover text-center">
        <tr>
        
            <th>client_id</th>
            <th>$full_name</th>
            
            <
            
            <th>email</th>
            <th>telephone</th>
            
            <th>action</th>
           
        </tr>
        <?php
        // Output data of each row
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                
                echo "<td>" . $row["client_id"] . "</td>";
                echo "<td>" . $row["full_name"] . "</td>";
                
                
                
                echo "<td>" . $row["email"] . "</td>";
                echo "<td>" . $row["telephone"] . "</td>";
                
                echo "<td>";
                echo "<a href='clientsupdate.php?updateclient_id=" . $row['client_id'] . "'><i class='fas fa-edit'></i></a>";
                echo "<a href='clientstdelete.php?client_id=" . $row['client_id'] . "'><i class='fas fa-trash'></i></a>";
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