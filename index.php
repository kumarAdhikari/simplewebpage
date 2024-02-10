<?php
session_start(); // Start the session

// Initialize the cart session if it hasn't been already. This is how we keep track of item being added.
if (!isset($_SESSION['cart'])) {
$_SESSION['cart'] = [];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop</title>
    <link rel="stylesheet" href="style.css">
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
    <main>
        <section class="products">
            <h2>Our Products</h2>
            <div class="product-grid">
                <?php include 'products.php'; ?>
            </div>
        </section>
    </main>
    <footer>
        </footer>
</body>
</html>
