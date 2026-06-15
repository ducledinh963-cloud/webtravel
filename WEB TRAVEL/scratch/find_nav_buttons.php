<?php
$content = file_get_contents(__DIR__ . '/../view/home.php');
preg_match_all('/<button[^>]*class="[^"]*(?:prev|next|btn-nav)[^"]*"[^>]*>.*?<\/button>/i', $content, $matches);
foreach ($matches[0] as $match) {
    echo htmlspecialchars($match) . "\n";
}
