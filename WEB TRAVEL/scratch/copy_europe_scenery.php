<?php
for ($i = 1; $i <= 8; $i++) {
    $source = "uploads/tour_europe$i.png";
    $dest = "uploads/tour_dongau$i.png";
    if (copy($source, $dest)) {
        echo "Copied $source to $dest\n";
    } else {
        echo "Failed to copy $source to $dest\n";
    }
}
?>
