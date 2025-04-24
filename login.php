<?php require 'query.php'?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>AgroCart Login</title>
    </head>
    <body>
        <h1>AgroCart</h1>
        <div>
            <h2>Login</h2>
            <?php echo '<form method="POST" action="'.login($conn).'">'; ?>
            <label for="email">Email:</label><br>
            <input type="text" name="email" id="email"><br><br>
            <label for="pwd">Password:</label><br>
            <input type="text" name="pwd" id="pwd"><br><br>

            <button>Submit</button><br>
            </form>
        </div>

    </body>
</html>