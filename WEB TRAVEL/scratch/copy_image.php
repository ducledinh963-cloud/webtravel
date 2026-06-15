<?php
$source = "C:/Users/Vinacom/.gemini/antigravity/brain/dd8536a7-79f6-4fe4-8853-2103c274f35a/newsletter_traveler_1781357544115.png";
$dest = "c:/xampp/htdocs/WEB TRAVEL/uploads/newsletter_traveler.png";
if (copy($source, $dest)) {
    echo "Copy successful!\n";
} else {
    echo "Copy failed!\n";
}
?>
