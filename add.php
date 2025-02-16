<?php
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $lastName = $_POST['last_name'];
    $phone = $_POST['phone'];

    $sql = "INSERT INTO contacts_info (name, last_name, phone) VALUES ('$name', '$lastName', '$phone')";
    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Add Contact</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<style>
        .wrapper{
            width: 600px;
            margin: 0 auto;
        }
	</style>
</head>
<body>
	<div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
					<h2>Add New Contact</h2>
					<form method="post">
						<div class="form-group">
							<label>First Name</label><br/>
							<input type="text" name="name" required>
						</div>
						<div class="form-group">
							<label>Last name</label><br/>
							<input type="text" name="last_name" required>
						</div>
						<div class="form-group">
							<label>Phone</label><br/>
							<input type="text" name="phone" required>
						</div>
						<button type="submit" class="btn btn-success">Save</button>
						<a href="index.php" class="btn btn-secondary">Back</a>
					</form>
				</div>
			</div>
		</div>
	</div>
</body>
</html>