<?php
session_start();

// Database connection details (Afnu database ko details ya rakhne )
$host = "127.0.0.1";
$port = 3306;
$socket = "";
$user = "root";
$password = "Jhapanepal8@";
$dbname = "adhikari";

// Create connection
$conn = new mysqli($host, $user, $password, $dbname, $port, $socket);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Form submission handle garne
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $productImage = $_POST['productImage'];
    $productName = $_POST['productName'];
    $productPrice = $_POST['productPrice'];

    // Prepare and execute SQL statement
    $sql = "INSERT INTO product (productImage, productName, productPrice) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);

    // Bind parameters
    $stmt->bind_param("sss", $productImage, $productName, $productPrice);

    // Execute statement
    if ($stmt->execute()) {
        // Set success message
        $_SESSION['message'] = "Product added successfully!";
        // Redirect to addproductform.php
        header("refresh:1;url=addproductform.php");
        exit();
    } else {
        // Check if the error is due to duplicate entry
        if ($stmt->errno == 1062) { // 1062 is the error code for duplicate entry
            $_SESSION['message'] = "Error adding product: Duplicate entry detected.";
            header("refresh:1;url=addproductform.php");
            exit();
        } else {
            echo "Error adding product: " . $stmt->error;
        }
    }

    // Close statement
    $stmt->close();
}

// Close database connection
$conn->close();
?>
