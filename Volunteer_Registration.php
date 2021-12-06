<?php
	session_start();

	$_SESSION['ref'] = $_SERVER['SCRIPT_NAME'];
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Volunteer Registration</title>
		<style>
			html {
				background: #228B22;
			}
			body {
				background: #FFFACD;
				width: 90%;
				border: 1px solid;
				height: 500px;
				margin-left: 80px;
				margin-top: 150px;
			}
			h1 {
				text-align: center;
				color: blue;
				display: shadow;
				font-size: 50px;
				text-shadow: 1px 1px #000000;
				text-decoration: underline;
			}
			p {
				text-align: center;
				margin-bottom: 30px;
			}
			fieldset {
				width: 60%;
				margin-left: 300px;
			}
			label{
				float: left;
				clear: left;
				margin-top: 15px;
				margin-left: 100px;
				width: 180px;
			}
			input[type="text"]{
				float: left;
				margin-top: 15px;
				width: 300px;
				margin-left: -80px;
			}
			input[type="email"]{
				float: left;
				margin-top: 15px;
				width: 300px;
				margin-left: -80px;
			}
	
			select{
				float: left;
				margin-left: -80px;
				margin-top: 15px;
				width: 300px;
			}
			
			input[type="submit"]{
				float: left;
				margin-top: 60px;
				width: 300px;
				margin-left: -250px;
			}

			.error {
				color: red;
			}
		</style>
	</head>

<body>
<?php
	function createDatabaseAndTables($conn) {

	$query = "CREATE DATABASE IF NOT EXISTS VolunteerList";
	$result = $conn->query($query);
	if(!$result) die("Error");

	$query = "USE VolunteerList";
	$result = $conn->query($query);
	if(!$result) { 
		echo("<h2> Connection Error: " . $conn->error . " </h2>\n");
	}

	$query = "CREATE TABLE IF NOT EXISTS Volunteer (
		id INT NOT NULL AUTO_INCREMENT,
		firstname VARCHAR(75) NOT NULL,
		lastname VARCHAR(75) NOT NULL,
		email VARCHAR(100) NOT NULL UNIQUE,
		PRIMARY KEY (id))";
		
	$result = $conn->query($query);
	if(!$result) die("Error creating Volunteer table.");

	$query = "CREATE TABLE IF NOT EXISTS VolunteerSlots (
	id INT NOT NULL AUTO_INCREMENT,
	timeslot VARCHAR(100) UNIQUE,
	PRIMARY KEY (id))";
	$result = $conn->query($query);
	if(!$result) die("Error creating VolunteerSlots table.");

	$query = 'INSERT INTO VolunteerSlots (timeslot)
					VALUES
					  ("7:30pm - 8:00pm"),
					  ("8:00pm - 8:30pm"),
					  ("8:30pm - 9:00pm")';
	$result = $conn->query($query);

	$query = "CREATE TABLE IF NOT EXISTS VolunteerTimes (
	volunteer_id INT NOT NULL,
	timeslot_id  INT NOT NULL,
	PRIMARY KEY (volunteer_id, timeslot_id))";
	$result = $conn->query($query);
	if(!$result) die("Error creating VolunteerTimes table.");
}
	$hn = "localhost";
	$un = "mcuser";
	$pw = "Pa55word";
	$conn = new mysqli($hn, $un, $pw);
	if ($conn->connect_error) die("Error connecting to db.");
	createDatabaseAndTables($conn);


	$query = "SELECT VolunteerList.VolunteerSlots.id as 'TimeSlotId', VolunteerList.VolunteerSlots.timeslot as 'TimeSlot', 5 - COUNT(VolunteerList.VolunteerTimes.timeslot_id) as 'OpenSlots' 
	          from VolunteerList.VolunteerSlots LEFT JOIN VolunteerList.VolunteerTimes on VolunteerList.VolunteerTimes.timeslot_id = Volunteerlist.VolunteerSlots.id 
			  LEFT JOIN VolunteerList.Volunteer on Volunteerlist.Volunteer.id = VolunteerList.VolunteerTimes.volunteer_id GROUP BY VolunteerList.VolunteerSlots.id";
	$result = $conn->query($query);
	if(!$result) { 
		//echo("<h2> Error Retrieving timeslot data: " . $conn->error . " </h2>\n");
		$slots = [];
	} else {
		$slots = $result;
	}
	
?>


	<h1>Volunteer Registration</h1>
	<p>Thank you for your willingness to colunteer to help Maria's Extremely Worthy Cause.
	   Please fill out the form to sign up for a shift. You may register for more than one slot.
	   Duplicate registration (for the same time slot) will not be processed.</p>
	

	<form action="Volunteer.php" method="post" id="register">
			<fieldset id="list">
			<label for="fname">First Name</label>
			<input type="text" id="fname" name="fname" value="<?php echo $_SESSION['fname'];?>" />
			<label class="error"><?php echo $_SESSION['err1'];?></label>
			<label for="lname">Last Name</label>
			<input type="text" id="lname" name="lname" value="<?php echo $_SESSION['lname'];?>"  />
			<label class="error"><?php echo $_SESSION['err2'];?></label>
			<label for="user_email">Email</label>
			<input type="email" id="user_email" name="user_email" value="<?php echo $_SESSION['email'];?>" required />
			<label for="slot">Volunteer Slot</label>
			<select name="slot" form="register">
				<?php
					while($row = $slots->fetch_array(MYSQLI_ASSOC)) {
						if(intval($row["OpenSlots"]) <= 0) {
							echo('<option disabled value="' . $row["TimeSlotId"] . '"/>' . $row["TimeSlot"] . " (" . $row["OpenSlots"] . " of 5 slots open)</option>");
						} else {
							echo('<option value="' . $row["TimeSlotId"] . '"/>' . $row["TimeSlot"] . " (" . $row["OpenSlots"] . " of 5 slots open)</option>");
						}
					}
				?>
			</select>
			<input type="submit" value="Register" />
			<h2><?php echo $_SESSION["message"];?></h2>
		</fieldset>
	</form>
	
</body>
</html>