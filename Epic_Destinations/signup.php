<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get user input
    $email = $_POST["email"];
    $password = $_POST["password"];
    
    // Validate user input (You can add more validation)
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format";
    } else {
        // Connect to the database (you should have a db connection)
        $conn = mysqli_connect("127.0.0.1", "root", " ", "epic_destinations_db");

        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // Check if the user already exists
        $checkSql = "SELECT * FROM users WHERE email = '$email'";
        $checkResult = mysqli_query($conn, $checkSql);

        if (mysqli_num_rows($checkResult) > 0) {
            echo "User with this email already exists";
        } else {
            // Insert the new user into the database
            $insertSql = "INSERT INTO users (email, password) VALUES ('$email', '$password')";
            
            if (mysqli_query($conn, $insertSql)) {
                echo "Registration successful"; // You can redirect to a login page here
            } else {
                echo "Error: " . $insertSql . "<br>" . mysqli_error($conn);
            }
        }

        mysqli_close($conn);
    }
}
?>
