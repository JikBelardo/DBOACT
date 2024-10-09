// number 3

<?php require_once 'core.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<style>
		table, th, td {
		  border:1px solid black;
		}
	</style>
</head>
<body>
	
	<?php  
	 
	// SQL code
	$stmt = $pdo->prepare("SELECT Vehicles.vehicle_id, Vehicles.manufacturer, Vehicles.model,
							 Vehicles.year_created, CONCAT('Component: ', Component_Sensors.component_type)
							FROM vehicles
							JOIN Component_Sensors on Vehicles.vehicle_id = Component_Sensors.vehicle_id
							UNION
							SELECT Vehicles.vehicle_id, Vehicles.manufacturer, Vehicles.model,
							 Vehicles.year_created, CONCAT('Health Score: ', Diagnostic_Reports.overall_health_score)
							FROM vehicles
							JOIN Diagnostic_Reports on Vehicles.vehicle_id = Diagnostic_Reports.vehicle_id
							");
	// Console
	if ($stmt->execute()) {
		echo "<pre>";
		print_r($stmt->fetchALL());
		echo "<pre>";
	}
	?>


</body>
</html>


// number 4

<?php require_once 'core.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<style>
		table, th, td {
		  border:1px solid black;
		}
	</style>
</head>
<body>
	
	<?php  
	 
	// SQL code
	$stmt = $pdo->prepare("SELECT Vehicles.manufacturer, Vehicles.model, Vehicles.year_created,
							Failure_Predictions.failure_probability as probability_of_failure
							FROM vehicles
							JOIN Failure_Predictions on Vehicles.vehicle_id = Failure_Predictions.vehicle_id
							WHERE year_created between 2015 and 2022
							AND manufacturer = 'Toyota' 
							group by manufacturer");
	// Console
	if ($stmt->execute()) {
		echo "<pre>";
		print_r($stmt->fetch());
		echo "<pre>";
	}
	?>


</body>
</html>



// number 5

<?php require_once 'core.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<style>
		table, th, td {
		  border:1px solid black;
		}
	</style>
</head>
<body>
	
	<?php  
	 
	// SQL code
	$query = "INSERT INTO Users (user_id, name, email, phone_number, user_type, password, location)
				VALUES (?,?,?,?,?,?,?)";
	// prepare the query
	 $stmt = $pdo->prepare($query);

	 // adding the values
	 $executeQuery = $stmt->execute(
		[11, 'Buboy kalawang', 'kalawang@gmail.com', '0976542211', 'Customer', 'hahahaha', 'Kalamares street tondo osaka japan']
	 );
	// Console
	if ($executeQuery) {
		echo "Success";
	}
	else {
		echo "Failed";
	}
	?>


</body>
</html>



// number 6


<?php require_once 'core.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<style>
		table, th, td {
		  border:1px solid black;
		}
	</style>
</head>
<body>
	
	<?php  
	 
	// SQL code
	$query = "DELETE FROM users
				WHERE name = 'Buboy kalawang'";
	// prepare the query
	 $stmt = $pdo->prepare($query);

	 // adding the values
	 $executeQuery = $stmt->execute();
	// Console
	if ($executeQuery) {
		echo "Success";
	}
	else {
		echo "Failed";
	}
	?>


</body>
</html>



// number 7


<?php require_once 'core.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<style>
		table, th, td {
		  border:1px solid black;
		}
	</style>
</head>
<body>
	
	<?php  
	 
	// SQL code
	$query = "UPDATE Diagnostic_Reports
				SET maintenance_suggestions = ?, component_status = ?
				WHERE report_id = 5
				";
	// prepare the query
	 $stmt = $pdo->prepare($query);

	 // adding the values
	 $executeQuery = $stmt->execute(
		["ipa kilo mo na yan bahaha", "kinakalawang na bai"]
	 );
	// Console
	if ($executeQuery) {
		echo "Success";
	}
	else {
		echo "Failed";
	}
	?>


</body>
</html>





// number 8


<?php require_once 'core.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
            text-align: left;
        }
    </style>
</head>
<body>
	
	<?php  
	 
	// SQL code
	$query = "SELECT Users.name, Vehicles.manufacturer, Vehicles.model, 
					Diagnostic_Reports.component_status, Failure_Predictions.failure_probability
				FROM Vehicles
				JOIN Users on Vehicles.user_id = vehicles.user_id
				JOIN Diagnostic_Reports on Vehicles.vehicle_id = Diagnostic_Reports.vehicle_id
				JOIN Failure_Predictions on Vehicles.vehicle_id = Failure_Predictions.vehicle_id
				ORDER BY Users.name
				";
	// Console
	$stmt = $pdo->prepare($query);
	if ($stmt->execute()) {
		$query = $stmt->fetchALL();
	}
	else {
		echo "query failed";
	}
	?>

	<table>
		<tr>
			<th>name</th>
			<th>manufacturer</th>
			<th>model</th>
			<th>status</th>
			<th>Porability of failure</th>
		</tr>
		<?php
			foreach ($query as $row) { ?>
		<tr>
			<td><?php echo $row['name']; ?></td>
			<td><?php echo $row['manufacturer']; ?></td>
			<td><?php echo $row['model']; ?></td>
			<td><?php echo $row['component_status']; ?></td>
			<td><?php echo $row['failure_probability']; ?></td>
		</tr>
		<?php	} ?>
		?>
	</table>


</body>
</html>
