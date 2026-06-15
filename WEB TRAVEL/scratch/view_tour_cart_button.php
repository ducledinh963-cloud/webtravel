<?php
$content = file_get_contents(__DIR__ . '/../view/home.php');
// Search for addtocart button inside tour cards
if (preg_match('/<form[^>]*action="index\.php\?act=addtocart"[^>]*>.*?<\/form>/is', $content, $matches)) {
    echo htmlspecialchars($matches[0]) . "\n";
} else {
    echo "No matching form found.\n";
}
