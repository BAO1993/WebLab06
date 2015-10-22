<!DOCTYPE html>
<html>
	<head>
		<title>Fruit Store</title>
		<link href="http://selab.hanyang.ac.kr/courses/cse326/2015/problems/pResources/gradestore.css" type="text/css" rel="stylesheet" />
	</head>

	<body>
		
		<?php
		
		# Ex 4 : 
		# Check the existance of each parameter using the PHP function 'isset'.
		# Check the blankness of an element in $_POST by comparing it to the empty string.
		# (can also use the element itself as a Boolean test!)
		 if (!isset($_POST["name"]) || $_POST["name"]=="" || !isset($_POST["member"]) || $_POST["member"]=="" || 
		 !isset($_POST["options"]) || $_POST["options"]=="" || !isset($_POST["credit_card"]) || $_POST["credit_card"]=="" || 
		 !isset($_POST["card"]) || $_POST["card"]==""){
		?>

		<!-- Ex 4 : 
			Display the below error message : --> 
			<h1>Sorry</h1>
			<p>You didn't fill out the form completely. <a href="fruitstore.html">Try again?</a></p>
		

		<?php
		# Ex 5 : 
		# Check if the name is composed of alphabets, dash(-), ora single white space.
		 } elseif (preg_match("/^[A-Z]([A-Z]\-?\s?)*[A-Z]$/i",$_POST["name"])==0 ) { 
		?>

		<!-- Ex 5 : 
			Display the below error message : --> 
			<h1>Sorry</h1>
			<p>You didn't provide a valid name. <a href="fruitstore.html">Try again?</a></p>
		

		<?php
		# Ex 5 : 
		# Check if the credit card number is composed of exactly 16 digits.
		# Check if the Visa card starts with 4 and MasterCard starts with 5. 
		 } elseif ((preg_match("/^\d{16}$/i",$_POST['credit_card'])==0 )
		 || ($_POST['card']=="Visa" && preg_match("/^4/i",$_POST['credit_card'])==0)
		 || ($_POST['card']=="Master Card" && preg_match("/^5/i",$_POST['credit_card'])==0)) {
		?>

		<!-- Ex 5 : 
			Display the below error message : --> 
			<h1>Sorry</h1>
			<p>You didn't provide a valid credit card number. <a href="fruitstore.html">Try again?</a></p>
		

		<?php
		# if all the validation and check are passed 
		 } else {
		?>

		<h1>Thanks!</h1>
		<p>Your information has been recorded.</p>
		
		<!-- Ex 2: display submitted data -->
		<ul> 
			<li>Name: <?=$_POST["name"]?> </li>
			<li>Membership Number: <?=$_POST['member']?></li>
			<li>Options:<?=processCheckbox($_POST['options'])?> </li>
			<li>Fruits: <?=$_POST["fruits"]?> - <?=$_POST["quantity"]?></li>
			<li>Credit <?=$_POST["credit_card"]?> (<?=$_POST["card"]?>)</li>
		</ul>
		
		<!-- Ex 3 : 
			<p>This is the sold fruits count list:</p> -->
		<?php
			$filename = "customers.txt";
			/* Ex 3: 
			 * Save the submitted data to the file 'customers.txt' in the format of : "name;membershipnumber;fruit;number".
			 * For example, "Scott Lee;20110115238;apple;3"
			 */
		   $content=file_get_contents($filename);
		   file_put_contents($filename, $content."\r\n".$_POST["name"].";".$_POST["member"].";".$_POST['fruits'].";".$_POST['quantity']);

		?>
		
		<!-- Ex 3: list the number of fruit sold in a file "customers.txt". -->
			This is th sold fruits count list:
		<ul>
		<?php 
		$fruitcounts = soldFruitCount($filename);
		foreach($fruitcounts as $ind => $val) {
		?>
		 <li><?=$ind?> - <?=$val?></li> 
		<?php
		}
		?>
		</ul>
		
		<?php
		}
		?>
		
		<?php
			/* Ex 3 :
			* Get the fruits species and the number from "customers.txt"
			* 
			* The function parses the content in the file, find the species of fruits and count them.
			* The return value should be an key-value array
			* For example, array("Melon"=>2, "Apple"=>10, "Orange" => 21, "Strawberry" => 8)
			*/
			function soldFruitCount($filename) { 
			$file=file($filename);
			$fruit=array();
			foreach($file as $line)
			{
				$a=explode(";",$line);
				//var_dump($a);
				$b=$a[2];
				$c=$a[3];
				$fruit[$b]=$fruit[$b]+$c;

			}
			return $fruit;
			}
			
			
			function processCheckbox($names){ 
			
			$a=implode(",",$names);
			return $a;
			}
		?>
		
	</body>
</html>
