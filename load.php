<?php
	require_once 'conf.php';
	require_once './lib/init.php';
	
	$_SESSION['db'] = new Database();
	$loc = "D:\_TRANSFER\Seeed - Seeed (Deluxe Version)";
	$files = array();

	$i =0 ;
	foreach (new RecursiveIteratorIterator(new RecursiveDirectoryIterator($loc)) as $filename)
	{
       	$files[$i]= $filename;
       	$i++;
	}

	foreach($files as $file)
	{
		Init::ini("Seeed","Seeed",$file);
	}
?>