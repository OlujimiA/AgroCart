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

}

/*function cart($conn){
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        //Stores all the event information
        $EventName = mysqli_real_escape_string($conn, $_POST['name']);
        $EventDescription = mysqli_real_escape_string($conn, $_POST['description']);
        $date = mysqli_real_escape_string($conn, $_POST['date']);
        $time = mysqli_real_escape_string($conn, $_POST['time']);
        $Location = mysqli_real_escape_string($conn, $_POST['location']);
        $Visibility = mysqli_real_escape_string($conn, $_POST['visibility']);
        $booking_cap = mysqli_real_escape_string($conn, $_POST['capc']);
        $club_name = mysqli_real_escape_string($conn, $_POST['clubname']);

        $sql = 'CREATE TABLE IF NOT EXISTS EVENTS(
                id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                event_id CHAR(36) NOT NULL DEFAULT (UUID()),
                name VARCHAR(30) NOT NULL,
                description VARCHAR(500) NOT NULL,
                date DATE NOT NULL,
                time TIME NOT NULL,
                location VARCHAR(500) NOT NULL,
                visibility VARCHAR(60) NOT NULL,
                status VARCHAR(20) NOT NULL,
                time_created TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                club_name VARCHAR(500) NOT NULL,
                booking_cap int(30),
                email VARCHAR(320) NOT NULL 
                )';
        
        if (mysqli_query($conn, $sql)){
            echo "Events table has been created successfully!";
        } else{
            echo "Error: " . mysqli_error($conn);
        }
        
        $email = $_SESSION['user_email'] ?? '';
        $user_type = $_SESSION['user_type'] ?? '';

        //setting event status
        if ($user_type=='member' && $Visibility=='public') {
            $status = 'unverified';
        } else {
            $status = 'verified';
        }

        $sql2 = "INSERT INTO EVENTS(name, description, club_name, date, time, location, visibility, status, booking_cap, email)
                VALUES('$EventName', '$EventDescription', '$club_name', '$date', '$time', '$Location', '$Visibility', '$status', '$booking_cap', '$email')";
        
        if (mysqli_query($conn, $sql2)){
            echo "Event has been added to the Events table successfully!";
        } else{
            echo "Error: " . mysqli_error($conn);
        }


    }

}*/



?>