<?php
include('config.php');
 $query = 'CREATE TABLE IF NOT EXISTS images(
       id INT AUTO_INCREMENT PRIMARY KEY,
       captcha_string VARCHAR(120) NOT NULL
  )';

  mysqli_query($con,$query);
?>