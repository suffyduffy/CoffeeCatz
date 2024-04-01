<header class="header">
   <section class="flex">
      <a href="home.php" class="logo"><img src="images/Icons/CafeLogo4.png" alt="Cat WebCafe Logo" width="100" height="100"></a>
      <nav class="navbar">
        <?php
            // Determine active page
            $current_page = basename($_SERVER['PHP_SELF']);
            $menu_active = $current_page == 'menu.php' ? 'active' : '';
            $about_active = $current_page == 'about.php' ? 'active' : '';
            $contact_active = $current_page == 'contact.php' ? 'active' : '';
            $orders_active = $current_page == 'orders.php' ? 'active' : '';
            $cart_active = $current_page == 'cart.php' ? 'active' : '';
        ?>
        <a href="menu.php" class="<?= $menu_active ?>" style="font-size: 36px; color: #323232;">Menu</a>
        <a href="cart.php" class="<?= $cart_active ?>"style="font-size: 36px; color: #323232;">Cart</a>
        <a href="orders.php" class="<?= $orders_active ?>"style="font-size: 36px; color: #323232;">Orders</a>
        <a href="about.php" class="<?= $about_active ?>"style="font-size: 36px; color: #323232;">About Us</a>
        <a href="contact.php" class="<?= $contact_active ?>"style="font-size: 36px; color: #323232;">Contact Us</a>
      </nav>

      <div class="icons">
         <?php
            // Check if the user is logged in
            if (isset($_SESSION['fname'])) {
               // Display the user's name over the user icon
               echo '<a href="update_profile.php" class="user-btn" aria-label="update"><div class="user-name" style="color: black;">' . $_SESSION['fname'] . '</div></a>';
               echo '<a href="logout.php" aria-label="logout"><i class="fa fa-sign-out"></i></a>';
            } else {
               // Display a login icon if the user is not logged in
               echo '<a href="login.php" aria-label="login"><i class="fas fa-user" style="color: white;"></i></a>';
            }
         ?>
         <div id="user-btn" class=""></div>
         <div id="menu-btn" class="fas fa-bars"></div>
      </div>
   </section>
</header>

<style>
/* Navigation link styles */
.navbar a {
   padding: 10px 15px; /* Adjust padding as needed */
   transition: background-color 0.3s, color 0.3s; /* Smooth transition for hover effect */
   text-decoration: none; /* Remove underline from links */
   font-family: 'Baskerville', serif;
}

/* Hover effect for navigation links */
.navbar a:hover {
   background-color: #F0EDE5; /* Highlight color on hover */
   color: black; /* Text color on hover, change if needed */
   border-radius: 5px; /* Rounded corners for the highlight, optional */
}

/* Active link styles */
.active {
   background-color: #F0EDE5; /* Optional: if you want to highlight the active item with background color as well */
   border-radius: 5px;
   color: white; /* Active item text color, change if needed */
}
</style>