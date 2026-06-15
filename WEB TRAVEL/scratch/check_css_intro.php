<?php
$css = file_get_contents(__DIR__ . '/../css/style.css');
preg_match_all('/\.intro-section\s*\{[^}]*\}/s', $css, $matches);
foreach ($matches[0] as $match) {
    echo $match . "\n";
}
