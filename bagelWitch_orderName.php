<!DOCTYPE html>
<?php
	// create scession and get name for order
	session_start();
	$_SESSION['orderName'] = $_POST["name"];
?>
<html>
<style>
	html {
			background: grey;
		}
		body {
			background: white;
			width: 60%;
			margin-left: 300px;
			border: 1px solid;
			height: 822px;
			margin-top: 0px;
			margin-bottom: 0px;
		}
		header {
			margin-top: -25px;
			text-align: center;
			background: lightblue;
		}
		footer {
			margin-top: 400px;
			text-align: center;
			background: lightblue;
		}
		p {
			text-align: center;
			margin-left: 200px;
			margin-right: 200px;
		}
		label {
			margin-top: 150px;
			margin-left: 250px;
		}
		input[type="text"] {
			margin-top: 150px;
		}
		input[type="submit"] {
			margin-top: 150px;
		}
</style>
<body>
	<header>
		<?php include "bagelWitch_header.php";?>
	</header>
	<?php
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		// get the name of the of the user protected 
		$name =  htmlspecialchars($_POST["name"]);
		$error = "";
		
		// determine if user input has any erros 
		// if empty, prompt user to fill in name
		if(empty($name) == true){
				$error = "please enter name";
			}
		// if number is contained, ask user to include name without a number	
		else if(preg_match('/[0-9]/',$name) != 0){
			$error = "Name must not contain a number";
		}
		// if the name has a specal character, change name 
		else if(preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/',$name) != 0){
			$error = "Name must not contain a special character";
		}
		// if there are no errors, continue onto page
		else{
			header("Location: bagelWitch_orderSelect.php");
			exit;
		}}
	?>
	<p>Welcome to The Bagel Witch. Our bagels are pure perfection.
	 No need for special orders or fancy fixins - so please don't ask!
	 We are sure you will be delighted with the simplicity of our 
	 options and our ordering process!</p>
	
	<form action ="bagelWitch_orderName.php" method="post">
		<label for="name">Name for Your Order</label>
		<input id="name" name="name" type="text" value="<?php echo $name;?>"/>
		<input id="button" type="submit" value="Begin Order"/>
	</form>
	<?php echo $error;?>
</body>
<?php
	include "bagelWitch_footer.php";
?>
</html>
