<?php
$content = file_get_contents(__DIR__ . '/../view/home.php');
// Find form submissions to cart or booking actions
preg_match_all('/<form[^>]*action="[^"]*cart[^"]*"[^>]*>.*?<\/form>/is', $content, $matches);
foreach ($matches[0] as $index => $match) {
    echo "MATCH " . ($index + 1) . ":\n" . htmlspecialchars(substr($match, 0, 500)) . "...\n\n";
}
// Also find links with act=addtocart or similar
preg_match_all('/href="[^"]*act=[^"]*cart[^"]*"/i', $content, $matches_links);
foreach ($matches_links[0] as $link) {
    echo "LINK MATCH: " . htmlspecialchars($link) . "\n";
}
