<?php
session_start(); 
include 'DBconnect.php';
$conn = connect(); //call connect function in the DBconnect

// this use for validate staff login staffID and staffName are send via form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $staffID = $_POST['staffID'];
    $staffName = $_POST['staffName']; 

	//check if staffID from form match sID in the table or not 
	//if it not match send user back to landing page
    $sql = "SELECT * FROM Staff WHERE sID = '$staffID' AND sName = '$staffName'";
    $result = $conn->query($sql);
	
    if ($result->rowCount() == 0) {
        header("Location: index.php"); 
        exit();
    }

    $_SESSION['staffID'] = $staffID;
    $_SESSION['staffName'] = $staffName;
}

// prevent acess with out login
if (!isset($_SESSION['staffID'])) {
    header("Location: index.php"); 
    exit();
}


$staffID = $_SESSION['staffID'];
$staffName = $_SESSION['staffName'];

$sql = "
    SELECT a.aDate, a.aTime, a.pID, a.sID, p.pName
    FROM Appointment a 
    JOIN Patient p ON a.pID = p.pID 
    WHERE a.sID = '$staffID'
    ORDER BY a.aDate, a.aTime";
$appointments = $conn->query($sql);

$sql_pres = "
	SELECT m.mID, m.mName, m.mDosage, p.pID, p.prDate, p.prPrice
	FROM Medication m 
	JOIN Prescription p ON m.mID = p.mID
	WHERE p.sID = '$staffID'
	ORDER BY p.pID, p.mID, p.prDate, p.prPrice DESC";
$prescription = $conn->query($sql_pres);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Staff Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<header>
	<h1>COMP8870 Healthcare</h1>
</header>
<body>

    <div id="doc-info">
    <h3 id="des-2"><strong>Doctor Information:</strong> Displaying data for <?php echo htmlspecialchars($staffName); ?> (sID = <?php echo $staffID; ?>) <button class="exit" onclick="location.href='index.php';" id="exit-butt">Exit</button> </h3> 
    
	</div>
	<!-- for appointments table  -->
	<br/>
	<div id="doc-appoint" style="overflow-x:auto;">
		<h3>Appointments</h3>
		<table>
			<!-- table head container -->
			<thead>
				<tr>
					<th>Date</th>
					<th>Time</th>
					<th>Patient</th>
					<th>Action</th>
				</tr>
			</thead>
			<!-- loop by grab each row in appointments 1 row at a time -->
			<!-- then create a new row and inseart data in td -->
			<tbody>
				<?php while ($row = $appointments->fetch(PDO::FETCH_ASSOC)): ?> <!-- found this PDO:FETCH_ASSOC in PHP document -->
					<tr>
						<td><?php echo htmlspecialchars($row['aDate']); ?></td>
						<td><?php echo htmlspecialchars($row['aTime']); ?></td>
						<td><?php echo htmlspecialchars($row['pName']). " (pID " . htmlspecialchars($row['pID']) . ")"; ?></td>
						<td>
							<button id="move-butt">
							<a href="move.php?aDate=<?php echo $row['aDate']; ?>&aTime=<?php echo $row['aTime']; ?>&pID=<?php echo $row['pID']; ?>&sID=<?php echo $row['sID']; ?>">Move</a>
							</button>
						</td>
					</tr>
				<?php endwhile; ?>
			</tbody>
		</table>
	</div>
	<br/>
	<!-- for prescription table -->
	<div id="pres-container" style="overflow-x:auto;"> <!-- for making responsive table found on w3school -->
		<h3>Prescription</h3>
		<form action="delete.php" method="POST">
			<table>
				<thead>
					<th>Patient</th>
					<th>mID</th>
					<th>Date</th>
					<th>Name</th>
					<th>Dosage</th>
					<th>Price</th>
					<th><button id="delete-butt" type="submit">Delete</button></th>
				</thead>
				<tbody>
					<?php while($row = $prescription->fetch(PDO::FETCH_ASSOC)): ?>
						<tr>
							<td><?php echo htmlspecialchars($row["pID"]) ?></td>
							<td><?php echo htmlspecialchars($row["mID"])?></td>
							<td><?php echo htmlspecialchars($row["prDate"]) ?></td>
							<td><?php echo htmlspecialchars($row["mName"]) ?></td>
							<td><?php echo htmlspecialchars($row["mDosage"]) ?></td>
							<td><?php echo htmlspecialchars($row["prPrice"]) ?></td>
							<td>
								<input type="checkbox" name="delete[]" value="<?php echo $row['pID'] . '|' . $row['mID'] . '|' . $row['prDate']; ?>" required  oninvalid="this.setCustomValidity('Please select one or more of this box if you want to proceed. ')"  onvalid="" />
							</td>
						</tr>
					<?php endwhile; ?>
				</tbody>
			</table>
		</form>
	</div>
</body>
</html>
