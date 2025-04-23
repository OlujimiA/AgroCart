<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>AgroCart</title>
  <style>
    table {
      margin-left: auto;
      margin-right: auto;
    }

    td {
      padding: 10px;
      vertical-align: top;
    }

    .cell-content {
      display: flex;
      justify-content: center; /* center the block */
    }

    .content-wrapper {
      text-align: left;
      width: max-content; /* shrink to fit content */
    }
  </style>
</head>
<body>
  <div style="border-bottom: 1px solid grey; display: flex; justify-content: space-between; align-items: center; padding: 5px 20px;">
    <h1 style="margin: 0;">AgroCart</h1>
    <input type="text" placeholder="Search">
    <div>
        <button>Add Product</button>
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
        <button>Add to Cart</button>
      </div></div></td>
      <td><div class="cell-content"><div class="content-wrapper">
        Turnips - preserved(10 days)<br>
        NGN 2,400<br>
        Glovo Farms<br>
        <button>Add to Cart</button>
      </div></div></td>
      <td><div class="cell-content"><div class="content-wrapper">
        Rasberry (packaged)<br>
        NGN 2,400<br>
        Glovo Farms<br>
        <button>Add to Cart</button>
      </div></div></td>
    </tr>
    <tr>
      <td><div class="cell-content"><div class="content-wrapper">
        Lettuce - fresh(2 days)<br>
        NGN 2,400<br>
        Glovo Farms<br>
        <button>Add to Cart</button>
      </div></div></td>
      <td><div class="cell-content"><div class="content-wrapper">
        Turnips - preserved(10 days)<br>
        NGN 2,400<br>
        Glovo Farms<br>
        <button>Add to Cart</button>
      </div></div></td>
      <td><div class="cell-content"><div class="content-wrapper">
        Rasberry (packaged)<br>
        NGN 2,400<br>
        Glovo Farms<br>
        <button>Add to Cart</button>
      </div></div></td>
    </tr>
  </table>
</body>
</html>
