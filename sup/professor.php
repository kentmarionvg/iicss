
		<?php 
		error_reporting(false);
		include '../welcome/header.php';
		?>
		<div id="professor">
		    <h1>PROFESSOR
		    <?php if($_GET['ntfy']=='prof'){?>
				<a href="professor.php"><button class="btn btn-default">BACK</button></a>
			<?php }?></h1> 
			<h6>Creates a <b>Professor</b> account by providing personal information and list of their competencies. </h6>
			<br>
		</div>
		<?php if(!isset($_GET['ntfy'])){?>
		<div id="professor">
			<div>
				<a href="?ntfy=prof"><button class="btn btn-primary">+</button></a>
			</div><br>
			<div class="table-responsive " id="table-scroller">
	            <table class="table table-bordered">
	              <thead>
	                <tr>
	                  <th class="col-md-1"><center>#</center></th>
	                  <th class="col-md-2"><center><a href="?srt=lst">LASTNAME</a></center></th>
	                  <th class="col-md-2"><center><a href="?srt=fst">FIRSTNAME</a></center></th>
	                  <th class="col-md-2"><center><a href="?srt=eml">EMAIL</a></center></th>
	                  <th class="col-md-1"><center>LOAD</center></th>
	                  <th class="col-md-1"><center><a href="?srt=sts">STATUS</a></center></th>
	                 
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
				$query="SELECT * FROM tbl_user WHERE fld_username='$emailchecker'";
				$result = mysql_query($query);
				
				$rows= mysql_num_rows($result);
				
				if($rows!=0){
					return FALSE;
					
				}else{
					return TRUE;
				}
			}
				
				
			if($submit){
				if($email&&$password&&$repassword&&$firstname&&$lastname&&$status!=0&&$dept!=0){
					if(checkEmail($email)){
						if($password==$repassword){
							$r1='/[A-Z]/';  //Uppercase
							$r2='/[a-z]/';  //lowercase
							$r3='/[!@#$%^&*()\-_=+{};:,<.>]/';  // whatever you mean by 'special char'
							$r4='/[0-9]/';  //numbers
							
							if(valid_pass($password)==FALSE){
								$notice[]='Password entered is invalid! Please enter a new password.';
							}else{
								$password = md5($password);
								
								$connect = mysql_connect("locahost","root","secret");
								mysql_select_db("iicssched");
								
								mysql_query("INSERT INTO tbl_user VALUES('','$email','$password',1,4);");
								mysql_query("INSERT INTO tbl_info VALUES('$email','$firstname','$lastname',$dept, $status);");
								
								header('Location: professor.php');
							}
								
						}else{
							$notice[] = 'Passwords do not match! Please retype your password.';
						}
					}else{
						$notice[]='Email is existing! Please try again';
					}
				}else{
					$notice[]= 'Please fill all required details';
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
				<div class="form-group" id="innerModule">
					<label for="createEmail">Email</label>
					<input type="email" class="form-control" id="createEmail" placeholder="Email" name="email">
				</div>
				<div class="form-group">
					<label for="createPass">Password</label> 
					<button it="tooltip" type="button" class="btn btn-default" data-toggle="tooltip" data-placement="right" title="Passwords must contain at least 8-16 characters, including uppercase, lowercase letters and a number.">
						?
					</button>
					<br><br><input type="password" class="form-control" id="createPass" placeholder="Password" name="pass">
							<input type="password" class="form-control" id="confPass" placeholder="Confirm Password" name="confpass">
				</div>
				<br><br>
				
				<div id="form-inline">
					<label for="createName">Name</label>
					<div class="form-inline">
						<div class="form-group">
							<input type="text" class="form-control" id="createFirst" placeholder="Firstname" name="pfirstname">
							<input type="text" class="form-control" id="createLast" placeholder="Lastname" name="plastname">
						</div>
					</div>
					<br>
					
						<label for="dropdownDept" id="ddDept">Department</label>
							<div class="form-group">
								
								<select class="form-control" id="dropdownDept" name="dddepartment">
									<option value="0">Select a Department</option>
									<option value="1">Information Technology</option>
									<option value="2">Computer Science</option>
									<option value="3">Information Systems</option>
								</select>
							</div>
							<label for="dropdownStatus"id="ddStatus">Status</label>
							<div class="form-group">
								<select class="form-control" id="dropdownStatus" name="ddstatus">
									<option value="0">Select a Status</option>
									<option value="1">Full-Time</option>
									<option value="2">Part-Time</option>
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
		</script>
<?php
    include '../welcome/footer.php';
?>
