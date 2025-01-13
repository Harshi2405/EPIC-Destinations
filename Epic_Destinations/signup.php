<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Retrieve form data
    $email = $_POST["email"];
    $password = $_POST["createPassword"];
    $rePassword = $_POST["reEnterPassword"];

    // Perform any necessary data validation/sanitization here

    // Check if the passwords match
    if ($password !== $rePassword) {
        echo "Passwords do not match.";
        exit; // Stop further execution if passwords do not match
    }

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Connect to the database (replace with your database credentials)
    $db_host = "127.0.0.1"; // usually "localhost"
    $db_user = "root"; // replace with your MySQL username
    $db_password = ""; // replace with your MySQL password
    $db_name = "epic_destinations_db"; // replace with the name of your database

    // Create a database connection
    $conn = new mysqli($db_host, $db_user, $db_password, $db_name);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and execute the SQL query to insert data into the table
    $sql = "INSERT INTO users (email,hasedPassword) 
            VALUES (?,?)";
    $stmt=$conn->prepare($sql);
    $stmt->bind_param("ss", $email, $hashedPassword);
    if ($stmt->execute()) {
        echo "data inserted";
    } else {
        echo "error".$stmt->error;
    }
    if ($conn->query($sql) === TRUE) {
        // Data inserted successfully, redirect back to the HTML form
        header("Location: index.html");
        exit; // Make sure to exit to prevent further execution of the script
    } else {
        echo "Error inserting data: " . $conn->error;
    }

    // Close the database connection
    $conn->close();
}
?>
