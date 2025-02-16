<?php

include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$file = $_POST['file'];
	$xml = simplexml_load_file("contacts.xml") 
		or die("Error: Cannot create object");
	 
	// Assign values
	$affectedRow = 0;
	foreach ($xml->children() as $row) {
		$name = $row->name;
		$lastName = $row->lastName;
		$phone = $row->phone;
		 
		// SQL query to insert data into xml table
		$sql = "INSERT INTO contacts_info(name, last_name, 
			phone) VALUES ('" 
			. $name . "','" . $lastName . "','"
			. $phone . "')";
		 
		$result = mysqli_query($conn, $sql);
		 
		if (!empty($result)) {
			$affectedRow ++;
		} else {
			$error_message = mysqli_error($conn) . "\n";
		}
	}

	?>

	<center><h1>XML Data stored in Database</h1></center>
	<?php

	if ($affectedRow > 0) {
		$message = $affectedRow . " records inserted";
	} else {
		$message = "No records inserted";
	}
	echo $message;
}

header("Location: index.php");
exit();