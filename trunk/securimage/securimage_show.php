<?php

include 'securimage.php';

$img = new securimage();
$img->image_width = 135;
$img->image_height = 35;
$img->font_size = 14;

$img->show(); // alternate use:  $img->show('/path/to/background.jpg');

?>
