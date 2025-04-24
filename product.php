<?php require 'query.php';
// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
  echo "Access denied. Please log in.";
  header('Location: login.php'); // Redirect to login page
  exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=\, initial-scale=1.0">
    <title>AgroCart product creation</title>
</head>
<body>
    <div style="border-bottom: 1px solid grey; display: flex; justify-content: space-between; align-items: center; padding: 5px 20px;">
        <h1 style="margin: 0;">AgroCart</h1>
        <input type="text" placeholder="Search">
        <button>View Cart(0)</button>
    </div>
    <div style="text-align: center;"><h2>Product Addition</h2></div>

    
</body>
</html>