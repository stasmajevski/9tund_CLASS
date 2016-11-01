<?php class Car
{
	private $connection;
	
	
	function __construct($mysqli)
	{
			// osobennost v PHP   $this ukazivaet na objekt klassa
	  $this->connection = $mysqli;
	  
	}
	function saveCar ($plate, $color) {
		
	
		$stmt = $this->connection->prepare("INSERT INTO car_and_colors (plate, color) VALUES (?, ?)");
	
		echo $this->connection->error;
		
		$stmt->bind_param("ss", $plate, $color);
		
		if($stmt->execute()) {
			echo "salvestamine �nnestus";
		} else {
		 	echo "ERROR ".$stmt->error;
		}
		
		$stmt->close();
		
		
	}
	
	
	function getAllCars() {
		

		
		$stmt = $this->connection->prepare("
			SELECT id, plate, color
			FROM car_and_colors
			WHERE deleted IS NULL
		");
		echo $this->connection->error;
		
		$stmt->bind_result($id, $plate, $color);
		$stmt->execute();
		
		
		//tekitan massiivi
		$result = array();
		
		// tee seda seni, kuni on rida andmeid
		// mis vastab select lausele
		while ($stmt->fetch()) {
			
			//tekitan objekti
			$car = new StdClass();
			
			$car->id = $id;
			$car->plate = $plate;
			$car->carColor = $color;
			
			//echo $plate."<br>";
			// iga kord massiivi lisan juurde nr m�rgi
			array_push($result, $car);
		}
		
		$stmt->close();
		
		
		return $result;
	}
	function getSingleCarData($edit_id){
    
        
		$stmt = $this->connection->prepare("SELECT plate, color FROM car_and_colors WHERE id=? AND deleted IS NULL");

		$stmt->bind_param("i", $edit_id);
		$stmt->bind_result($plate, $color);
		$stmt->execute();
		
		//tekitan objekti
		$car = new Stdclass();
		
		//saime �he rea andmeid
		if($stmt->fetch()){
			// saan siin alles kasutada bind_result muutujaid
			$car->plate = $plate;
			$car->color = $color;
			
			
		}else{
			// ei saanud rida andmeid k�tte
			// sellist id'd ei ole olemas
			// see rida v�ib olla kustutatud
			header("Location: data.php");
			exit();
		}
		
		$stmt->close();

		
		return $car;
		
	}


	function updateCar($id, $plate, $color){
    	
        
		$stmt = $this->connection->prepare("UPDATE car_and_colors SET plate=?, color=? WHERE id=? AND deleted IS NULL");
		$stmt->bind_param("ssi",$plate, $color, $id);
		
		// kas �nnestus salvestada
		if($stmt->execute()){
			// �nnestus
			echo "salvestus �nnestus!";
		}
		
		$stmt->close();
		
		
	}
	
		function deleteCar($id){
			
		
   
		$stmt = $this->connection->prepare("UPDATE car_and_colors SET deleted=NOW() WHERE id=?");
		$stmt->bind_param("i",$id);
		
		// kas �nnestus salvestada
		if($stmt->execute()){
			// �nnestus
			echo "kustutamine �nnestus!";
		}
		
		$stmt->close();
	
		
	}
}
?>