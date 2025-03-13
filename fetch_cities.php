<?php
include 'db_connect.php'; // Include database connection

if (isset($_GET['state_id'])) {
    $state_id = intval($_GET['state_id']); // Ensure 'state_id' is a valid integer

    if ($state_id > 0) {
        // Fetch cities based on the selected state
        $query = "SELECT * FROM city WHERE state_id = ?";
        $stmt = mysqli_prepare($conn, $query);
        
        if ($stmt) {
            // Bind the 'state_id' parameter to the prepared statement
            mysqli_stmt_bind_param($stmt, "i", $state_id);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            echo '<option value="">Select City</option>';
            // Fetch and display each city as an option in the dropdown
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<option value='{$row['id']}' data-lat='{$row['latitude']}' data-lng='{$row['longitude']}'>{$row['name']}</option>";
            }

            mysqli_stmt_close($stmt); // Close statement
        } else {
            echo '<option value="">Error fetching cities</option>';
        }
    } else {
        echo '<option value="">Invalid State ID</option>';
    }
} else {
    echo '<option value="">State ID not provided</option>';
}

mysqli_close($conn); // Close database connection
?>