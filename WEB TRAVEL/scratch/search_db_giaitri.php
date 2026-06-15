<?php
$sql = file_get_contents(__DIR__ . '/../database.sql');
if ($sql === false) {
    die("Could not read database.sql\n");
}
$count = substr_count(strtolower($sql), 'giaitri');
$count_vn = substr_count(strtolower($sql), 'giải trí');
echo "giaitri count: $count\n";
echo "giải trí count: $count_vn\n";
?>
