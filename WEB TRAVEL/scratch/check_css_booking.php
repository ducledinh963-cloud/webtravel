<?php
$css = file_get_contents(__DIR__ . '/../css/style.css');
preg_match_all('/\.btn-tour-book-new\s*\{[^}]*\}/s', $css, $matches);
foreach ($matches[0] as $match) {
    echo $match . "\n";
}
// Also find any hover state
preg_match_all('/\.btn-tour-book-new:hover\s*\{[^}]*\}/s', $css, $matches_hover);
foreach ($matches_hover[0] as $match) {
    echo $match . "\n";
}
