<?php
$connect_error='Sorry, we are experiencing connection problems. Please try again later.';
mysql_connect('localhost', 'root', '') or die($connect_error);
mysql_select_db('iicssched') or die($connect_error);
?>