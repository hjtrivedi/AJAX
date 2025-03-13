<?php
include 'db_connect.php'; // Include database connection

if (isset($_GET['country_id'])) {
    $country_id = intval($_GET['country_id']); // Ensure 'country_id' is a valid integer

    if ($country_id > 0) {
        // Fetch states based on the selected country
        $query = "SELECT * FROM state WHERE country_id = ?";
        $stmt = $conn->prepare($query);

        if ($stmt) {
            // Bind the country ID parameter to prevent SQL injection
            $stmt->bind_param("i", $country_id);
            $stmt->execute();
            // Fetch the result set from the query
            $result = $stmt->get_result();
        
            // Add a default option for the dropdown
            echo '<option value="">Select State</option>';
    
            // Loop through each row in the result set and populate the dropdown
            while ($row = $result->fetch_assoc()) {
                echo "<option value='{$row['id']}' data-lat='{$row['latitude']}' data-lng='{$row['longitude']}'>{$row['name']}</option>";
            }        

            $stmt->close(); // Close statement
        } else {
            echo '<option value="">Error fetching states</option>';
        }
    } else {
        echo '<option value="">Invalid Country ID</option>';
    }
} else {
    echo '<option value="">Country ID not provided</option>';
}

$conn->close(); // Close database connection
?>