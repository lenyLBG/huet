<?php
	include 'class.php';
	if (isset($_GET['page'])) $page = $_GET['page'];
	else $page = 1;
	$var = new moi();
	$var -> afficherPage($page);



?>