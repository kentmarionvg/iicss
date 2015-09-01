<?php
	session_start();
	$code=substr(str_shuffle(str_repeat('ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789',5)),0,5);
	$_SESSION["code"]=$code;
	$im = imagecreatetruecolor(50, 24);
	$bg = imagecolorallocate($im, 22, 86, 165); //background color blue
	$fg = imagecolorallocate($im, 255, 255, 255);//text color white
	imagefill($im, 0, 0, $bg);
	imagestring($im, .1, .1, .1,  $code, $fg);
	header("Cache-Control: no-cache, must-revalidate");
	header('Content-type: image/png');
	imagepng($im);
	imagedestroy($im);
?>