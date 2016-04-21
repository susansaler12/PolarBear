<?php

require_once '../Model/database.php';
require_once '../Model/productsDB.php';

$products = productsDB::getProductsinCat('Kitchen');

var_dump($products);