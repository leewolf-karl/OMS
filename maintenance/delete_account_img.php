<?php


  if(isset($_POST['image'])){
      $setImg = $_POST['image'];
      echo "<center><img src='$setImg' style='width:28%;height:10%;'></center>";
	}
?>