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
    <div>
        <?php echo '<form method="POST" action="'.add_product($conn).'">'; ?>
        <label for="email">Product name:</label><br>
        <input type="text" name="pname" id="pname" required><br><br>

        <label for="cat">Select Product category</label><br>
        <select name="cat" id="cat" required>
            <option value="" disabled selected>Select category</option>
            <option value="fresh">Fresh</option>
            <option value="preserved">Preserved</option>
            <option value="packaged">Packaged</option>
        </select><br><br>

        <div id="content-area"></div>

        <script>
            const selectElement = document.getElementById('cat');
            const contentArea = document.getElementById('content-area');

            selectElement.addEventListener('change', function () {
                let newHtml = '';
                if (this.value === "fresh") {
                    newHtml = '<label for="time">Time of cultivation</label><br> <input type="date" name="time" id="time"><br><br>';
                } else if (this.value === "preserved") {
                    newHtml = '<label for="preservation">Preservation Method</label><br> <input type="text" name="preservation" id="preservation"><br><br> <label for="time">Time of preservation</label><br> <input type="date" name="time" id="time"><br><br>';
                } else if (this.value === "packaged") {
                    newHtml = '<label for="expiry">Expiry Date</label><br> <input type="date" name="expiry" id="expiry"><br><br>';
                }

                contentArea.innerHTML = newHtml;
            });
        </script>

        
        <label for="pwd">Price:</label><br>
        <input type="text" name="price" id="price" required><br><br>

        <label for="cname">Company name:</label><br>
        <input type="text" name="cname" id="cname" required><br><br>

        <label for="stock">Amount in stock:</label><br>
        <input type="number" name="stock" id="stock" required><br><br>

        <button>Submit</button><br>
        </form>
    </div>    
    
    <p>Go back <a href="agrocart.php">home</a></p>
</body>
</html>