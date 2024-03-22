<!DOCTYPE html>
<html lang="en">
<head>
<?php
   session_start(); // Start the session at the beginning
   include "inc/head.inc.php";
   $config = parse_ini_file('/var/www/private/db-config.ini');
    if (!$config)
    {
        $errorMsg = "Failed to read database config file.";
        $success = false;
    }
    else
    {
        $conn = new mysqli(
            $config['servername'],
            $config['username'],
            $config['password'],
            $config['dbname']
        );
        // Check connection
        if ($conn->connect_error)
        {
            $errorMsg = "Connection failed: " . $conn->connect_error;
            $success = false;
        }
        else
        {
            // Fetch food products from the database
            $sql = "SELECT foodName, foodPrice FROM foodItems";
            $result = $conn->query($sql);
        }
        $conn->close();
    }

?>
</head>
<body>
<?php
   session_start(); // Start the session at the beginning
   include "inc/header.inc.php";
?>
<div class="heading">
   <h3>Our Menu</h3>
   <p><a href="home.php">Home </a> <span> / Menu</span></p>
</div>

<section class="products">

   <h1 class="title">All Menu</h1>

   <div class="box-container">
   <?php
    // Check if there are any products fetched from the database
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $foodName = $row["foodName"];
            $foodPrice = $row["foodPrice"];
    ?>
            <form action="add_cart.php" method="post" class="food-form">
                <input type="hidden" name="foodName" value="<?= $foodName ?>">
                <input type="hidden" name="foodPrice" value="<?= $foodPrice ?>">
                <article class="food-product">
                    <h2><?= $foodName ?></h2>
                    <p>Price: $<?= $foodPrice ?></p>
                    <figure>
                        <img src="images/Food/<?= $foodName ?>.png" alt="<?= $foodName ?>" class="food-thumbnail" width="200" height="200"/>
                    </figure>
                    <button type="submit" class="btn-order">Add To Cart</button>
                </article>
            </form>
    <?php
        }
    } else {
        echo "No products found.";
    }
    $conn->close();
    ?>
   
   </div>

</section>
<?php
   include "inc/footer.inc.php";
?>
<div class="loader">
   <img src="images/loader.gif" alt="">
</div>

<script src="js/script.js"></script>

</body>
</html>
