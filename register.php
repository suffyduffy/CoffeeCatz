<!DOCTYPE html>
<html lang="en">
<head>
<?php
   include "inc/head.inc.php";
?>
    <style>
    body {
        background-image: url('images/background_6.png');
        background-size: cover;
        background-repeat: no-repeat;
        margin: 0; /* Ensure there's no default margin */
    }
</style>
</head>
<body>
<?php
   include "inc/header.inc.php";
?>
<main>
<section class="form-container">
   <form action="process_register.php" method="post">
      <h1 style="font-size: 40px;">Register Now</h1>
    <input type="text" name="fname" placeholder="Enter your name" class="box" maxlength="50">

    <input type="text" name="lname" required placeholder="Enter your last name" class="box" maxlength="50">

    <input type="password" name="password" required placeholder="Enter your password" class="box" minlength="8" oninput="this.value = this.value.replace(/\s/g, '')">

    <input type="password" name="pwd_confirm" required placeholder="Confirm your password" class="box" minlength="8" oninput="this.value = this.value.replace(/\s/g, '')">

    <input type="text" name="address" required placeholder="Enter your address" class="box" maxlength="255">

    <input type="email" name="email" required placeholder="Enter your email" class="box" maxlength="255" oninput="this.value = this.value.replace(/\s/g, '')">

    <input type="submit" value="Register now" name="submit" class="btn">

    <p>Already have an account? <a href="login.php">Login Now</a></p>
</form>
</section>
</main>

    <?php 
        include "inc/footer.inc.php"; 
    ?>
<div class="loader">
   <img src="images/loader.gif" alt="">
</div>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>