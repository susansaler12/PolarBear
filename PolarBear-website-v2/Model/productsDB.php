<?php
class productsDB {
    public static function getProducts()
    {
        $db = Database::getDB();
        $sql = "SELECT * FROM products";
        $sql = $db->prepare($sql);
        $sql->bindParam(":product_id", $product_id, PDO::PARAM_INT);
        $sql->setFetchMode(PDO::FETCH_OBJ);
        $sql->execute();
        $productLi = $sql->fetchAll();
        $products = [];
        foreach($productLi as $item){
            $product = new Product(
                $item->product_id,
                $item->name,
                $item->description,
                $item->price,
                $item->image,
                $item->category,
                $item->brand
            );
            $products[] = $product;
        }
        return $products;
    }

    public static function getProductList($product_id) {
        $db = Database::getDB();
        $query = "SELECT * FROM products
                  WHERE product_id = :product_id";
        $sql = $db->prepare($query);
        $sql->bindParam(":product_id", $product_id, PDO::PARAM_INT);
        $sql->setFetchMode(PDO::FETCH_OBJ);
        $sql->execute();
        $productLi = $sql->fetchAll();
        $products = [];
        foreach($productLi as $item){
            $product = new Product(
                $item->product_id,
                $item->name,
                $item->description,
                $item->price,
                $item->image,
                $item->category,
                $item->brand
            );
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
           WHERE category = :category";
        $sql = $db->prepare($query);
        $sql->bindParam(":category", $category, PDO::PARAM_STR);
        $sql->setFetchMode(PDO::FETCH_OBJ);
        $sql->execute();
        $prodinCat = $sql->fetchALL();
        $products = [];
        foreach($prodinCat as $item){
            $product = new Product(
                $item->product_id,
                $item->name,
                $item->description,
                $item->price,
                $item->image,
                $item->category,
                $item->brand
            );
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
    public static function getProduct($product_id)
{
    $db = Database::getDB();
    $query = "SELECT * FROM products
                  WHERE product_id = :product_id";
    $sql = $db->prepare($query);

    $sql->bindParam(":product_id", $product_id, PDO::PARAM_INT);
    $sql->setFetchMode(PDO::FETCH_OBJ);
    $sql->execute(':product_id');

    $result = $sql->fetchALL();

    $products = [];
    foreach ($result as $row){
        $product = new Product(
            $row->product_id,
            $row->name,
            $row->description,
            $row->price,
            $row->image,
            $row->category,
            $row->brand
        );
        $products[] = $product;
    };
    return $products;
}

    //DELETE PRODUCTS///
    public static function deleteProduct($product_id) {
        $db = Database::getDB();
        $query = "DELETE FROM products
                  WHERE product_id = '$product_id'";
        $row_count = $db->exec($query);
        return $row_count;
    }

}

