<?php
require_once 'DB_connection.php';
 class wishlistDB
 {
     public static function getWishlist($product_id,$name)
     {

         $db = DB_connection::getDB();

         $query = "SELECT products.product_id, user_id, products.name
                  FROM products JOIN wishlist ON products.product_id = wishlist.product_id
                  WHERE products.product_id = '$product_id'
                  ORDER BY $name";

         $wishlist = $db->exec($query);
         return $wishlist;

     }
public static function getList($product_id,$name){
    $db = DB_connection::getDB();

    $query = "SELECT products.product_id, user_id, products.name
                  FROM products JOIN wishlist ON products.product_id = wishlist.product_id
                  WHERE products.product_id = '$product_id'
                  ORDER BY $name";

    $result = $db->query($query);

    $list = $result->fetchAll();
    return $list;

    }
     public static function AddWishlist($product_id, $user_id)
     {
         $db = DB_connection::getDB();

         $query = "INSERT INTO wishlist (id, product_id)
                   VALUES ($user_id, $product_id)";

         $row_count = $db->exec($query);
         return $row_count;

     }
 }