<?php

function stringGenerator(){
	$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'; 
    $string = ''; 
  
    for ($i = 0; $i < 5; $i++) { 
        $index = rand(0, strlen($characters) - 1); 
        $string .= $characters[$index]; 
    }
    return $string;
}

function getFont(){
  $fonts = ['arial','BodoniFLF-Bold','comic'];
  return $fonts[rand(0,2)];
}

function image($string){	
$image = imagecreatetruecolor(150, 150);
 $background_color = imagecolorallocate($image, 255, 255, 255);  
 imagefilledrectangle($image,0,0,150,150,$background_color);
 $lineColor = imagecolorallocatealpha($image, 0, 0, 0,0.6);
 for($i = 0;$i < 10;$i++){
 imageline($image, 0, rand(0,150), 150, rand(0,150), $lineColor);
}
for($i = 0;$i < 1000;$i++){
  imagesetpixel($image, rand(0,150), rand(0,150), $lineColor);
}
$x = 5;
$font = getFont();
   for ($i = 0;$i < 5;$i++) {
     $color = imagecolorallocate($image , rand(0,255) , rand(0,255) , rand(0,255));
     $size = rand(20,25);
     $angle = rand(10,30);
     $y = rand(70,100);
     imagettftext($image, $size, 2, $x, $y, $color, dirname(__FILE__). "/font/".$font.".ttf", $string[$i]);
     $x += rand(25,30);
}

 imagepng($image,'image.png');
 echo '<img src="image.png" id="image" style="border: 1px solid black;">';
}

function insert($con,$string){
  $stmt = $con->prepare('INSERT INTO images (captcha_string) VALUES (?)');
  $stmt->bind_param('s',$string);
  echo mysqli_error($con);
  if($stmt->execute()){
    return lastId($con);
  }
}

function lastId($con){
  $stmt = $con->prepare('SELECT id FROM images ORDER BY id desc LIMIT 1');
  $stmt->execute();
  $res = $stmt->get_result();
  $res = $res->fetch_assoc();
  return $res['id'];
}

function getCaptcha($con,$id){
  $stmt = $con->prepare("SELECT captcha_string FROM images WHERE id =?");
  $stmt->bind_param('i',$id);
  $stmt->execute();
  $res = $stmt->get_result();
  $res = $res->fetch_assoc();
  return $res['captcha_string'];
}

 ?>