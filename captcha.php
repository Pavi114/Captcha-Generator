<?php
include_once('config.php');
include_once('image.php');
if(isset($_GET['id'])){
  $captcha = getCaptcha($con,$_GET['id']);
}
else {
	header('location: index.php');
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>captcha</title>
</head>
<body>
	<div class="container">
        <?php
    if(isset($captcha)){
    	image($captcha);
    }
  ?>
  <div>
     <input type="text" name="captchaInput" value="">
  <input type="button" name="check" value="Check"> 	
  </div>
 
  <div>
  	<span id="result"></span>
  </div>		
	</div>

  <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
  <script type="text/javascript">
  	var check = document.querySelector('input[name="check"]');
  	var captcha = document.querySelector('input[name="captchaInput"]');
  	var id = <?php echo $_GET['id']; ?>;
  	var result = document.getElementById('result');
  	result.style.display = 'none';
  	check.addEventListener("click",function(){
  		$.ajax({
  			type: 'POST',
  			url: 'checkCaptcha.php',
  			data: {captcha: captcha.value,
  			       id: id},
  			success: function(response){
              console.log(response);
              if(response == 'true'){
                 result.innerHTML = "Your response is right";
              }
              else {
              	result.innerHTML = "Your response is wrong";
              }
              result.style.display = 'block';
  			},
  			error: function(){
  				console.log('error');
  			}
  		});
  	})
  </script>
</body>
</html>