<?php
session_start();
include_once('db.php');
include('image.php');
if(isset($_POST['generate'])){
	$string = stringGenerator();
	$id = insert($con,$string);
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Captcha Generator</title>
</head>
<body>
	<form action="index.php" method="POST">
      <button name="generate">GENERATE</button>		
	</form>
	<div>
	<?php
      if(isset($id)){
      	image($string);
      	echo '<div><a target="_blank" href="http://localhost/onsite/captcha generator/captcha.php?id='.$id.'">link</a></div>';
      	echo '<div><a href="image.png" download>download</a></div>';
      }
	?>
    </div>
</body>
</html>