<div id="inner_content">
<?php
	if(isset($_GET['album']))
	{
		Entry::multiple_add($_SESSION['db']->getSongsByAlben_Id($_GET['album']));
	}
	else if(isset($_GET['interpreter']))
	{
		Entry::multiple_add($_SESSION['db']->getSongsByInterpreter_Id($_GET['interpreter']));
	}
	else{
		echo "don't know";
	}
?>
</div>	