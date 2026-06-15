<?php
$content = file_get_contents('database.sql');
if ($content !== false) {
    preg_match_all('/[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}/', $content, $matches);
    print_r(array_unique($matches[0]));
}
?>
