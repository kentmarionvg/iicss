<?php
	function logged_in(){
		return(isset($_SESSION['Id'])) ? true: false;	
	}
	
	function user_exists($username){
		$username = sanitize($username);

		$query = mysql_query("SELECT COUNT(Id) FROM user WHERE Username = '$username'");	
		return (mysql_result($query, 0) == 1);
	}
	
	function user_active($username){
		$username = sanitize($username);
	
		$query = mysql_query("SELECT COUNT(Id) FROM user WHERE Username = '$username' AND IsEnable = b'1'");	
		return (mysql_result($query, 0) == 1);
	}
	
	function user_id_from_username($username){
		$username = sanitize($username);	
		
		return mysql_result(mysql_query("SELECT COUNT(Id) FROM user WHERE Username = '$username'"), 0);
	}
	
	function login($username, $password) {
		$user_id= user_id_from_username($username);
		
		$username = sanitize($username);
		$password = md5($password);
		
		$query = mysql_query("SELECT COUNT(Id) FROM user WHERE Username = '$username' AND Password = '$password'");	
		
		return(mysql_result($query ,0)==1) ? $user_id: false;
	}
	
	function user_role($username){
		$username = sanitize($username);
	
		$query = mysql_query("SELECT Role FROM user WHERE Username = '$username'");	
		$result = mysql_result($query ,0);
		
		return $result;
		
	}
	
?>