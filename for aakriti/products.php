<?php
                // Connect to database (replace with your connection details)
                $servername = "localhost";
                $username = "your_username";
                $password = "your_password";
                $dbname = "your_database";

                $conn = new mysqli($servername, $username, $password, $dbname);

                // to check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // Query to Select products 
                $sql = "SELECT id, name, image, price FROM products WHERE featured = 1 LIMIT 2";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<div class='product'>";
                        echo "<img src='" . $row['image'] . "' alt='" . $row['name'] . "'>";
                        echo "<h3>" . $row['name'] . "</h3>";
                        echo "<p>$" . $row['price'] . "</p>";
                        echo "<form action='cart.php' method='post'>";
                        echo "<input type='hidden' name='product_id' value='" . $row['id'] . "'>";
                        echo "<button type='submit'>Add to Cart</button>";
                        echo "</form>";
                        echo "</div>";
                    }
                } else {
                    echo "No featured products found.";
                }

                $conn->close();
            ?>