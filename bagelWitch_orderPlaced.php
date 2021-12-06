<!DOCTYPE html>
<?php
	// create scession and get name for order
	session_start();
	$name = $_SESSION['orderName']; 
	$finalOrder = $_SESSION['getOrder'];
	
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
		margin-top: 343px;
		text-align: center;
		background: lightblue;
	}
	
	h3 {
		text-align: center;
		margin-bottom: 80px;
	}
	
	p {
		font-size: 18px;
		text-align: center;
		margin-bottom: -10px;
	}
	
</style>

<body>
	<header>
		<?php include "bagelWitch_header.php";?>
	</header>

	<?php
		// collect the final total of the order
		$finalCost = 0;
		echo "<h3> Order Summary for " . $name;
		echo "<br>";
		$date = date('F d, Y'); 
		echo $date;
		echo "</h3>";
		
		foreach($finalOrder as $type => $price) {
  			// if the price of an item doesn't cost anything, still include it on the order
  			if(is_numeric($price) == true && $price == 0){
  				echo"<p>" . $type;
				echo str_repeat('&nbsp;', 22);
				echo " $0.00</p>";
  			}
  			// if the price is greater than zero add it onto the order and the finalCost calcuator
  			else if(is_numeric($price) == true){	
  				$finalCost += $price;
  				echo "<p>" . $type;
				echo str_repeat('&nbsp;', 10);
				echo " $". number_format($price, 2)."</p>";
  			}
  			// if the item is sliced or toasted, move on.
  			else{
 		 		echo "<p><small>" . $type. "</small></p>";
  			}		
		}
		echo "<br>";
		echo "<p><strong>Total"; 
		echo str_repeat('&nbsp;', 25);
		echo "$" . number_format($finalCost, 2)."</strong></p>";
	?>
</body>
<?php
	include "bagelWitch_footer.php";
?>
</html>
