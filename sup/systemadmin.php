
		<?php 
		error_reporting(false);
		include '../welcome/header.php';
		?>
		<div id="sysadmin">
			<h1>SYSTEM ADMIN
			<?php if($_GET['ntfy']=='sys'){?>
				<a href="systemadmin.php"><button class="btn btn-default">BACK</button></a>
			<?php }?></h1> 
			<h6>Creates a <b>System Administrator</b> account that can be used for managing the system. </h6>
		</div>	<br>
		<?php if(!isset($_GET['ntfy'])){?>
		<div id="scheduler">
			<div>
				<a href="?ntfy=sys"><button class="btn btn-primary">+</button></a><br>
			</div><br>
			<div class="table-responsive " id="table-scroller">
	            <table class="table table-bordered">
	              <thead>
	                <tr>
	                  <th class="col-md-1"><center>#</center></th>
	                  <th class="col-md-8"><center>EMAIL</center></th>
	                 
	                 
	                </tr>
	              </thead>
	              <tbody>
	              	<?php include 'modules/getdbemail.php';?>
	              </tbody>
	            </table>
	         </div>
		</div>
		<?php }?>
		<?php if($_GET['ntfy']=='sys'){
			$submit = $_POST['submit'];
			$email= strip_tags($_POST['email']);
			$password = strip_tags($_POST['pass']);
			$repassword = strip_tags($_POST['confpass']);
			
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
				if($email&&$password&&$repassword){
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
								
								mysql_query("INSERT INTO tbl_user VALUES('','$email','$password',1,2);");
								
								
								header('Location: systemadmin.php');
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
		<div id="sysadmin">
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
			<form  action="systemadmin.php?ntfy=sys" method="POST">
				<div class="form-group" id="innerModule">
					<label for="createEmail">Email</label>
					<input type="email" class="form-control" id="createEmail" placeholder="Email" name="email">
				</div>
				<div class="form-group">
					<label for="createPass">Password</label> 
					<button it="tooltip" type="button" class="btn btn-default" data-toggle="tooltip" data-placement="right" title="Passwords must contain at least six characters, including uppercase, lowercase letters and numbers.">
						?
					</button>
					
					
					<br><br><input type="password" class="form-control" id="createPass" placeholder="$Password" name="pass">
							<input type="password" class="form-control" id="confPass" placeholder="Confirm Password" name="confpass">
				</div>
				<br><br>
				
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
