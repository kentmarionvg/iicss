
<?php
	//error_reporting(E_ERROR);
	
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "iicssched";
	
	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}

	$queryreg = "SELECT * FROM professor INNER JOIN status ON professor.Status=status.Id INNER JOIN department ON professor.Department = department.Id WHERE professor.IsEnabled=1";

	$order = 'Lastname';
		if(empty($_POST["search"]) === false){
		$search = $_POST['search'];
		$email = $_POST['sEmail'];
		$firstname= $_POST['sFirstname'];
		$lastname = $_POST['sLastname'];
		$dept = $_POST['sDept'];
		$status = $_POST['sStatus'];

		
		if($search){
			
			///1
			if($email&&!$firstname&&!$lastname&&$dept==0&&$status==0){
				$queryreg .= " && Username='$email'";
			}
			else if(!$email&&$firstname&&!$lastname&&$dept==0&&$status==0){
				$queryreg .=" && Firstname='$firstname'";
			}
			else if(!$email&&!$firstname&&$lastname&&$dept==0&&$status==0){
				$queryreg .=" && Lastname='$lastname'";
			}
			else if(!$email&&!$firstname&&!$lastname&&$dept!=0&&$status==0){
				$queryreg .=" && Department=$dept";
			}
			else if(!$email&&!$firstname&&!$lastname&&$dept==0&&$status!=0){
				$queryreg .=" && professor.Status=$status";
			}
			///2 email
			else if($email&&$firstname&&!$lastname&&$dept==0&&$status==0){
				$queryreg .= " && Username='$email' && Firstname='$firstname'";
			}
			else if($email&&!$firstname&&$lastname&&$dept==0&&$status==0){
				$queryreg .= " && Username='$email' && Lastname='$lastname'";
			}
			else if($email&&!$firstname&&!$lastname&&$dept!=0&&$status==0){
				$queryreg .= " && Username='$email' && Department=$dept";
			}
			else if($email&&!$firstname&&!$lastname&&$dept==0&&$status!=0){
				$queryreg .= " && Username='$email' && professor.Status=$status";
			}
			///2 firstname
			else if(!$email&&$firstname&&$lastname&&$dept==0&&$status==0){
				$queryreg .=" && Firstname='$firstname' && Lastname='$lastname'";
			}
			else if(!$email&&$firstname&&!$lastname&&$dept!=0&&$status==0){
				$queryreg .=" && Firstname='$firstname' && Department=$dept";
			}
			else if(!$email&&$firstname&&!$lastname&&$dept==0&&$status!=0){
				$queryreg .=" && Firstname='$firstname' && professor.Status=$status";
			}
			///2 lastname
			else if(!$email&&!$firstname&&$lastname&&$dept!=0&&$status==0){
				$queryreg .=" && Lastname='$lastname' && Department=$dept";
			}
			else if(!$email&&!$firstname&&$lastname&&$dept==0&&$status!=0){
				$queryreg .=" && Lastname='$lastname' && professor.Status=$status";
			}
			///2 dept
			else if(!$email&&!$firstname&&!$lastname&&$dept!=0&&$status!=0){
				$queryreg .=" && Department=$dept && professor.Status=$status";
			}

			///3 email
			else if($email&&$firstname&&$lastname&&$dept==0&&$status==0){
				$queryreg .=" && Username='$email' && Firstname='$firstname' && Lastname='$lastname'"; //email-firstname-lastname
			}
			else if($email&&$firstname&&!$lastname&&$dept!=0&&$status==0){
				$queryreg .=" && Username='$email' && Firstname='$firstname' && Department=$dept";		//email-firstname-dept
			}
			else if($email&&$firstname&&!$lastname&&$dept==0&&$status!=0){
				$queryreg .=" && Username='$email' && Firstname='$firstname' && professor.Status=$status"; //email-firstname-status
			}
			else if($email&&!$firstname&&$lastname&&$dept!=0&&$status==0){
				$queryreg .=" && Username='$email' && Lastname='$lastname' && Department=$dept"; //email-lastname-dept
			}
			else if($email&&!$firstname&&$lastname&&$dept==0&&$status!=0){
				$queryreg .=" && Username='$email' && Lastname='$lastname' && professor.Status=$status"; //email-lastname-status
			}
			else if($email&&!$firstname&&$lastname&&$dept!=0&&$status!=0){
				$queryreg .=" && Username='$email' && Department=$dept && professor.Status=$status"; //email-department-status
			} 
			///3 firstname
			else if(!$email&&$firstname&&$lastname&&$dept!=0&&$status==0){
				$queryreg .=" && Firstname='$firstname' && Lastname='$lastname' && Department=$dept"; //firstname-lastname-department
			}
			else if(!$email&&$firstname&&$lastname&&$dept==0&&$status!=0){
				$queryreg .=" && Firstname='$firstname' && Lastname='$lastname' && professor.Status=$status"; //firstname-lastname-status
			}
			else if(!$email&&$firstname&&!$lastname&&$dept!=0&&$status!=0){
				$queryreg .=" && Firstname='$firstname' && Department=$dept && professor.Status=$status"; //firstname-dept-status
			}
			///3 lastname
			else if(!$email&&$firstname&&$lastname&&$dept!=0&&$status==0){
				$queryreg .=" && Lastname='$lastname' && Department=$dept && professor.Status=$status"; //lastname-dept-status
			}

			///4 email
			else if($email&&$firstname&&$lastname&&$dept!=0&&$status==0){
				$queryreg .=" && Username='$email' && Firstname='$firstname' && Lastname='$lastname' && Department=$dept"; //email-firstname-lastname-department
			}
			else if($email&&$firstname&&$lastname&&$dept==0&&$status!=0){
				$queryreg .=" && Username='$email' && Firstname='$firstname' && Lastname='$lastname' && professor.Status=$status"; //email-firstname-lastname-status
			}
			else if($email&&$firstname&&!$lastname&&$dept!=0&&$status!=0){
				$queryreg .=" && Username='$email' && Firstname='$firstname' && Department=$dept && professor.Status=$status"; //email-firstname-department-status
			}
			else if($email&&!$firstname&&$lastname&&$dept!=0&&$status!=0){
				$queryreg .=" && Username='$email' && Lastname='$lastname' && Department=$dept && professor.Status=$status"; //email-lastname-department-status
			}
			else if(!$email&&$firstname&&$lastname&&$dept!=0&&$status!=0){
				$queryreg .=" && Firstname='$firstname' && Lastname='$lastname' && Department=$dept && professor.Status=$status"; //firstname-lastname-department-status
			}
			///5
			else if($email&&$firstname&&$lastname&&$dept!=0&&$status!=0){
				$queryreg .=" && Username='$email' && Firstname='$firstname' && Lastname='$lastname' && Department=$dept && professor.Status=$status"; //firstname-lastname-department-status
			}
		}
	}


	if($_GET['srt']=='lst'){
		$order = 'Lastname';
	}
	else if($_GET['srt']=='fst'){
		$order = 'Firstname';
	}
	else if($_GET['srt']=='eml'){
		$order = 'Username';
	}
	
	$sql = $queryreg." ORDER BY ".$order;
	
	$result = $conn->query($sql);
	$num_rows= mysqli_num_rows($result);
	$counter = 1;
	$placeholderunits = 1;
	
	//for debugging
	//echo $sql;
	
	echo "<center> <b>$num_rows Entries Returned\n</b></center>";
	
	if ($result->num_rows > 0) {
		// output data of each row
		
		while($row = $result->fetch_assoc()) {

				echo "<tr class=\"clickable-row\" data-url=\"".$row["Id"]."\"><td><center>".$counter++."</center></td><td><center>".$row["Lastname"]."</center></td><td><center>".$row["Firstname"]."</center></td><td><center>"
						.$row["Username"]."</center></td><td><center>".$placeholderunits."</center></td><td><center>".$row["Name"]."</center></td><td><center>".$row["Status"]."</center></td></tr>";

		}
		
	} else {
		echo "<tr><td colspan=8><center><b>No results found!</b> Click <a href=\"?ntfy=prof\">here</a> to add.</center></td></tr>";
	}
	$conn->close();

?>

		
		<script  type="text/javascript">
			jQuery(document).ready(function($) {
			    $(".clickable-row").click(function() {

			    	var name = $(this).data("url");
			        window.location = '?get='+ name;
			        $(this).toggleClass("active");
			    });


			});
		</script>

		
