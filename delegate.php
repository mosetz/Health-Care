<?php 
session_start();
include 'DBconnect.php';
$conn = connect();

//prevent access without login
if(!isset($_SESSION['staffID'])){
	header("Location: index.php");
	exit();
}

if(!isset($_POST['aDate'], $_POST['aTime'], $_POST['pID'], $_POST['sID'], $_POST['new_sID'])){
	echo "<p>Error data missing</p>";
	exit();
}

//get all of the data from form in move.php
$aDate = $_POST['aDate'];
$aTime = $_POST['aTime'];
$pID = $_POST['pID'];
$old_sID = $_POST['sID'];
$new_sID = $_POST['new_sID'];

$sql="
	UPDATE Appointment 
	SET sID = :new_sID
	WHERE aDate = :aDate AND aTime = :aTime
	AND pID = :pID AND sID = :old_sID";
	
$temp = $conn->prepare($sql);
$temp->execute(['new_sID' => $new_sID, 'aDate' => $aDate, 'aTime' => $aTime, 'pID' => $pID, 'old_sID' => $old_sID]);

header("Location: staff.php");
exit();
?>