<?php
    $connection = new mysqli('localhost', 'root', '', 'casio');
    if(!$connection){
        echo "Error: {$connection->connect_error}";
    }
?>
