<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/../config/main.php";
require_once ENGINE_DIR . "db.php";

function getConnection(){
    $config = include CONFIG_DIR . 'db.php';
    static $connection = null;
        if(is_null($connection)) {
            $connection = mysqli_connect(
            $config['host'],
            $config['login'],
            $config['password'],
            $config['db'],

        );
    }
    return $connection;
}
function search ($query) 
{ 
    $query = trim($query); 
    $query = mysqli_real_escape_string(getConnection(), $query);
    $query = htmlspecialchars($query);

    if (!empty($query)) 
    { 
        if (strlen($query) < 3) {
            $row = '<p>Слишком короткий поисковый запрос.</p>';
        } else if (strlen($query) > 128) {
            $row = '<p>Слишком длинный поисковый запрос.</p>';
        } else { 
            $q = "SELECT c.body, p.title
                  FROM comments c JOIN posts p ON p.id = c.post_id
                  WHERE c.body LIKE '%$query%'";

            $result = mysqli_query(getConnection(), $q);
            if (mysqli_affected_rows(getConnection()) > 0) { 
                $row = mysqli_fetch_all($result, MYSQLI_ASSOC);
                              
            } else {
                $row = '<p>По вашему запросу ничего не найдено.</p>';
            }
        } 
    } 

    return $row; 
} 
