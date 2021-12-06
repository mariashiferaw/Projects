<!DOCTYPE html>
<?php
	// create scession and get name for order
	session_start();
	
	$_SESSION['getOrder'] = array();

?>
<html>
	<?php
		if($_SERVER['REQUEST_METHOD'] == 'POST'){
		
			// add bagel and price to the array 			
   		 	$_SESSION['getOrder'][$_POST["bagel"]] = 2.5;
   		 	
   		 	// determine if check boxes were selcted and need to be added onto order
          	if($_POST["slice"] == "Sliced" && $_POST["toast"] == "Toasted")
          	{
          		$_SESSION['getOrder']["Sliced and Toasted"] = "Sliced and Toasted";
          	}
          	else if($_POST["slice"] == "Sliced" && $_POST["toast"] != "Toasted")
          	{
          		$_SESSION['getOrder']["Sliced"] = "Sliced";
          	}
          	else if($_POST["slice"] != "Sliced" && $_POST["toast"] == "Toasted")
          	{
          		$_SESSION['getOrder']["Toasted"] = "Toasted";
          	}
   		 		
   		 	// detetmine what topping was selcted and add the topping and price into the order array	 	
			switch($_POST["top"]){
				case"None":
					$_SESSION['getOrder'][$_POST["top"]] = 0;
					break;
				case"Cream Cheese":
					$_SESSION['getOrder'][$_POST["top"]] = 1;
					break;
				case"Peanut Butter":
				case"Grape Jelly":
				case"Strawberry Preserves":
					$_SESSION['getOrder'][$_POST["top"]] = .5;
					break;
		
				case"Butter":
					$_SESSION['getOrder'][$_POST["top"]] = .25;
					break;
				default:
					$_SESSION['getOrder'][$_POST["top"]] = 0;
			}
			
			// detetmine what sides were selcted and add the sides and price into the order array	
			switch($_POST["side"]){
				case"Fruit Cup":
				case"Mixed Berries":
					$_SESSION['getOrder'][$_POST["side"]] = 2;
					break;
				default:
					$_SESSION['getOrder'][$_POST["side"]] = 0.0;
			}
			// detetmine what beverage was selcted and add the beverage and price into the order array	
			switch($_POST["beverage"]){
				case"Coffee":
				case"Tea":
					$_SESSION['getOrder'][$_POST["beverage"]] = 2.5;
					break;
		
				case"Orange Juice":
					$_SESSION['getOrder'][$_POST["beverage"]] = 2;
					break;
				default:
					$_SESSION['getOrder'][$_POST["beverage"]] = 0;
			}
			
			// continue to placed order
			header("Location: bagelWitch_orderPlaced.php");
			exit;
		}
	?>
	
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
			margin-top: -20px;
			text-align: center;
			background: lightblue;
		}
		footer {
			margin-top: 243px;
			text-align: center;
			background: lightblue;
		}
		
		legend {
			text-align: center;
		}
		
		.one {
			text-align: center;
			margin-left: 150px;
			width: 70%;
			margin-bottom: 20px;
		}
		
		.two {
			text-align: center;
			margin-left: 150px;
			width: 70%;
			margin-bottom: 20px;
		}
		
		.three {
			text-align: center;
			margin-left: 150px;
			width: 70%;
			margin-bottom: 20px;
		}
		
		.four {
			text-align: center;
			margin-left: 150px;
			width: 70%;
		}
	
		input[type="submit"] {
			margin-top: 90px;
			margin-left: 450px;
		}
		
	</style>
	
<body>
	<header>
		<?php include "bagelWitch_header.php";?>
	</header>
	<form action="bagelWitch_orderSelect.php" method="post">
		<fieldset class="one">
			<legend><strong>Bagel ($2.50)</strong></legend>
			<input type="radio" name ="bagel" id="plain" value="Plain" required/>
			<label for="plain" class="Bagel">Plain</label>
			
			<input type="radio" name ="bagel" id="wheat" value="Whole Wheat"/>
			<label for="wheat" class="Bagel">Whole Wheat</label>
			
			<input type="radio" name ="bagel" id="raisin" value="Cinnamon Rasisin"/>
			<label for="raisin" class="Bagel">Cinnamon Raisin</label>
			
			<input type="radio" name ="bagel" id="everything" value="Everything"/>
			<label for="everything" class="Bagel">Everything</label>
			
			<input type="checkbox" id="sliced" name="slice" value="Sliced">
  			<label for="sliced">Sliced</label>
  			
  			<input type="checkbox" id="toasted" name="toast" value="Toasted">
  			<label for="toasted">Toasted</label>
		</fieldset>
		
		<fieldset class="two">
			<legend><strong>Toppings</strong></legend>
			<input type="radio" name ="top" id="cream" value="Cream Cheese" required/>
			<label for="cream" class="topping">Cream Cheese</label>
			
			<input type="radio" name ="top" id="peanut" value="Peanut Butter"/>
			<label for="peanut" class="topping">Peanut Butter</label>
			
			<input type="radio" name ="top" id="grape" value="Grape Jelly"/>
			<label for="grape" class="topping">Grape Jelly</label>
			
			<input type="radio" name ="top" id="strawberry" value="Strawberry Preserves"/>
			<label for="strawberry" class="topping">Strawberry Preserves</label>
			
			<input type="radio" name ="top" id="butter" value="Butter"/>
			<label for="butter" class="topping">Butter</label>
			
			<input type="radio" name ="top" id="none" value="None"/>
			<label for="none" class="topping">None</label>
		</fieldset>
		
		<fieldset class="three">
			<legend><strong>Side</strong></legend>
			<input type="radio" name ="side" id="apple" value="Apple" required/>
			<label for="apple" class="sides">Apple</label>
			
			<input type="radio" name ="side" id="banana" value="Banana"/>
			<label for="banana" class="sides">Banana</label>
			
			<input type="radio" name ="side" id="fruit" value="Fruit Cup"/>
			<label for="fruit" class="sides">Fruit Cup</label>
			
			<input type="radio" name ="side" id="mixed" value="Mixed Berries"/>
			<label for="mixed" class="sides">Mixed Berries</label>
		</fieldset>
		
		<fieldset class="four">
			<legend><strong>Beverage</strong></legend>
			<input type="radio" name ="beverage" id="coffee" value="Coffee" required/>
			<label for="coffee" class="drinks">Coffee</label>
			
			<input type="radio" name ="beverage" id="tea" value="Tea"/>
			<label for="tea" class="drinks">Tea</label>
			
			<input type="radio" name ="beverage" id="orange" value="Orange Juice"/>
			<label for="orange" class="drinks">Orange Juice</label>
			
			<input type="radio" name ="beverage" id="water" value="Water"/>
			<label for="water" class="drinks">Water</label>
		</fieldset>
		
		<input id="button" type="submit" value="Place Order"/>
	</form>
</body>
<?php
	include "bagelWitch_footer.php";
?>
</html>
