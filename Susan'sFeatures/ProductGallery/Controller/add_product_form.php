<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<!-- the head section -->
<head>
    <title>My Guitar Shop</title>
    <!--<link rel="stylesheet" type="text/css" href="main.css" />-->
</head>

<!-- the body section -->
<body>
<div id="page">
    <div id="header">
        <h1>Product Manager</h1>
    </div>

    <div id="main">
        <h1>Add Product</h1>
        <form action="product_add.php" method="post"
              id="add_product_form">

            <label>Name:</label>
            <input type="input" name="name" />
            <br />
            <label>Category:</label>
            <input type="input" name="category" />
            <br/>
            <label>Price:</label>
            <input type="input" name="price" />
            <br />

            <label>Desciption:</label>
            <input type="input" name="description" />
            <br />
            <label>Image:</label>
            <input type="input" name="price" />
            <br />
            <label>Brand:</label>
            <input type="input" name="brand" />
            <br />





            <br />
            <label>&nbsp;</label>
            <input type="submit" value="Add Product" />
            <br />
        </form>
        <p><a href="index1.php">View Product List</a></p>
    </div><!-- end main -->


</div><!-- end page -->
</body>
</html>