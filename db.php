<?php
try {
$dbase= new PDO('mysql:host=localhost;dbname=livreor;charset=utf8','root','root');
[PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION];
}

catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>