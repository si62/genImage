<?php

// Set the content-type
header('Content-Type: image/png');

$text = $_GET["text"];

$canvas_width=600;
$canvas_height=300;

//Chinese fonts setting
$font_size=($canvas_width/10)/ceil(mb_strlen($text)/($canvas_width/100));
/*$font_x=($canvas_width-(mb_strlen($text)*$font_size))/2;
$font_y=($canvas_height-$font_size)/2;
*/

// Replace path by your own font path
$font =  realpath('.').'\mingliu.ttc';

$im = imagecreatefrompng('bg.png');

// Create the image
$canvas = imagecreatetruecolor($canvas_width, $canvas_height);
// Create some colors
$bgcolor=imagecolorallocate($canvas, 255, 255, 255);
$fontcolor = imagecolorallocate($canvas, 0, 0, 0);
$shadowcolor= imagecolorallocate($canvas, 100, 100, 100);


imagefilledrectangle($canvas, 0, 0, $canvas_width, $canvas_height, $bgcolor);

// Get Bounding Box Size
$text_box = imagettfbbox($font_size,0,$font,$text);

// Get your Text Width and Height
$text_width = $text_box[2]-$text_box[0];
$text_height = $text_box[7]-$text_box[1];

// Calculate coordinates of the text
$font_x = ($canvas_width/2) - ($text_width/2);
$font_y = ($canvas_height/2) - ($text_height/2);

// Add some shadow to the text
//imagettftext($im, $font_size, 0, $font_x+4, $font_y+4, $shadowcolor, $font, $text);

// Add the text
imagettftext($canvas, $font_size, 0, $font_x, $font_y, $fontcolor, $font, $text);

// Merge the canvas onto our photo with an opacity of 50%

imagecopymerge($im, $canvas, 0, 0, 0, 0, $canvas_width, $canvas_height, 50);
// Using imagepng() results in clearer text compared with imagejpeg()
imagepng($im);
imagedestroy($im);
?>