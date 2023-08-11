<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "my_database";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Check if the email exists in the database
    $sql = "SELECT email, password FROM users WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $storedPassword = $row["password"];

        // Verify the password
        if (password_verify($password, $storedPassword)) {
            header("Location: monthly_price.html");
            exit();
        } else {
            echo "Incorrect password.";
        }
    } else {
        echo "Email not found.";
    }
}

$conn->close();
?>