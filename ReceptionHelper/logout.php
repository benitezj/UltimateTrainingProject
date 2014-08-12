<?php
header('refresh:2; url=index.html');  

include 'globals.php';
$db->logout_user($_SESSION['username']);
$_SESSION['username'] = '';
echo "Logged out.";

?>
