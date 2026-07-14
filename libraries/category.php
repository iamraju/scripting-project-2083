<?php
include_once __DIR__ . "/database-pdo.php";

// category model file
// supposed to handle all DB related tasks for categories table

class Category extends DatabasePDO {
    
    protected string $table = 'categories';

}