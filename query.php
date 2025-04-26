<?php
require 'conn.php';
session_start();

// Registration function
function register($conn) {
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
        $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
        $fullname = "$firstname $lastname";
        $dob = mysqli_real_escape_string($conn, $_POST['dob']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $tel = mysqli_real_escape_string($conn, $_POST['tel']);
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $usertype = mysqli_real_escape_string($conn, $_POST['utype']);
        $password = mysqli_real_escape_string($conn, $_POST['pwd']);
        $location = mysqli_real_escape_string($conn, $_POST['location']);

        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        
        // Check for duplicate email or reg
        $check_sql = "SELECT * FROM USERS WHERE email = '$email'";
        $result = mysqli_query($conn, $check_sql);

        if (mysqli_num_rows($result) > 0) {
            echo "Error: Duplicate email";
        } else {
            // Insert new user
            $sql = "INSERT INTO USERS (fullname, Date_of_Birth, email, phone_number, username, user_type, password, location)
                    VALUES ('$fullname', '$dob', '$email', '$tel', '$username', '$usertype','$hashed_password', '$location')";

            if (mysqli_query($conn, $sql)) {
                echo "Registration successful!";
                header('Location: login.php');
            } else {
                echo "Error: " . mysqli_error($conn);
            }
        }
    }
}

// Login function
function login($conn) {
    $email = '';

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = mysqli_real_escape_string($conn, $_POST['pwd']);

        $sql3 = "SELECT * FROM USERS WHERE email = '$email'";
        $result = mysqli_query($conn, $sql3);

        if (mysqli_num_rows($result) > 0) {
            $user = mysqli_fetch_assoc($result);
            // Verify the password
            if (password_verify($password, $user['password'])) {
                // Store user information in session
                $_SESSION['user_id'] = $user['user_id'];
                $_SESSION['user_email'] = $user['email'];
                $_SESSION['fullname'] = $user['fullname'];
                $_SESSION['user_name'] = $user['username'];
                $_SESSION['user_type'] = $user['user_type'];
                
                $sql = 'CREATE TABLE IF NOT EXISTS LOGS(
                    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                    user_id VARCHAR(100) NOT NULL,
                    fullname VARCHAR(50) NOT NULL,
                    username VARCHAR(50) NOT NULL,
                    usertype VARCHAR(50) NOT NULL,
                    email VARCHAR(30) NOT NULL,
                    last_loggedin TIMESTAMP DEFAULT CURRENT_TIMESTAMP
                    )';
            
                if (mysqli_query($conn, $sql)) {
                    echo "LOG table has been created<br>";
                } else {
                    echo "Error: " . mysqli_error($conn);
                }
                    
                $sql2 = "INSERT INTO LOGS(user_id, fullname, username, usertype, email)
                        VALUES ('" . $user['user_id'] . "', '" . $user['fullname'] . "', '" . $user['username'] . "', '" . $user['user_type'] . "','" . $email . "')";
            
                if (mysqli_query($conn, $sql2)){
                    echo "LOGS table has been updated!<br>";
                } else {
                    echo "Error: ". mysqli_error($conn);
                }

                echo "Login successful!<br>";
                header('Location: agrocart.php');

            } else {
                echo "Invalid password!";
            }

        } else {
            echo "Account associated with that email does not exist.";
        }
    }
        
}

function add_product($conn) {
    $admin_id = $_SESSION['user_id'];
    $admin_name = $_SESSION['fullname'];

    if ($_SERVER["REQUEST_METHOD"] === "POST"){
        $pname = mysqli_real_escape_string($conn, $_POST['pname']);
        $cname = mysqli_real_escape_string($conn, $_POST['cname']);
        $price = mysqli_real_escape_string($conn, $_POST['price']);
        $stock = mysqli_real_escape_string($conn, $_POST['stock']);
        $category = mysqli_real_escape_string($conn, $_POST['cat']);
        
        $date = "";
        $pmethod = "";
        $expiry_date = "";
        if ($category == "fresh") {
            $date = mysqli_real_escape_string($conn, $_POST['time']);
        } elseif ($category =="preserved") {
            $date = mysqli_real_escape_string($conn, $_POST['time']);
            $pmethod = mysqli_real_escape_string($conn, $_POST['preservation']);
        } else{
            $expiry_date = mysqli_real_escape_string($conn, $_POST['expiry']);
        }
        
        $sql = 'CREATE TABLE IF NOT EXISTS PRODUCT (
                id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                product_id VARCHAR(36) NOT NULL DEFAULT (UUID()),
                product_name VARCHAR(50) NOT NULL,
                product_company VARCHAR(50) NOT NULL,
                product_price VARCHAR(50) NOT NULL,
                product_stock VARCHAR(50) NOT NULL,
                product_category VARCHAR(20) NOT NULL,
                product_date VARCHAR(30) NOT NULL,
                product_expiry_date VARCHAR(30) NOT NULL,
                preservation_method VARCHAR(100) NOT NULL,
                admin_name VARCHAR(40) NOT NULL,
                admin_id VARCHAR(36) NOT NULL,
                Date_of_product_creation TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )';

        if (mysqli_query($conn, $sql)){
            echo "PRODUCT table has been sucessfully created!";
        } else {
            echo "Error: ". mysqli_error($conn);
        }

        $sql2 = "INSERT INTO PRODUCT(product_name, product_company, product_price, product_stock, product_category, product_date, product_expiry_date, preservation_method, admin_name, admin_id)
                VALUES ('$pname', '$cname', '$price', '$stock', '$category', '$date', '$expiry_date', '$pmethod', '$admin_name', '$admin_id')";
        
        if(mysqli_query($conn, $sql2)) {
            echo "Values inserted into the table successfully.";
        } else {
            echo "Error: ". mysqli_error($conn);
        }

    }
}


function calculateDaysBetween($date1, $date2) {
    // Convert dd/mm/yy to DateTime objects
   // $date1_parts = explode('/', $date1);
    $date2_parts = explode('/', $date2);

    // Ensure years are treated as 20yy
    $date1_obj = date_create($date1);
    $date2_obj = date_create('20' . $date2_parts[2] . '-' . $date2_parts[1] . '-' . $date2_parts[0]);

    // Get difference
    $diff = date_diff($date1_obj, $date2_obj);

    // Return absolute number of days
    return $diff->days;
}

function featured_products($conn) {

    $sql = 'CREATE TABLE IF NOT EXISTS PRODUCT (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        product_id VARCHAR(36) NOT NULL DEFAULT (UUID()),
        product_name VARCHAR(50) NOT NULL,
        product_company VARCHAR(50) NOT NULL,
        product_price VARCHAR(50) NOT NULL,
        product_stock VARCHAR(50) NOT NULL,
        product_category VARCHAR(20) NOT NULL,
        product_date VARCHAR(30) NOT NULL,
        product_expiry_date VARCHAR(30) NOT NULL,
        preservation_method VARCHAR(100) NOT NULL,
        admin_name VARCHAR(40) NOT NULL,
        admin_id VARCHAR(36) NOT NULL,
        Date_of_product_creation TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )';

    if (mysqli_query($conn, $sql)){
        $response = "PRODUCT table has been sucessfully created! <br>";
    } else {
        echo "Error: ". mysqli_error($conn);
    }
    
    $count = 1;

    $date2 = date('d/m/y');

    $sql3 = "SELECT * FROM PRODUCT WHERE product_stock >= 1";
    $result = mysqli_query($conn, $sql3);
    if (mysqli_num_rows($result) > 0) {
        echo "<table style='width:100%; margin-left: auto; margin-right: auto;'>";
        $count = 0;
        while ($row = mysqli_fetch_assoc($result)) {
            $date1 = $row['product_date'];
            $days = calculateDaysBetween($date1, $date2); 

            // Start a new row every 3 items
            if ($count % 3 == 0) {
                echo "<tr>";
            }

            echo "<td style = 'padding: 10px; vertical-align: top;'><div style='display: flex; justify-content: center;'><div style='text-align: left; width: max-content;'>";
            if ($row['product_category'] == 'packaged'){
                echo $row['product_name'] . "(" . $row['product_category']. ")<br>";
            } else {
                echo $row['product_name'] . " - " . $row['product_category'] . " ($days days)<br>";
            }
            echo "NGN " . $row['product_price'] . "<br>";
            echo $row['product_company'] . "<br>";

            echo "<form method='POST' action=''>";
            echo "<input type='number' name='order_quantity' value='1' min='1'> ";
            echo "<input type='hidden' name='product_id' value='".$row['product_id']."'>";
            echo "<input type='hidden' name='product_name' value='".$row['product_name']."'>";
            echo "<input type='hidden' name='product_price' value='".$row['product_price']."'>";
            echo "<input type='hidden' name='product_company' value='".$row['product_company']."'>";
            echo "<input type='submit' name='action' value='Add to Cart'>";
            echo "</form>";
            echo "</div></div></td>";

            $count++;

            // Close the row after 3 items
            if ($count % 3 == 0) {
                echo "</tr>";
            }
        }

        // Close the last row if it's not a multiple of 3
        if ($count % 3 != 0) {
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "Products are currently unavailable.";
    }

}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['action'] ?? '') === 'Add to Cart') {
    // Display the RSVP-specific events
    add_to_cart($conn);
}

function add_to_cart($conn) {
    $user_id = $_SESSION['user_id'];
    $fullname = $_SESSION['fullname'];
    $email = $_SESSION['user_email'];

    if ($_SERVER["REQUEST_METHOD"] === "POST"){
        $product_id = mysqli_real_escape_string($conn, $_POST['product_id']);
        $product_name = mysqli_real_escape_string($conn, $_POST['product_name']);
        $product_price = mysqli_real_escape_string($conn, $_POST['product_price']);
        $product_company = mysqli_real_escape_string($conn, $_POST['product_company']);
        $order_quantity = mysqli_real_escape_string($conn, $_POST['order_quantity']);
        $checkout = 'not checked out';
    

        $sql = 'CREATE TABLE IF NOT EXISTS CART (
            id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            user_id VARCHAR(100) NOT NULL,
            fullname VARCHAR(50) NOT NULL,
            email VARCHAR(100) NOT NULL,
            product_id VARCHAR(36) NOT NULL,
            product_name VARCHAR(50) NOT NULL,
            product_price VARCHAR(50) NOT NULL,
            product_company VARCHAR(120) NOT NULL, 
            order_quantity INT(10) NOT NULL,
            checkout VARCHAR(50) NOT NULL
        )';

        if (mysqli_query($conn, $sql)){
           echo "CART table has been successfully created!<br>";
        } else {
            echo "Error: ". mysqli_error($conn);
        }

        $sql2 = "INSERT INTO CART (user_id, fullname, email, product_id, product_name, product_price, product_company, order_quantity, checkout)
                VALUES('$user_id','$fullname','$email','$product_id','$product_name','$product_price', '$product_company', '$order_quantity', '$checkout')";

        if (mysqli_query($conn, $sql2)){
            echo "Values have been inserted into cart!! <br>";
        } else {
            echo "Error: ". mysqli_error($conn);
        } 
        
    }
}

