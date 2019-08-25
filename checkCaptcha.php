<?php
include_once('config.php');
include_once('image.php');
if(isset($_POST['captcha'])){
	$id = $_POST['id'];
	$string = getCaptcha($con,$id);
  if($_POST['captcha'] == $string){
    	echo 'true';
  }
  else {
  	echo 'false';
  }
}

?>