<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Mess Details</title>
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <!--/* The above code is including the Bootstrap CSS file in a PHP file. It is using the `<link>` tag
    to specify the location of the CSS file and the `rel` attribute to define the relationship
    between the current document and the linked file. In this case, it is specifying that the linked
    file is a stylesheet. */-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="detailsentrystyle.css">
</head>
<body>
    <div class="wrapper">
        <aside id="sidebar">
            <div class="d-flex">
                <button class="toggle-btn" type="button">
                    <i class="lni lni-grid-alt"></i>
                </button>
                <div class="sidebar-logo">
                    <a href="#">Mess Management</a>
                </div>
            </div>
            <ul class="sidebar-nav">
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link">
                        <i class="lni lni-user"></i>
                        <span>Profile</span>
                    </a>
                </li>
                
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse"
                        data-bs-target="#auth" aria-expanded="false" aria-controls="auth">
                        <i class="lni lni-protection"></i>
                        <span>Auth</span>
                    </a>
                    <ul id="auth" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                        <li class="sidebar-item">
                            <a href="#" class="sidebar-link">Login</a>
                        </li>
                        <li class="sidebar-item">
                            <a href="#" class="sidebar-link">Register</a>
                        </li>
                    </ul>
                </li>
               
                
            <div class="sidebar-footer">
                <a href="logout.php" class="sidebar-link">
                    <i class="lni lni-exit"></i>
                    <span>Logout</span>
                </a>
            </div>
        </aside>
        <div class="main p-3">
            <div class="text-center">
            <div class = "container">
        <h1>Enter student Details</h1>
        <form action = "detailsentry.php" method="post">
            <label for = "month">Select the Month</label>
            <input type = "month" name = "month" id = "month" required>
            <div class = "table-responsive">
            <table class = "table">
                <tr>
                    <th>Student id</th>
                    <th>Student Name</th>
                    <th>Days Present</th>
                    <th>Days Absent</th>
                    <th>Non-veg</th>
                    <th>Veg</th>
                    <th>Food charges</th>
                    <th>Veg charges</th>
                    <th>Non-veg charges</th>
                    <th>Room charges</th>
                    <th>Total</th>
                </tr>

                <?php
                 /* The above code is including the "database.php" file in the PHP script. */
                    
                    require_once "database.php";
                    $sql = "SELECT student_id,full_name FROM users";
                    /* The above code is executing a query on a database using the PHP mysqli
                    extension. The result of the query is stored in the variable . */
                    
                    $result = $connect->query($sql);
                    
                    
                    
                    if ($result && $result->num_rows > 0) {
                        // Fetch each row one by one
                        while($studentinfo = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            /* The above code is printing the value of the 'student_id' key from the
                             array inside a table cell. The value is first passed
                            through the htmlspecialchars function to ensure that any special
                            characters are properly encoded. */
                            echo "<td>" . htmlspecialchars($studentinfo['student_id']) . "</td>";
                            echo "<td>" . htmlspecialchars($studentinfo['full_name']) . "</td>";
                            echo "<td><input type='text' class = 'dayspresent[...]' id ='dayspresent' name='dayspresent[" . $studentinfo['student_id'] . "]' onchange = 'calculatefoodcharges(event)'></td>";
                            echo "<td><input type='text' name='daysabsent[" . $studentinfo['student_id'] . "]'></td>";
                            echo "<td><input type='text' id = 'nonvegdays'class = 'nonvegdays[...]' name='non-veg[" . $studentinfo['student_id'] . "]' onchange = 'calculatenonvegcharges(event)'></td>";
                            echo "<td><input type='text'id ='vegdays' class ='vegdays[...]'  name='veg[" . $studentinfo['student_id'] . "]' onchange = 'calculatevegcharges(event)'></td>";
                            echo "<td><input type='text' class = 'foodcharges' name='foodcharges[" . $studentinfo['student_id'] . "]'readonly></td>";
                            echo "<td><input type='text' class = 'vegcharges'name='vegcharges[" . $studentinfo['student_id'] . "]'readonly></td>";
                            echo "<td><input type='text' class = 'nonvegcharges' name='non-vegcharges[" . $studentinfo['student_id'] . "]'readonly></td>";
                            echo "<td><input type='text' id ='roomcharges' class ='roomcharges[...]' name='roomcharges[" . $studentinfo['student_id'] ."]' onchange = 'calculateTotal(event)'></td>";
                            echo "<td><input type='text' class = 'total' name='total[" . $studentinfo['student_id'] . "]' readonly></td>";

                            echo "</tr>"; // Make sure you close the <tr> tag inside the loop
                        }
                    } else {
                        echo "<tr><td colspan='2'>No students found.</td></tr>";
                    }

                    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                        // Begin a transaction
                        $connect->begin_transaction(MYSQLI_TRANS_START_READ_WRITE);
                        $sql = "SELECT student_id,full_name FROM users";
                        $result = $connect->query($sql);
                        $studentinfo = mysqli_fetch_assoc($result);
                    
                        try {
                            // Prepare the SQL statement for inserting data
                            $stmt = $connect->prepare("INSERT INTO messdetailsinsertion1 (student_id,full_name, timeline,days_present, days_absent, non_veg, veg, food_charges, veg_charges, non_veg_charges, room_charges, total) VALUES (?, ?,?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                            if ($stmt === false) {
                                // Handle error in prepare statement
                                throw new Exception("Prepare statement failed: " . $connect->error);
                            }
                            // Loop through the submitted data and bind parameters for each student
                            foreach ($_POST['dayspresent'] as $student_id => $days_present) {
                                $sql = "SELECT student_id, full_name FROM users WHERE student_id = ?";
                                $user_stmt = $connect->prepare($sql);
                                $user_stmt->bind_param("s", $student_id);
                                $user_stmt->execute();
                                $student_result = $user_stmt->get_result();
                                $studentinfo = $student_result->fetch_assoc();
                               
                                
                                
                                $months = $_POST['month'];
                                $days_present =$_POST['dayspresent'][$student_id];
                                $days_absent = $_POST['daysabsent'][$student_id];
                                $non_veg = $_POST['non-veg'][$student_id];
                                $veg = $_POST['veg'][$student_id];
                                $food_charges = $_POST['foodcharges'][$student_id];
                                $veg_charges = $_POST['vegcharges'][$student_id];
                                $non_veg_charges = $_POST['non-vegcharges'][$student_id];
                                $room_charges = $_POST['roomcharges'][$student_id];
                                $total = $_POST['total'][$student_id]; // Ensure this is calculated server-side or validated if calculated client-side
                    
                                // Bind and execute the statement for each student
                                $stmt->bind_param("sssiiiiiiiii",$studentinfo['student_id'],$studentinfo['full_name'] ,$months, $days_present, $days_absent, $non_veg, $veg, $food_charges, $veg_charges, $non_veg_charges, $room_charges, $total);
                                if (!$stmt->execute()) {
                                    // Handle execution error
                                    die("Error executing statement: " . $stmt->error);
                                }
                                $stmt->execute();
                            }
                    
                            // Commit the transaction
                            $connect->commit();
                            echo "Records inserted successfully.";
                            
            
                    
                        } catch (Exception $e) {
                            // An exception has occurred, which means that one of our database queries failed.
                            // Roll back the transaction.
                            $connect->rollback();
                            // Handle the error
                            echo "Error: " . $e->getMessage();
                        }
                    
                        // Close the statement and the connection
                        $stmt->close();
                        $connect->close();
                    } else {
                        echo "Enter Student Details";
                    }
                ?>
            </table>
        </div>
        <div class="submit-container">
    <button class = "btn btn-primary" type="submit" name="submit">Submit</button>
</div>
        </form>
</div>
    </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>
    <script src="script.js"></script>
    <script>
     
     function calculateTotal(event) {
    var inputElement = event.target;
    var row = inputElement.closest('tr');

    // Fetch the values of each input field within the same row
    var daysPresent = parseFloat(row.querySelector('#dayspresent').value) || 0;
    var roomCharges = parseFloat(row.querySelector('#roomcharges').value) || 0;
    var vegdays = parseFloat(row.querySelector('#vegdays').value) || 0;
    var nonvegdays = parseFloat(row.querySelector('#nonvegdays').value) || 0;

    // Perform the calculation
    var total = (daysPresent * 70) + roomCharges + (vegdays * 40) + (nonvegdays * 70);
    console.log(total);
    row.querySelector('.total').value = total.toFixed(2);
}

function calculatefoodcharges(event) {
    var inputElement = event.target;
    var daysPresent = parseFloat(inputElement.value) || 0;
    var food_charges = daysPresent * 70;

    // Find the '.foodcharges' input in the same row and update its value
    var row = inputElement.closest('tr');
    var foodChargesInput = row.querySelector('.foodcharges');
    foodChargesInput.value = food_charges.toFixed(2);
}
    function calculatevegcharges(event) {
    var inputElement = event.target;
    var vegdays = parseFloat(inputElement.value) || 0;
    var vegcharges = vegdays * 15;
    console.log(vegcharges);

    var row = inputElement.closest('tr');
    row.querySelector('.vegcharges').value = vegcharges.toFixed(2);
}
    function calculatenonvegcharges(event) {
    var inputElement = event.target;
    var nonvegdays = parseFloat(inputElement.value) || 0;
    var nonvegcharges = nonvegdays * 70;
    console.log(nonvegcharges);
    var row = inputElement.closest('tr');
    row.querySelector('.nonvegcharges').value = nonvegcharges.toFixed(2);
}
    </script>
</body>
</html>