<?php
session_start();


include ('../view/header.php');

require('../Model/ProductsClass.php');
require('../Model/productsDB.php');
require('../Model/database.php');
//include ('results1.php');

if (isset($_POST['action'])) {
    $action = $_POST['action'];
} else if (isset($_GET['action'])) {
    $action = $_GET['action'];
} else {
    $action = 'list_products';
}

if ($action == 'list_products') {
    // Get the current category
    if(!isset($_GET['product_id'])){
        $product='GalleryHome';
    }
    else{
        $product = $_GET['product_id'];
    }
    if(!isset($_GET['user_id']))
    {
        $user='Profile';
    }
    else{
        $user= $_GET['user_id'];
    }
        if(!isset($_GET['category'])) {
        $category = 'GalleryHome';
    }else
    {
        $category = $_GET['category'];
    }

    if(!isset($_GET['brand'])){
        $brand = 'GalleryHome';
    }
    else{
        $brand = $_GET['brand'];
    }

    if(!isset($_GET['product_id'])){
        $product = 'GalleryHome';
    }
    else{
        $product = $_GET['product_id'];
    }
    if(!isset($_GET['wish_id'])){
        $wish = 'GalleryHome';
    }
    else
    {
        $wish = $_GET['wish_id'];
    }


    $productCat = ProductsDB::getProductsinCat($category);
    $productBrand = ProductsDB::getProductsinBrand($brand);
    $categories = ProductsDB::getCategory();
    $brands = ProductsDB::getBrand();


    // Display the product list

    include('../Controller/ProductList.php');
    include('../Controller/GalleryHome.php');
}   else if ($action == 'delete_product') {
    // Get the IDs
    $product_id = $_POST['product_id'];
   // $brand = $_POST['brand'];

    // Delete the product
    ProductsDB::deleteProduct($product_id);

    // Display the Product List page for the current category
    header("Location: .?product_id=$product_id");
} else if ($action == 'show_add_form') {
    $products = ProductsDB::getProducts($product);

    include('product_add.php');
}

else if ($action == 'product_add') {
    $product_id = $_POST['product_id'];
    $description = $_POST['description'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $category = $_POST['category'];
    $image = $_POST['image'];
    $brand = $_POST['brand'];


    // Validate the inputs
//    if (empty($code) || empty($name) || empty($price)) {
//        $error = "Invalid product data. Check all fields and try again.";
//        include('../errors/error.php');
//    } else {
//        $current_category = CategoryDB::getCategory($category_id);
//        $product = new Product($current_category, $code, $name, $price);
//        ProductDB::addProduct($product);
//
//        // Display the Product List page for the current category
//        header("Location: .?product_id=$product_id");
//    }
}


include ('../view/footer.php');
?>