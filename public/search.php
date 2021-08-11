<?php 
require_once $_SERVER['DOCUMENT_ROOT'] . "/../config/main.php";
require_once ENGINE_DIR . "db.php";

if (!empty($_POST['query'])) { 
    $search_result = search($_POST['query']); 
    
}
include VIEWS_DIR . "result.php";
?>