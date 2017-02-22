<body>
<?php

session_start();
include("../../../php/dbconnect.php");

$ag = $_SESSION['agID'];
$sql = "select File from client_agreement where AgreementID = $ag";
$exec = mysql_query($sql);
$row = mysql_fetch_array($exec);
$agreement = $row['File'];
$file_path = '../../adminportal/agreementRequest/uploads/';
$src = $file_path.$agreement;

header('Content-type: application/pdf');
readfile($src);

?>
</body>

