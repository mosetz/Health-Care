<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>ss2876 Healthcare</title>
		<link href="style.css" rel="stylesheet" type="text/css" >
		<script>
			function showLogin(role){
				document.getElementById('staff-container').style.display = (role === 'staff') ? 'block' : 'none';
				document.getElementById('user-container').style.display = (role === 'user') ? 'block' : 'none';
			}
		</script>
	</head>
	<header>
		<h1>COMP8870 Healthcare</h1>
	</header>
	<body>
		<div id="container">
			<h3 id="des1">Please log in using the appropriate method below</h3>
			<button class="login" onclick="showLogin('user')">User Login</button>
			<button class="login" onclick="showLogin('staff')">Staff Login</button>
			
			<!-- staff login -->
			<div id="staff-container" style="display: none;">
				<h2>Staff Login</h2>
				<form id="staff-form" action="staff.php" method="POST">
					<label for="staffName">Staff name:</label>
					<input type="text" placeholder="Enter Staff name" name="staffName" required />
					<br/>
					<br/>
					<label for="staffID">Staff ID:</label>
					<input type="text" placeholder="Enter Staff ID" name="staffID" required  />
					<br/>
					<br/>
					<button class="enter-butt" type="submit">Enter</button>
				</form>
			</div>
		
			<!-- user login -->
			<div id="user-container" style="display: none;">
				<h2>User Login</h2>
				<form id="user-form" action="patient.php" method="POST">
					<label for="=pID">Patient ID:</label>
					<input type="text" placeholder="Enter Patient ID" name="pID" required />
					<br/>
					<br/>
					<label for="NSH_number">NHS Number:</label>
					<input type="text" placeholder="Enter NHS Number" name="NHS_number" required />
					<br/>
					<br/>
					<button class="enter-butt" type="submit">Enter</button>
				</form>
			</div>
		</div>
	</body>
</html>