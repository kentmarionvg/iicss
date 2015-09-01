<?php
	error_reporting(E_ERROR);
	
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
	
	$order = 'fld_lastname';
	$queryreg = 'SELECT * FROM tbl_user INNER JOIN tbl_info USING (fld_username) WHERE key_role = 4';
	
	if($_GET['srt']=='lst'){
		$order = 'fld_lastname';
	}
	else if($_GET['srt']=='fst'){
		$order = 'fld_firstname';
	}
	else if($_GET['srt']=='eml'){
		$order = 'fld_username';
	}
	
	$sql = $queryreg." ORDER BY ".$order;
	
	$result = $conn->query($sql);
	$num_rows= mysqli_num_rows($result);
	$counter = 1;
	$placeholderunits = 1;
	
	
	
	echo "<center> <b>$num_rows Entries Returned\n</b></center>";
	
	if ($result->num_rows > 0) {
		// output data of each row
		
		while($row = $result->fetch_assoc()) {
			if($row["dd_status"]==1){
				$status='Full Time';
			}else{
				$status='Part Time';
			}
				
				echo "<tr><td><center>".$counter++."</center></td><td><center>".$row["fld_lastname"]."</center></td><td><center>".$row["fld_firstname"]."</center></td><td><center>"
						.$row["fld_username"]."</center></td><td><center>".$placeholderunits."</center></td><td><center>".$status."</center></td></tr>";
			}
		
	} else {
		//echo "0 results";
	}
	$conn->close();

?>