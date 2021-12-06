<?php
session_start();


	$hn = "localhost";
	$un = "mcuser";
	$pw = "Pa55word";
	$conn = new mysqli($hn, $un, $pw);
	if ($conn->connect_error) die("Error Connecting to db.");

	$query = "USE VolunteerList";
	$result = $conn->query($query);
	if(!$result) { 
		echo("<h2> Connection Error: " . $conn->error . " </h2>\n");
	}


	$errorsPresent = false;
	$err1 = "";
	$err2 = "";
	$slot1 = 5;
	$upper = '/^(?=.*[A-Z]).{8,}$/';
	$lower = '/^(?=.*[a-z]).{8,}$/';
	$number = '/^(?=.*[0-9])/';

	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$first = $_POST['fname'];
		$last = $_POST['lname'];
		$user_email = $_POST['user_email'];
		if(empty($first)) {
			$err1 = "Must contain input for first name.";
			$errorsPresent = true;
		} else if(empty($last)) {
			$err1 = "Must contain input for last name.";
			$errorsPresent = true;
		}
		else if(empty($user_email)) {
			$err1 = "Must contain input for email.";
			$errorsPresent = true;
		}
		if(preg_match($number, $first)) {
			$err2 = "Name can't contain numbers.";
			$errorsPresent = true;
		}
		else if(preg_match($number, $last)) {
			$err2 = "Name can't contain numbers.";	
			$errorsPresent = true;
		}

		if($errorsPresent) {
			$_SESSION['fname'] = $first;
			$_SESSION['lname'] = $last;
			$_SESSION['email'] = $user_email;
			$_SESSION['err1'] = $err1;
			$_SESSION['err2'] = $err2;
			$_SESSION['message'] = "Invalid Input.";
			header('Location: ' . "Volunteer_Registration.php");
			exit();
		}
		
		$query = "INSERT INTO Volunteer (firstname, lastname, email)
					VALUES ('$first', '$last', '$user_email')";
		$result = $conn->query($query);

		
		$query = "SELECT id FROM Volunteer WHERE firstname = '$first' AND lastname = '$last' AND email = '$user_email'";
		$vol = $conn->query($query);
		while($row = $vol->fetch_array(MYSQLI_ASSOC)) {
			$id = $row["id"];
		}

		$slot = $_POST['slot'];
		$query = "INSERT INTO VolunteerTimes (volunteer_id, timeslot_id)
					VALUES ('$id', '$slot')";
		$result = $conn->query($query);
		if(!$result) {
			$_SESSION['message'] = "Duplicate registration not processed. Thanks, " . $first . "!";
			$_SESSION['fname'] = $first;
			$_SESSION['lname'] = $last;
			$_SESSION['email'] = $user_email;
			header('Location: ' . "Volunteer_Registration.php");
			exit();
		}

		else if(isset($_POST['submit'])){
			if(!empty($_POST['time'])) {
				$selected = $_POST['time'];
				$slot1 = $slot1 - 1;
			}
		}

		$query = "SELECT COUNT(*) as cnt FROM VolunteerTimes WHERE volunteer_id = '$id'";
		$count = $conn->query($query);
		while($row = $count->fetch_array(MYSQLI_ASSOC)) {
			$cnt = intval($row["cnt"]);
		}
		



		if(!$errorsPresent) {
			if($cnt > 1) {
				$_SESSION['message'] = "Thank you for being so generous with your time, $first!";
			} else {
				$_SESSION['message'] = "Successfully registered.";
			}
			$_SESSION['fname'] = "";
			$_SESSION['lname'] = "";
			$_SESSION['email'] = "";
			$_SESSION['err1'] = "";
			$_SESSION['err2'] = "";
			header('Location: ' . "Volunteer_Registration.php");
			exit();
		}
		echo "</html>";
		exit();
	
	}

	$conn->close();
?>