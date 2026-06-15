<?php
$copies = [
    'uploads/tour_europe1.png' => 'uploads/order1.png',
    'uploads/tour_trungau2.png' => 'uploads/order2.png',
    'uploads/dest_halong.png' => 'uploads/order3.png',
    'uploads/tour_sapa.png' => 'uploads/order4.png',
    'uploads/dest_danang.png' => 'uploads/order5.png',
    'uploads/tour_nhatrang2.png' => 'uploads/order6.png',
    'uploads/dest_dalat.png' => 'uploads/order7.png',
    'uploads/hotel_famiana.png' => 'uploads/order8.png',
    'uploads/tour_mientay1.png' => 'uploads/order9.png',
    'uploads/tour_thailand.png' => 'uploads/order10.png',
    'uploads/tour_singapore_hagiang.png' => 'uploads/order11.png',
    'uploads/tour_japan.png' => 'uploads/order12.png'
];

foreach ($copies as $src => $dest) {
    if (file_exists($src)) {
        if (copy($src, $dest)) {
            echo "Copied $src to $dest\n";
        } else {
            echo "Failed to copy $src to $dest\n";
        }
    } else {
        echo "Source file $src not found\n";
    }
}
?>
