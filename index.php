<?php
include 'db_connect.php';



if ($_SERVER["REQUEST_METHOD"] == "POST") {

	$file = $_FILES['file']['tmp_name'];
	$xml = simplexml_load_file($file) 
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
	
}

$sql = "SELECT * FROM contacts_info ORDER BY id DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Contact List</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
	<style>
        .wrapper{
            width: 600px;
            margin: 0 auto;
        }
        table tr td:last-child{
            width: 120px;
        }
		.top-right-buttons {
            display: flex;
            justify-content: flex-end;
            gap: 10px; /* Space between buttons */
            padding: 10px;
        }
		.table-container {
            max-height: 500px; /* Set vertical height */
            max-width: 600px; /* Set horizontal width */
            overflow: auto; /* Enables both vertical & horizontal scroll */
            border: 1px solid #ccc; /* Optional border */
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 10px;
            border: 1px solid #ccc;
            text-align: left;
            white-space: nowrap; /* Prevents text from wrapping */
        }

        th {
            background-color: #f8f9fa;
            position: sticky;
            top: 0; /* Keeps the header fixed */
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
			<div class='row'>
				<div class='col-md-12'>
				<?php 
					if(!empty($affectedRow)) {
						echo $affectedRow." records saved"; 
					}
				?>
				</div>
			</div>
			<div class="row">
                <div class="col-md-12">
                    <div class="mt-5 mb-3 clearfix">
						<h2 class="pull-left">Contact Details</h2>
						
						<div class="top-right-buttons">
							<a href="#" class="btn btn-success pull-right" data-bs-toggle="collapse" data-bs-target="#uploadFile" ><i class="fa fa-file-upload"></i> Upload file</a>
							<a href="add.php" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Add New Contact</a>
						</div>
					</div>
					<div id="uploadFile" class="collapse">
						<div class="card card-body">
							<form method="post" enctype='multipart/form-data'>
								<div class='row'>
									<input type='file' name='file'/>
								</div>
								<div class='row'>
									<div class='col-sm-12' align="right">
										<button type="submit" class="btn btn-success btn-sm">Save</button>
									</div>
								</div>
							</form>
						</div>
					</div><br/>
					<div class="table-container">
						<table border="1" class="table table-bordered table-striped">
							<thead>
								<tr>
									<th>Name</th>
									<th>Last Name</th>
									<th>Phone</th>
									<th>Actions</th>
								</tr>
							</thead>
							<tbody>
								<?php while ($row = $result->fetch_assoc()): ?>
								<tr>
									<td><?= $row['name']; ?></td>
									<td><?= $row['last_name']; ?></td>
									<td><?= $row['phone']; ?></td>
									<td>
										<a href="update.php?id=<?= $row['id']; ?>" class="mr-3" title="Update Record" data-toggle="tooltip"><span class="fa fa-pencil"></span></a>
										<a href="delete.php?id=<?= $row['id']; ?>" title="Delete Record" data-toggle="tooltip" onclick="return confirm('Are you sure?')"><span class="fa fa-trash"></span></a>
									</td>
								</tr>
								<?php endwhile; ?>
							</tbody>
							
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>
