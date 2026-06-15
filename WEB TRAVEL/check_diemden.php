<?php
require_once 'model/pdo.php';
$rows = pdo_query("SELECT * FROM diemden");
print_r($rows);
?>
