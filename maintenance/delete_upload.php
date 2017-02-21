<?php

if(isset($_POST['key'])){


//unlink($_POST['key']);
//$output = ['error' => "0"];
//echo $_POST['key'];
//echo json_encode([
//echo 'wew';
	echo json_encode([
		  'validateInitialCount' => true,
          'initialPreview' => [],
          'initialPreviewConfig' => [],
          'append' => true

      ]);

}

?>