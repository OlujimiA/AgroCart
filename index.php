<?php
require 'query.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AgroCart</title>
</head>
<body>
    <h1>AgroCart</h1>

    <div>
        <h3>Sign Up</h3>
        <?php echo '<form method="POST" action="'.register($conn).'">'; ?>
            <label for="firstname">Firstname:</label><br>
            <input type="text" name="firstname" id="firstname" required><br><br>
            <label for="lastname">Lastname:</label><br>
            <input type="text" name="lastname" id="lastname" required><br><br>
            <label for="dob">Date Of Birth:</label><br>
            <input type="date" name="dob" id="dob" required><br><br>

            <label for="email" required>Email:</label><br>
            <input type="email" name="email" id="email" required placeholder="example@domain.com"><br><br>
            <label for="tel">Phone Number:</label><br>
            <input type="number" name="tel" id="tel" required><br><br>

            <!-- Line Break -->

            <label for="username">Username:</label><br>
            <input type="text" name="username" id="username" required><br><br>
            <label for="pwd">Password:</label><br>
            <input type="text" required name="pwd" id="pwd"><br><br>

            <label for="location">Location:</label><br>
            <input type="text"  required name="location" id="location" placeholder="Lagos, Nigeria"><br><br>
            <input type="hidden" id="utype" name= "utype" value="regular">

            <button>Submit</button><br>
            <p>Already have an account? Login <a href="login.php">here</a></p>
        </form>
    </div>
</body>
</html>