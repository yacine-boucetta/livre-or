<?php
try {
$dbase= new PDO('mysql:host=localhost;dbname=yacine-boucetta_livre-or;charset=utf8','livre-or','projetpp2');
[PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION];
}

catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>