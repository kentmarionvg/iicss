<?php
 session_start();
 session_destroy();
 mysql_query("
	DELETE FROM loginattempt WHERE loginattempt>0;
");
 header('Location: index.php');
?>