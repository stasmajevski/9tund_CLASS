<?php

	require("../../../config.php");
	
	// podsoedinaem klass User
	
	
	
	require("helper_class.php");
	
	// inicializiruem objekti
	$database ="if16_stanislav";
	// teper' ne nado global peremennie
	$mysqli = new mysqli($serverHost, $serverUsername, $serverPassword, $database);

	$Helper = new Helper();
	
	
	
	// functions.php
	//var_dump($GLOBALS);
	
	// see fail, peab olema kõigil lehtedel kus 
	// tahan kasutada SESSION muutujat
	session_start();
	
	//***************
	//**** SIGNUP ***
	//***************
	
	

	
	
	
	
	
	
	/*function sum($x, $y) {
		
		return $x + $y;
		
	}
	
	
	function hello($firsname, $lastname) {
		
		return "Tere tulemast ".$firsname." ".$lastname."!";
		
	}
	
	echo sum(5123123,123123123);
	echo "<br>";
	echo hello("Romil", "Robtsenkov");
	echo "<br>";
	echo hello("Juku", "Juurikas");
	*/

?>