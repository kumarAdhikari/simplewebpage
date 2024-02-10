<?php
// Connect to database
$host="127.0.0.1";
$port=3306;
$socket="";
$user="root";
$password="Jhapanepal8@";
$dbname="adhikari";

$conn = new mysqli($host, $user, $password, $dbname, $port, $socket)
or die ('Could not connect to the database server' . mysqli_connect_error());

//$con->close();

// Query to Select everything from product table
$sql = "SELECT * FROM product";
$result = $conn->query($sql);

// index.php ma jane data. All the items from table is fetched and sent to index.php
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<div class='product'>";
        echo "<img src='" . $row['productImage'] . "' alt='" . $row['productName'] . "'>";
        echo "<h3>" . $row['productName'] . "</h3>";
        echo "<p>$" . $row['productPrice'] . "</p>";
        ?>
        <form id="cartForm" action='cart.php' method='POST'>
            <input type='hidden' name='product_id' value='<?php echo $row['idproduct']; ?>'>
            <input type='hidden' name='item_name' value='<?php echo $row['productName']; ?>'>
            <input type='hidden' name='item_price' value='<?php echo $row['productPrice']; ?>'>
            <button type='submit' name='add_to_cart'>Add to Cart</button>
        </form>
        <?php
        echo "</div>";
}

} else {
    echo "No featured products found.";
}

$conn->close();
?>