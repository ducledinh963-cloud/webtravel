<?php
$free = disk_free_space(__DIR__);
$total = disk_total_space(__DIR__);
echo "Free space: " . round($free / 1024 / 1024, 2) . " MB\n";
echo "Total space: " . round($total / 1024 / 1024, 2) . " MB\n";
?>
