
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="stylecart.css">
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
<div class="container">
    <h1>Cart</h1>
    <?php
    session_start(); // Start the session
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }
    // Add items to the cart
    if (isset($_POST['add_to_cart'])) {
        $item_id = $_POST['product_id'];
        $item_name = $_POST['item_name'];
        $item_price = $_POST['item_price'];

    // Check if item already exists in cart
    $item_index = array_search($item_id, array_column($_SESSION['cart'], 'id'));
    if ($item_index !== false) {
        // if item already there then increase quantity
        $_SESSION['cart'][$item_index]['quantity']++;
    } else {
        // Item does not exist in cart, add new item
        $_SESSION['cart'][] = ['id' => $item_id, 'name' => $item_name, 'price' => $item_price, 'quantity' => 1];
    }

    echo "<p>Item added to cart: $item_name ($" . number_format($item_price, 2) . ")</p>";
}

// Remove item from cart
if (isset($_POST['remove_item'])) {
    $item_index = $_POST['item_index'];
    unset($_SESSION['cart'][$item_index]);
}

// Display cart contents
if (!empty($_SESSION['cart'])) {
    echo "<table>";
    echo "<tr><th>Item</th><th>Price</th><th>Quantity</th><th>Action</th></tr>";
    $total_price = 0;
    foreach ($_SESSION['cart'] as $index => $item) {
        echo "<tr><td>{$item['name']}</td><td>$" . number_format($item['price'], 2) . "</td><td>{$item['quantity']}</td>";
        echo "<td><form method='post'><input type='hidden' name='item_index' value='$index'><button type='submit' name='remove_item'>Remove</button></form></td></tr>";
        $total_price += $item['price'] * $item['quantity'];
    }
    echo "<tr class='total'><td>Total</td><td colspan='2'>$" . number_format($total_price, 2) . "</td><td></td></tr>";
    echo "</table>";
} else {
    echo "<p>Your cart is empty.</p>";
}
?>
</div>
</body>
</html>