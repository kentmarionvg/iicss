
		<?php 
		error_reporting(false);
		include '../welcome/header.php';
		$compurl = $_SERVER['REQUEST_URI'];
		$edit = $url."&ntfy=edt";
		$delete = $url."&ntfy=dlt";
		?>
		
		<div id="professor">
		    <h1>PROFESSOR
			    <?php if($_GET['ntfy']=='prof'){?>
					<a href="professor.php"><button class="btn btn-default">BACK</button></a>
				<?php }?>
			</h1> 
			<h6>Creates a <b>Professor</b> account by providing personal information and list of their competencies. </h6>
			<br>
		</div>
		<?php if(!isset($_GET['ntfy'])){?>
		<div id="professor" style="background-color:#F3F2F5; padding-top:5px;">
			<div>
				<div class="col-md-2">
					
						<div class="form-inline">
						<a href="?ntfy=prof"><button class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span></button></a>
						<a href=<?php echo $compurl."&ntfy=edt";?>><button class="btn btn-primary"><span class="glyphicon glyphicon-pencil"></span></button></a>
						<a ><button class="btn btn-primary" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-trash"></span></button></a>
						</div>
						
						<!-- Modal -->
						<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
						  <div class="modal-dialog modal-sm" role="document">
						    <div class="modal-content">
						      <div class="modal-header">
						        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						        <h4 class="modal-title" id="myModalLabel">Confirm deletion</h4>
						      </div>
						      <div class="modal-body">
						      	Are you sure you want to delete this entry:
						        
						        <?php
						        	
						        	

									$get=$_GET['get'];

									$sql = "SELECT * FROM professor INNER JOIN status ON professor.Status=status.Id INNER JOIN department ON professor.Department = department.Id WHERE professor.IsEnabled=1 && professor.Id = $get";

									$result = mysql_query($sql);
									$epic = mysql_fetch_assoc($result);
									
									echo "<br><br><b>Name: </b>".$epic['Lastname'].", ".$epic['Firstname']."<br><b>Email: </b>".$epic['Username']."<br><b>Department: </b>".$epic['Name']."<br><b>Status: </b>".$epic['Status'];
						        	
						        	//$conn->close();
						        	
						       	?>
						      </div>
						      <div class="modal-footer">
						        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
						        <button type="button" class="btn btn-primary">Yes</button>
						      </div>
						    </div>
						  </div>
						</div>
						
					
				</div>
				<div class="col-md-10">
					<form action="professor.php" method="POST" style="float: right;">
						<div class="form-inline">
							<span class="glyphicon glyphicon-search"></span>
							<input class="form-control" type="text" placeholder="Lastname" name="sLastname">
							<input class="form-control" type="text" placeholder="Firstname" name="sFirstname">
							<input class="form-control" type="text" placeholder="Email" name="sEmail">
							<select class="form-control" name="sDept">
								<option value="0">Department</option>
								<option value="1">Information Technology</option>
								<option value="2">Computer Science</option>
								<option value="3">Information Systems</option>
							</select>
							<select class="form-control" name="sStatus">
								<option value="0">Status</option>
								<option value="1">Full-Time</option>
								<option value="2">Part-Time</option>
							</select>
							<input class="btn btn-primary" type="submit" name="search" value="GO">

						</div>
					<form>
				</div><br>
			</div><br>
			<div class="table-responsive col-md-12" id="table-scroller">
	            <table class="table table-striped table-hover" id="rowClick">
	              <thead>
	                <tr bgcolor="#F3F2F5" data-href="1">
	                  <th class="col-md-1"><center>#</center></th>
	                  <th class="col-md-2"><center><a href="?srt=lst">LASTNAME</a></center></th>
	                  <th class="col-md-2"><center><a href="?srt=fst">FIRSTNAME</a></center></th>
	                  <th class="col-md-2"><center><a href="?srt=eml">EMAIL</a></center></th>
	                  <th class="col-md-1"><center>LOAD</center></th>
	                  <th class="col-md-2"><center>DEPARTMENT</center></th>
	                  <th class="col-md-1"><center>STATUS</center></th>
	                </tr>
	              </thead>
	              <tbody>
	              <?php 
	              		include 'modules/getdb.php';
	              	?>
	              </tbody>
	            </table>
	         </div>
		</div>
		<?php 
		}?>
		<?php if($_GET['ntfy']=='prof'){
			$submit = $_POST['submit'];
			$firstname = strip_tags($_POST['pfirstname']);
			$lastname = strip_tags($_POST['plastname']);
			$email= strip_tags($_POST['email']);
			$password = strip_tags($_POST['pass']);
			$repassword = strip_tags($_POST['confpass']);
			$status = $_POST['ddstatus'];
			$dept = $_POST['dddepartment'];
			
			
			
			function valid_pass($candidate) {
				$r1='/[A-Z]/';  //Uppercase
				$r2='/[a-z]/';  //lowercase
				$r3='/[!@#$%^&*()\-_=+{};:,<.>]/';  // whatever you mean by 'special char'
				$r4='/[0-9]/';  //numbers
			
				if(preg_match_all($r1,$candidate, $o)<1) {
					
					return FALSE;
				}
			
				if(preg_match_all($r2,$candidate, $o)<1) {
					
					return FALSE;
				}
			
				if(preg_match_all($r3,$candidate, $o)<1) {
					
					return FALSE;
				}
			
				if(preg_match_all($r4,$candidate, $o)<1) {
					
					return FALSE;
				}
			
				if(strlen($candidate)<8||strlen($candidate)>16) {
					
					return FALSE;
				}
			
				return TRUE;
			}
			
			function checkEmail($emailchecker){
				$query="SELECT * FROM user WHERE Username='$emailchecker'";
				$result = mysql_query($query);
				
				$rows= mysql_num_rows($result);
				
				if($rows!=0){
					return FALSE;
					
				}else{
					return TRUE;
				}
			}

			$check=0;	

			//check 1 = email
			//check 2 = passwords
			
				
			if($submit){
				if($email&&$password&&$repassword&&$firstname&&$lastname&&$status!=0&&$dept!=0){
					if(checkEmail($email)){
						if($password==$repassword){
							$r1='/[A-Z]/';  //Uppercase
							$r2='/[a-z]/';  //lowercase
							$r3='/[!@#$%^&*()\-_=+{};:,<.>]/';  // whatever you mean by 'special char'
							$r4='/[0-9]/';  //numbers
							
							if(valid_pass($password)==FALSE){
								$check = 2;
								$notice[]='Password entered is invalid! Please enter a new password.';
								
							}else{
								$password = md5($password);
								
								$connect = mysql_connect("locahost","root","");
								mysql_select_db("iicssched");
								
								mysql_query("INSERT INTO user VALUES('','$email','$password',4,1);");
								mysql_query("INSERT INTO professor VALUES('','$email','$firstname','$lastname',$dept, $status, NULL, 1);");
								
								header('Location: professor.php');
							}
								
						}else{
							$check = 2;
							$notice[] = 'Passwords do not match! Please retype your password.';
						}
					}else{
						$check = 1;
						$notice[]='Email is existing! Please try again';
					}
				}
			}
		
				
		?>
		<div id="professor">	
		
		<?php if(empty($_POST) === false) {?>
										<center>
										    <div>
										        <h4>
										        	<span  class="label label-danger">
														<?php
										                	output_errors($notice);
										                ?>
										            </span>
										        </h4>
										    </div>
										</center>
 		<?php }?>
			
			<h4><i>Personal Details</i></h4><br>
			<form  action="professor.php?ntfy=prof" method="POST">
				<div <?php if($check==1){?>class="form-group has-error has-feedback"<?php }else{?>class="form-group"<?php }?> id="innerModule">
					<label for="createEmail">Email</label>
					<input type="email" class="form-control" id="createEmail" value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>" placeholder="Email" name="email" required>
					
				
				</div>
				<div <?php if($check==2){?>class="form-group has-error has-feedback"<?php }else{?>class="form-group"<?php }?>>
					<label for="createPass">Password</label> 
					<button it="tooltip" type="button" class="btn btn-default" data-toggle="tooltip" data-placement="right" title="Passwords must contain at least 8-16 characters, including uppercase, lowercase letters and a number.">
						?
					</button>
					<br><br><input type="password" class="form-control has-error" id="createPass" value="<?php echo isset($_POST['pass']) ? $_POST['pass'] : ''; ?>" placeholder="Password" name="pass" required>
					<input type="password" class="form-control" id="confPass" value="<?php echo isset($_POST['confpass']) ? $_POST['confpass'] : ''; ?>" placeholder="Confirm Password" name="confpass" required>
					
				</div>
				<br><br>
				
				<div id="form-inline">
					<label for="createName">Name</label>
					<div class="form-inline">
						<div class="form-group">
							<input type="text" class="form-control" id="createFirst" value="<?php echo isset($_POST['pfirstname']) ? $_POST['pfirstname'] : ''; ?>" placeholder="Firstname" name="pfirstname" required>
							<input type="text" class="form-control" id="createLast" value="<?php echo isset($_POST['plastname']) ? $_POST['plastname'] : ''; ?>" placeholder="Lastname" name="plastname" required>
						</div>
					</div>
					<br>
					
						<label for="dropdownDept" id="ddDept">Department</label>
							<div class="form-group">
								
								<select class="form-control" id="dropdownDept" name="dddepartment" required>
									<option value="0" >Select a Department</option>
									<option value="1" <?php if($dept == '1') { ?> selected <?php } ?>>Information Technology</option>
									<option value="2" <?php if($dept == '2') { ?> selected <?php } ?>>Computer Science</option>
									<option value="3" <?php if($dept == '3') { ?> selected <?php } ?>>Information Systems</option>
								</select>

							</div>

							<label for="dropdownStatus"id="ddStatus">Status</label>
							<div class="form-group">
								<select class="form-control" id="dropdownStatus" name="ddstatus" required>
									<option value="0">Select a Status</option>
									<option value="1" <?php if($status == '1') { ?> selected <?php } ?>>Full-Time</option>
									<option value="2" <?php if($status == '2') { ?> selected <?php } ?>>Part-Time</option>
								</select>
							</div>
						
					</div>
					<br>
					<h4><i>Competencies</i></h4><br>
					<br>
					<div id="wrapperButt">
						<input class="btn btn btn-lg btn-success btn-block" type="submit" name="submit" value="SUBMIT"></input>
						
					</div>
					
					<br><br><br>
			</form>
		</div>
		<?php }?>

		<script type="text/javascript">
			$(function () {
				  $('[data-toggle="tooltip"]').tooltip()
				})
			$('#tootltip').tooltip(options)

			$('#myModal').on('shown.bs.modal', function () {
			  $('#myInput').focus()
			})

			$('#myModal').modal(options)

			
		</script>


<?php
    include '../welcome/footer.php';
?>
