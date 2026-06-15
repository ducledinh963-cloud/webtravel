<?php
$base64 = 'iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mNkYAAAAAYAAjCB0C8AAAAASUVORK5CYII=';
$data = base64_decode($base64);

$images = [
    'tour_nhatrang1.png', 'tour_nhatrang2.png', 'tour_nhatrang3.png', 'tour_nhatrang4.png',
    'tour_nhatrang5.png', 'tour_nhatrang6.png', 'tour_danang1.png', 'tour_sapa1.png',
    'tour_halong1.png', 'tour_phuquoc1.png', 'tour_mientay1.png', 'tour_hagiang1.png',
    'tour_ninhbinh1.png', 'tour_hue1.png', 'tour_dalat1.png', 'tour_condao1.png',
    'tour_muine1.png', 'tour_quynhon1.png'
];

foreach ($images as $img) {
    file_put_contents('uploads/' . $img, $data);
}
echo "Created 18 tiny images successfully!\n";
?>
