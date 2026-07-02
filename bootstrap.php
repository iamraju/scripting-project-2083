<?php
// echo '<pre>';
// print_r($_SERVER);
// die;
// includes files only once, preventing multiple inclusions
$projectRoot = __DIR__;

require_once $projectRoot . '/config.php';
require_once $projectRoot . '/functions.php';
require_once $projectRoot . '/libraries/database.php';
require_once $projectRoot . '/libraries/request.php';