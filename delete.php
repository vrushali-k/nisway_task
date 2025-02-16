<?php
include 'db_connect.php';

if (isset($_GET['id'])) {
    
    //$conn->query("DELETE FROM contacts_info WHERE id=$id");
	
	 $sql = "DELETE FROM contacts_info WHERE id = ?";

	 if($stmt = mysqli_prepare($conn, $sql)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "i", $id);
        
        // Set parameters
		$id = $_GET['id'];
			
        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            // Records deleted successfully. Redirect to landing page
            header("location: index.php");
            exit();
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
    } 
     
    // Close statement
    mysqli_stmt_close($stmt);
    
}

header("Location: index.php");
exit();
?>