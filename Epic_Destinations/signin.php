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
        $conn = mysqli_connect("127.0.0.1", "root", "", "epic_destinations_db");

        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // Query the database to check if the user exists
        $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) == 1) {
            // Login successful, use JavaScript to redirect to static1.html
            echo '<script>window.location.href = "static1.html";</script>';
            exit; // Make sure to exit after the JavaScript redirection
        } else {
            echo "Check Email and Password";
        }

        mysqli_close($conn);
    }
}
?>
