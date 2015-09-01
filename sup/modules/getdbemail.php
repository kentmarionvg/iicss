<?php
	//error_reporting(E_ERROR);
	
	$servername = "localhost";
	$username = "root";
	$password = "secret";
	$dbname = "iicssched";
	
	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	
	$order = 'fld_username';
	$queryreg = 'SELECT * FROM tbl_user WHERE key_role = 2';
	
	
	$sql = $queryreg." ORDER BY ".$order;
	
	$result = $conn->query($sql);
	$num_rows= mysqli_num_rows($result);
	$counter = 1;
	$placeholderunits = 1;
	
	echo "<center> <b>$num_rows Entries Returned\n</b></center>";
	
	if ($result->num_rows > 0) {
		// output data of each row
		
		while($row = $result->fetch_assoc()) {
			
				echo "<tr><td><center>".$counter++."</center></td><td><center>"
						.$row["fld_username"]."</center></td></tr>";
			}
		
	} else {
		//echo "0 results";
	}
	$conn->close();

?>