<?php
	//edit.php
	require("functions.php");
	require("editFunctions.php");
	
	
	//kas kasutaja uuendab andmeid
	if(isset($_POST["update"])){
		
		updateCar(cleanInput($_POST["id"]), cleanInput($_POST["plate"]), cleanInput($_POST["color"]));
		
		header("Location: edit.php?id=".$_POST["id"]."&success=true");
        exit();	
		
	}
	
	if(isset($_POST["delete"])){
		
		deleteCar(cleanInput($_POST["id"]));
		
		header("Location: edit.php?id=".$_POST["id"]."&delete=true");
        exit();	
		
	}
	
		if(isset($_GET["success"]))
	{
		echo "salvestamine onnestus";
	}
		if(isset($_GET["delete"]))
	{
		deleteCar($_GET["id"]);
	}
	//lisame kontrolli , kui ei ole id'd addressireal siis suunan
	if(!isset($_GET["id"]))
	{
		header("Location: data.php");
		exit();
	}
	//saadan kaasa id
	$c = getSingleCarData($_GET["id"]);
	var_dump($c);


?>
<br><br>
<a href="data.php"> tagasi </a>

<h2>Muuda kirjet</h2>
  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" >
	<input type="hidden" name="id" value="<?=$_GET["id"];?>" > 
  	<label for="number_plate" >auto nr</label><br>
	<input id="number_plate" name="plate" type="text" value="<?php echo $c->plate;?>" ><br><br>
  	<label for="color" >värv</label><br>
	<input id="color" name="color" type="color" value="<?=$c->color;?>"><br><br>
  	
	<input type="submit" name="update" value="Salvesta">
	<input type="submit" name="delete" value="Kustuta">
  </form>
  <a href="?id=<?=$_GET["id"];?>&delete=true">kustuta</a>