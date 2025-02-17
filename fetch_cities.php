<?php
include 'db_connect.php';

if (isset($_GET['state_id'])) {
    $state_id = $_GET['state_id'];
    $query = "SELECT * FROM city WHERE state_id = $state_id";
    $result = mysqli_query($conn, $query);

    echo '<option value="">Select City</option>';
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<option value='{$row['id']}' data-lat='{$row['latitude']}' data-lng='{$row['longitude']}'>{$row['name']}</option>";
    }
}
?>
