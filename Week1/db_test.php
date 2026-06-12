<?php
$conn = mysqli_connect("localhost", "root", "", "");
if ($conn) {
    echo "<p style='color:green;'>Database connection successful.</p>";
} else {
    echo "<p style='color:red;'>Connection failed: " . mysqli_connect_error() . "</p>";
}
?>