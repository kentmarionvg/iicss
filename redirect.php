<?php
	
	if(empty($_POST) === false) {
		$username = $_POST['username'];
		$password = $_POST['password'];
		//$captcha = $_POST['captcha'];
		
		
		if(user_exists($username) === false){
			$errors[] = 'Account doesn\'t exist.';
		
		} else if(user_active($username) === false){
			$errors[] = 'Account is disabled.';

		}else {
			$login = login($username, $password);
			if($login === false){
				$errors[] = 'Username or password is incorrect!';
				
			}else {
				
				$role = user_role($username);
				
				//set the user session
				$_SESSION['Id'] = $login;
				$_SESSION['key_user'] = user_id_from_username($username);
				//$connect = mysql_connect("locahost","root","secret");
				//mysql_select_db("iicssched");
				
				$connect = mysql_connect("locahost","root","");
				mysql_select_db("iicssched");
			
				/*
				mysql_query("DELETE FROM loginattempt WHERE loginattempt>0");
				mysql_query("ALTER TABLE loginattempt AUTO_INCREMENT = 1");
				*/
				//redirect user to home
				
				switch($role){
					case 1: header('Location: sup/welcome.php'); //for super admin
							break;
					case 2:	header('Location: sys/welcome.php'); //for system admin 
							break;
					case 3:	header('Location: sched/welcome.php'); //for scheduler
							break;
					case 4: header('Location: prof/welcome.php'); // for professor
							break;
				}
				exit();
				
			}
		}
	 
	}else if(!isset($_SESSION['Id'])){
			$errors[] = 'You\'re not logged in. Log in to continue.';
			
	}else{	
		session_destroy();
		header('Location: index.php');
			$errors[] = 'No data received';
	}
	/*
	//////////////
	}
	
	else{

		session_start();
		$errors[] = 'Captcha error';
	}*/
?>

