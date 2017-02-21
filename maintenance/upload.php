<?php
session_start();
	include "../php/dbconnect.php";

 $aID = $_POST['amid'];
  
	$path = "admin" . "/$aID/";
        if (!file_exists($path)) {
          mkdir($path, 0777,true);
        }

      $ds = DIRECTORY_SEPARATOR;  //1
       
      $storeFolder = $path; 

if (!empty($_FILES)) {

     // Loop through each file
	for($i=0; $i<count($_FILES['upload_name']['name']); $i++) {
  //Get the temp file path

	$tempFile = $_FILES['upload_name']['tmp_name'][$i];
  
  //Make sure we have a filepath
  if ($tempFile != ""){
    //Setup our new file path

	$path = __DIR__ . $ds . $storeFolder . $ds;
		
  $name = pathinfo($_FILES['upload_name']['name'][$i], PATHINFO_FILENAME);
	$extension = pathinfo($_FILES['upload_name']['name'][$i], PATHINFO_EXTENSION);

  $prevCaption = $name . '.' . $extension;

  function generateRandomString($length = 5){
    $characters = '0123456789';
    $charactersLength = strlen($characters);
    $randomString = '';
      for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
      }
    return $randomString;
  };
  
  $ifexist = false;
  while($ifexist == false){
    $random = generateRandomString();
        if(file_exists($path . $random . '.' . $extension)){
            
         $ifexist = false;
        }
        else{
            $basename = $random . '.' . $extension;
            $ifexist = true;
        }
  }
      
     $_FILES['upload_name']['name'][$i] = $basename;
    //Upload the file into the temp dir
	 $newFilePath =  $path . $_FILES['upload_name']['name'][$i];

   

   $imgLoc = $storeFolder . $basename;
            if(move_uploaded_file($tempFile, $newFilePath)) {
                  //Handle other code here

                    echo json_encode([
                        'validateInitialCount' => true,
                        'initialPreview' =>  $imgLoc,
                        'initialPreviewConfig' => [ ['caption' => "$prevCaption", 'size' => '327892', 'width' => '120px', 'url' => 'delete_upload.php', 'key' => $basename ] ],
                        'append' => 'true'

                    ]);
                }
        
  }
}
   

   
     
}

?>