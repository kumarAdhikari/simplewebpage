<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <link rel="stylesheet" href="styleaddproduct.css">
</head>
<body>
<header>
    <nav>
        <ul>
            <li><a href="index.php">HOME</a></li>
            <li><a href="addproductform.php">ADD ITEM</a></li>
            <li><a href="aboutus.html">ABOUT US</a></li>
            <li><a href="cart.php">CART</a></li>
        </ul>
    </nav>
</header>
<div>
<h2>Add Product</h2>
<div id="message" class="message"></div>
<form id="productForm" action="addproducts.php" method="POST">
    <label for="productImage">Product Image URL:</label><br>
    <input type="text" id="productImage" name="productImage"><br>
    <label for="productName">Product Name:</label><br>
    <input type="text" id="productName" name="productName"><br>
    <label for="productPrice">Product Price:</label><br>
    <input type="number" id="productPrice" name="productPrice"><br><br>
    <input type="submit" value="Submit">
</form>
</div>
<script>
    // Function to show message with animation
    function showMessage(message) {
        var messageDiv = document.getElementById("message");
        messageDiv.textContent = message;
        messageDiv.style.opacity = 1;
        messageDiv.classList.add("pop-in");

        setTimeout(function() {
            messageDiv.classList.add("pop-out");
            setTimeout(function() {
                messageDiv.style.opacity = 0;
                messageDiv.classList.remove("pop-in", "pop-out");
            }, 1000);
        }, 5000);
    }

    // Check if message is set and display it
    <?php
    session_start();
    if (isset($_SESSION['message'])) {
        echo "showMessage('" . $_SESSION['message'] . "');";
        unset($_SESSION['message']); // Clear the session variable
    }
    ?>
</script>
</body>
</html>
