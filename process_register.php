<!DOCTYPE html>
<html lang="en">
<head>
    <?php
        include "inc/head.inc.php";
    ?>
</head>
<body>
<?php
$lastName = $email = $password = $confirmPassword =  $address = $errorMsg = "";
$success = true;

// Function to sanitize input
function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Validate first name
if (empty($_POST["fname"])) {
    $errorMsg .= "First name is required.<br>";
    $success = false;
} else {
    $firstName = sanitize_input($_POST["fname"]);
}

// Validate last name
if (empty($_POST["lname"])) {
    $errorMsg .= "Last name is required.<br>";
    $success = false;
} else {
    $lastName = sanitize_input($_POST["lname"]);
}

// Validate password
if (empty($_POST["password"])) {
    $errorMsg .= "Password is required.<br>";
    $success = false;
} else {
    $password = $_POST["password"];
}

// Validate password confirmation
if (empty($_POST["pwd_confirm"])) {
    $errorMsg .= "Confirm Password is required.<br>";
    $success = false;
} else {
    $confirmPassword = $_POST["pwd_confirm"];

    // Check if password and confirmation match
    if ($password !== $confirmPassword) {
        $errorMsg .= "Password and Confirm Password do not match.<br>";
        $success = false;
    }
}

// Validate address
if (empty($_POST["address"])) {
    $errorMsg .= "Address is required.<br>";
    $success = false;
} else {
    $address = $_POST["address"];
}


// Validate email
if (empty($_POST["email"])) {
    $errorMsg .= "Email is required.<br>";
    $success = false;
} else {
    $email = sanitize_input($_POST["email"]);

    // Additional check to make sure email address is well-formed.
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errorMsg .= "Invalid email format.<br>";
        $success = false;
    }
}


if ($success) {
    // Hash the password before storing it
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Call the function to save member data to the database
    saveMemberToDB();
    header("Location: success.php");

} else {
    echo '<main>';
    echo '<section class="about">';
    echo '<div class="row">';
    echo '<div class="content">';
    echo '<h1 style="text-align: center; font-size: 40px; color: black;">Registration Failed</h1>';
    echo '<p style="text-align: center; font-size: 32px; color: black;">' . $errorMsg . '</p>';
    echo '<a href="login.php" class="btn" style="text-align: center; font-size: 28px;">Register Again</a>';
    echo '</div>';
    echo '</div>';
    echo '</section>';
    echo '</main>';
}

// Helper function to write the member data to the database.
function saveMemberToDB()
{
    global $lastName, $email, $hashedPassword, $errorMsg, $address,$firstName, $success;
    // Create database connection.
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
            // Prepare the statement:
            $stmt = $conn->prepare("INSERT INTO cafe_members (fname, lname, email, password, address) VALUES (?,?,?,?,?)");
            // Bind & execute the query statement:
            $stmt->bind_param("sssss", $firstName, $lastName, $email, $hashedPassword, $address);
            if (!$stmt->execute())
            {
                $errorMsg = "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
                $success = false;
                echo $errorMsg;
            }
            $stmt->close();
        }
        $conn->close();
    }
}
?>
</body>
</html>