<?php 
session_start();
include 'DBconnect.php';
$conn = connect();

//prevent access with out log in
if(!isset($_SESSION['staffID'])){
	header("Location: index.php");
	exit();
}
	
if(!isset($_GET['aDate'], $_GET['aTime'], $_GET['pID'], $_GET['sID'])){
	echo "<p>Error missing appointment details</p>";
	exit();
}

$aDate = $_GET['aDate'];
$aTime = $_GET['aTime'];
$pID = $_GET['pID'];
$sID = $_GET['sID'];

//$staffName = $_SESSION['staffName'];

// sql in prepaer statement form lecture
$sql = "
	SELECT sID, sName, sType FROM Staff
	WHERE sID != :currenntStaffID
	AND sID NOT IN (SELECT sID FROM Appointment WHERE aDate = :aDate AND aTime = :aTime)";
	
$temp = $conn->prepare($sql);
$temp->execute(['currenntStaffID' => $sID, 'aDate' => $aDate, 'aTime' => $aTime]); //replace prepare value with real value 
$availabelDoctor = $temp->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Move Appointment</title>
		<link rel="stylesheet" href="style.css">
	</head>
	<header>
		<h1>COMP8870 Healthcare</h1>
	</header>
	<body>
		<div id="doc-info" style="overflow-x:auto;">
			<h3>Alternatives for appointment on at by sID = <?php echo htmlspecialchars($sID);?> <button onclick="location.href='index.php';" id="exit-butt">Exit</button> </h3>
		</div>
		<br/>
		<div id="alt-doc">
			<h3>Alternatives staff:</h3>
			<form action="delegate.php" method="POST">
				<table>
					<thead>
						<th>Name</th>
						<th>Type</th>
						<th>sID</th>
						<th><button class="dele-butt" type="submit" id="dele-butt">Delegate</button></th>
					</thead>
					<tbody>
						<!-- loop through each member from staff and create new row -->
						<?php foreach($availabelDoctor as $doctor): ?>
						<tr>
							<td><?php echo htmlspecialchars($doctor['sName']); ?></td>
							<td><?php echo htmlspecialchars($doctor['sType']); ?></td>
							<td><?php echo htmlspecialchars($doctor['sID']) ?></td>
							<td><input type="radio" name="new_sID" value="<?php echo $doctor['sID']; ?>" required /></td>
						</tr>
						<?php endforeach;?>
					</tbody>
				</table>
				<!-- prevent data lost when move to the delegate page just in case -->
				<input type="hidden" name="aDate" value="<?php echo htmlspecialchars($aDate); ?>">
				<input type="hidden" name="aTime" value="<?php echo htmlspecialchars($aTime); ?>">
				<input type="hidden" name="pID" value="<?php echo htmlspecialchars($pID); ?>">
				<input type="hidden" name="sID" value="<?php echo htmlspecialchars($sID); ?>">
			</form>
		</div>
	</body>
</html>