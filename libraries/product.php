<?php
include_once __DIR__ . "/database.php";

// category model file
// supposed to handle all DB related tasks for categories table

class Product extends Database {
    
    protected string $table = 'products';

}