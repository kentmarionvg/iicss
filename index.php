<?php include 'core/init.php';?>
<?php include 'includes/header.php'; ?>
<?php 
error_reporting(false);
include 'redirect.php';
if(empty($_POST) === false) {
?>
	<center>
	    <div id="login_error">
	        <h4>
	        	<span  class="label label-danger">
					<?php
	                output_errors($errors);
	                
	                ?>
	            </span>
	        </h4>
	    </div>
	</center>
<?php }?>
<?php include 'includes/footer.php';?>