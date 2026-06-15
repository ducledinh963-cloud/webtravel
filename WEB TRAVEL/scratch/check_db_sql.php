<?php
$db_sql_path = __DIR__ . '/../database.sql';
if (file_exists($db_sql_path)) {
    $content = file_get_contents($db_sql_path);
    $pos_xe = strpos($content, "INSERT INTO `thuexe`");
    if ($pos_xe !== false) {
        $car_count = substr_count($content, "uploads/car");
        echo "Found 'INSERT INTO `thuexe`'. Count of 'uploads/car': $car_count\n";
    } else {
        echo "Could not find 'INSERT INTO `thuexe`' in database.sql\n";
    }
    
    $pos_le = strpos($content, "INSERT INTO `leucamtrai`");
    if ($pos_le !== false) {
        $tent_count = substr_count($content, "uploads/tent");
        echo "Found 'INSERT INTO `leucamtrai`'. Count of 'uploads/tent': $tent_count\n";
        echo "Snippet of leucamtrai insert block:\n";
        echo substr($content, $pos_le, 300) . "...\n";
    } else {
        echo "Could not find 'INSERT INTO `leucamtrai`' in database.sql\n";
    }
} else {
    echo "database.sql not found!\n";
}
?>
