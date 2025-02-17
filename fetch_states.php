<?php
include 'db_connect.php';

if (isset($_GET['country_id'])) {
    $country_id = $_GET['country_id'];

    $query = "SELECT * FROM state WHERE country_id = $country_id";
    $result = $conn->query($query);

    echo '<option value="">Select State</option>';
    while ($row = $result->fetch_assoc()) {
        echo "<option value='{$row['id']}' data-lat='{$row['latitude']}' data-lng='{$row['longitude']}'>{$row['name']}</option>";
    }
}
?>
