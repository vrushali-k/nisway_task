<?php
include 'db_connect.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $result = $conn->query("SELECT * FROM contacts_info WHERE id=$id");
    $contact = $result->fetch_assoc();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $lastName = $_POST['last_name'];
    $phone = $_POST['phone'];

    $sql = "UPDATE contacts_info SET name='$name', last_name='$lastName', phone='$phone' WHERE id=$id";
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
    <title>Edit Contact</title>
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
					<h2>Edit Contact</h2>
					<form method="post">
						<div class="form-group">
							<input type="hidden" name="id" value="<?= $contact['id']; ?>">
							<label>First Name</label><br/>
							<input type="text" name="name" value="<?= $contact['name']; ?>" required>
						</div>
						<div class="form-group">
							<label>Last name</label><br/>
							<input type="text" name="last_name" value="<?= $contact['last_name']; ?>" required>
						</div>
						<div class="form-group">
							<label>Phone</label><br/>
							<input type="text" name="phone" value="<?= $contact['phone']; ?>" required>
						</div>
						 <button type="submit" class="btn btn-warning">Update</button>
						<a href="index.php" class="btn btn-secondary">Back</a>
					</form>
				</div>
			</div>
		</div>
	</div>
</body>
</html>