<?php
class Product
{
    private $product_id, $name, $description, $price, $image, $category, $brand;

    public function __construct($product_id, $name, $description, $price, $image, $category, $brand )
    {
        $this->product_id = $product_id;
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
        $this->image = $image;
        $this->category = $category;

    }

    public function getProduct_ID()
    {
        return $this->product_id;
    }

    public function setProduct_ID($value)
    {
        $this->product_id = $value;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($value)
    {
        $this->name = $value;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($value)
    {
        $this->description = $value;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function setPrice($value)
    {
        $this->price = $value;
    }

    public function getImageFilename()
    {
        $image_filename = $this->image . '.png';
        return $image_filename;
    }
    public function setImagesize($value)
    {
       $this->image = $value;
    }
    public function getImagePath()
    {
        $image_path = '../../images/Gallery/' . $this->getImageFilename();
        return $image_path;
    }
    public function getImage()
    {
        return $this->image;
    }
    public function getImageAltText()
    {
        $image_alt = 'Image: ' . $this->getImageFilename();
        return $image_alt;
    }

    public function getCategory()
    {
        return $this->category;
    }

    public function setCategory($value)
    {
        $this->category = $value;
    }

    public function getBrand()
    {
        return $this->brand;
    }

    public function setCategoryBrand($value)
    {
        $this->brand = $value;
    }
}
//class wishlist {
//
//    private $wish_id;
//
//    public function __construct($wish_id)
//    {
//        $this->wish_id = $wish_id;
//    }
//
//    public function getWishId(){
//        return $this->wish_id;
//    }
//    public function setWishId($value){
//        $this->wish_id = $value;
//    }
//}
//class user_profiles{
//    private $user_id;
//
//    public function __construct($user_id)
//    {
//        $this->wish_id = $user_id;
//    }
//
//    public function getWishId(){
//        return $this->user_id;
//    }
//    public function setWishId($value){
//        $this->user_id = $value;
//    }
//}
?>