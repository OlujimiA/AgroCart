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
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>AgroCart</title>
  <link rel="stylesheet" href="stylesheet.css">
</head>
<script>
  function myFunction() {
    <?php header("Location: product.php")?>
  }
</script>
<body>
  <div style="border-bottom: 1px solid grey; display: flex; justify-content: space-between; align-items: center; padding: 5px 20px;">
    <h1 style="margin: 0;">AgroCart</h1>
    <input type="text" placeholder="Search">
    <div>
      <?php if ($_SESSION['user_type'] == 'admin' || 'superadmin') {echo '<button onclick="redirect()">Add Product</button>';}?>
      <button>View Cart(0)</button>
    </div>
  </div>

  <div style="text-align: center;"><h2>Featured Products</h2></div>

  <table style="width:100%;">
    <tr>
      <td><div class="cell-content"><div class="content-wrapper">
        Lettuce - fresh(2 days)<br>
        NGN 2,400<br>
        Glovo Farms<br>
        <input type="number" name="add_to_cart" value="1">
        <button>Add to Cart</button>
      </div></div></td>
      <td><div class="cell-content"><div class="content-wrapper">
        Turnips - preserved(10 days)<br>
        NGN 2,400<br>
        Glovo Farms<br>
        <input type="number" name="add_to_cart" value="1">
        <button>Add to Cart</button>
      </div></div></td>
      <td><div class="cell-content"><div class="content-wrapper">
        Rasberry (packaged)<br>
        NGN 2,400<br>
        Glovo Farms<br>
        <input type="number" name="add_to_cart" value="1">
        <button>Add to Cart</button>
      </div></div></td>
    </tr>
    <tr>
      <td><div class="cell-content"><div class="content-wrapper">
        Lettuce - fresh(2 days)<br>
        NGN 2,400<br>
        Glovo Farms<br>
        <input type="number" name="add_to_cart" value="1">
        <button>Add to Cart</button>
      </div></div></td>
      <td><div class="cell-content"><div class="content-wrapper">
        Turnips - preserved(10 days)<br>
        NGN 2,400<br>
        Glovo Farms<br>
        <input type="number" name="add_to_cart" value="1">
        <button>Add to Cart</button>
      </div></div></td>
      <td><div class="cell-content"><div class="content-wrapper">
        Rasberry (packaged)<br>
        NGN 2,400<br>
        Glovo Farms<br>
        <input type="number" name="add_to_cart" value="1"> 
        <button>Add to Cart</button>
      </div></div></td>
    </tr>
  </table>
</body>
</html>
