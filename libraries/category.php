<?php
include_once __DIR__ . "/database.php";

// category model file
// supposed to handle all DB related tasks for categories table

class Category extends Database {
    
    protected string $table = 'categories';

}