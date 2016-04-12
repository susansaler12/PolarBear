.0<?php
class productsDB {
    public static function getProductList(){
        $db = Database::getDB();
        $sql = "SELECT * FROM products";
        $result = $db->query($sql);

        $productlist = $result->fetchAll();
        return $productlist;
    }

    public static function getProducts($product) {
        $db = Database::getDB();
        $query = "SELECT * FROM products
                  WHERE product_id = '$product'
                  ORDER BY product_id";
        $result = $db->query($query);
        $products = array();
       // var_dump($query);exit();
        foreach ($result as $row) {
            $product = new Product($row['product_id'],
                $row['name'],
                $row['description'],
                $row['price'],
                $row['image'],
                $row['category'],
                $row['brand']);
            $products[] = $product;
        }
        return $products;
    }

    //get Category
    public static function getCategory(){
        $db = Database::getDB();
        $sql = "SELECT DISTINCT category FROM products";
        $result = $db->query($sql);

        $category = $result->fetchAll();
        return $category;
    }

    public static function getProductsinCat($category){
        $db = Database::getDB();
        $query = "SELECT * FROM products
           WHERE category = '$category'";
        $result = $db->query($query);
        $products = array();
        foreach ($result as $row) {
            $product = new Product($row['product_id'],
                $row['name'],
                $row['description'],
                $row['price'],
                $row['image'],
                $row['category'],
                $row['brand']);
            $products[] = $product;
        }
        return $products;
    }

    //GET PRODUCTS BY BRAND//
    public static function getBrand(){
        $db = Database::getDB();
        $sql = "SELECT DISTINCT brand FROM products";
        $result = $db->query($sql);

        $brand = $result->fetchAll();
        return $brand;
    }
     public static function getProductsinBrand($brand){
         $db = Database::getDB();
         $query = "SELECT * FROM products
           WHERE brand = '$brand'";
         $result = $db->query($query);
         $products = array();
         foreach ($result as $row) {
             $product = new Product($row['product_id'],
                 $row['name'],
                 $row['description'],
                 $row['price'],
                 $row['image'],
                 $row['category'],
                 $row['brand']);
             $products[] = $product;
         }
         return $products;
     }

    public static function getProduct($product_id) {
        $db = Database::getDB();
        $query = "SELECT * FROM products
                  WHERE product_id = '$product_id'";
        $statement = $db->query($query);
        $row = $statement->fetch();
        $product = new Product($row['product_id'],
            $row['name'],
            $row['description'],
            $row['price'],
            $row['image'],
            $row['category'],
            $row['brand']);
        return $product;
    }

    //DELETE PRODUCTS///
public static function deleteProduct($product_id) {
    $db = Database::getDB();
    $query = "DELETE FROM products
                  WHERE product_id = '$product_id'";
    $row_count = $db->exec($query);
    return $row_count;
}
// ADD PRODUCTS ////
public static function addProduct($product) {
    $db = Database::getDB();

    $product_id = $product->getProducts()->getProduct_ID();
    $name = $product->getName();
    $category = $product->getCategory();
    $price = $product->getPrice();
    $description = $product->getDescription();
    $image = $product->getImage();
    $brand=$product->getBrand();

    $query ="INSERT INTO products
                 (product_id, name, category, price, description, image, brand)
             VALUES
                 ('$product_id', '$name', '$category', '$price','$description','$image','$brand')";

    $row_count = $db->exec($query);
    return $row_count;
}
    //ADD PRODUCTS TO WISHLIST
public static  function getWishlist($product){

    $db = Database::getDB();

    $product_id = $product->getProductList()->getProduct_ID();
    $name = $product->getName();
    $wish_id = $product->getWish();
    $price = $product->getPrice();
   /* $category = $product->getCategory();

    $description = $product->getDescription();
    $image = $product->getImage();
    $brand=$product->getBrand();*/

   $query = "SELECT p.product_id, w.wish_id, p.name, p.price
                FROM products p JOIN wishlist w
              ON p.product_id = w.product_id
               WHERE product_id = '$product_id', name = '$name', wish_id= '$wish_id', price = '$price'";

   $row_count = $db->exec($query);
    return $row_count;
// 
}




}