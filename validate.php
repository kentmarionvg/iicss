<?php
session_start();
if($num_rows>2){
	if(isset($_POST["captcha"])&&$_POST["captcha"]!=""&&$_SESSION["code"]==$_POST["captcha"])
	{
	echo "Correct Code Entered";
	//Do you stuff
	}
	else
	{
	 $errors[]="Captcha is incorrect";
	}
}
else{
	
}

?>