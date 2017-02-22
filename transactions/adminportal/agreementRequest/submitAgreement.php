<?php

include("../../../php/dbconnect.php");
$agreementID = $_POST['agreementID'];

//This is the directory where files will be saved
$target = "uploads/";
$target = $target . basename( $_FILES['inputfile']['name']);

$inputfile=basename( $_FILES['inputfile']['name']);


if(move_uploaded_file($_FILES['inputfile']['tmp_name'], $target)) {
    
    //Writes the information to the database
    mysql_query("UPDATE client_agreement SET File='$inputfile' where AgreementID='$agreementID'") ;
	
	//Tells you if its all ok
    echo "<script>
				window.location.href='agreementRequest.php';
				alert('File Uploaded!');
		</script>";
} else {
    //Gives and error if its not
    echo "Sorry, there was a problem uploading your file.";
}


?>

