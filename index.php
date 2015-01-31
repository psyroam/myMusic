<?php
	$URL = "";

	require_once 'conf.php';

	$site;
	if(isset($_GET['site']))
	{
		$site = $_GET['site'];
		$URL = Site_Ctrl::getHrefById($_GET['site']);
	}
	else{
		$site = 1;
		$URL = Site_Ctrl::getHrefById(1);
	}
	if(isset($_GET['album']) || isset($_GET['interpreter']))
	{
		$URL = Site_Ctrl::getHrefById(3);
	}
?>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="style/stylesheet.css">
		<script src="./js/jquery-1.11.2.min.js"></script>
		<script src="./js/appear_ctrl.js"></script>
		<title><3 Music :P</title>
	</head>
	<body>
		<div id="page">
			<header id="header" onmouseover="expand('#menue')">
				<div id="running_conf">
					<div id="info">
						<div id="margin">
							<div class="margin" id="play_pause_btn">
								Play
							</div>
							<div class="margin" id="prev">
								Prev
							</div>
							<div class="margin" id="next">
								Next
							</div>
						</div>
					</div>
					<div id="runner">
					Test
					</div>
				</div>
				<div id="logo">
				
				</div>

				<div id="bars">
					<!-- Design -->
				</div>

				<div id="MEDT">
				<h1 style="font-size:32px">I <span style="font-size:32px" id="heart"><3</span></h1><h1 style="font-size:64px">Music</h1>
				</div>

				<!-- Here would be #menue-->
			</header>
			<nav id="wrapper" onmouseenter="fold('#menue')">
					<nav id="left_bar">
								<?php

									if(empty($site))
										$site = 0;

										foreach(Site_Ctrl::getOptionsById($site) as $options)
										{
											?>
											<menuitem>
												<a href='$options->href'><?=$options->name?></a>
											</menuitem>
											<br>
											<?php
										}	
								?>
						<div id="close" onclick="slide_out('#left_bar')">

						</div>

					</nav>
				<div id="content">
					<?php
					 	if($URL != "" && getRunningState($site) == 1)
					 	{
				 			include $URL; 
					 	}
					 	else
				 		{
				 			print("Der Link ist derzeit nicht verfügbar!"); 
						}
					?>
				</div>
			</nav>
		</div>
		<nav id="menue">
	               		<?php
	               			foreach(Site_Ctrl::getSiteByLevel(0) as $site)// 0 = root level
	               			{
	               				print("<menuitem><a href='?site=$site->id'>".$site->name."</a></menuitem>");

	               			}	
	               		?>
                     		<div id="search">
						<form action="index.php" method="get">
							<input type="text" Placeholder="Suche" name="txtSearch"/>
							<input type="image" src="img/magnifier.png"/>
						</form>
					</div>
		</nav>
		<div id="errors">
			<?php
					$errors = (Error::get_Errors());
					Error::_reset();

					if(isset($errors))
					{
					foreach($errors as $error)
					{
				?>
						<div id="error_msg" class="<?=Error::get_lvl($error->level);?>">
							<div id="error_msg_title" class="error_msg">
								<?=$error->title?>
							</div>
							<div id="error_msg_text" class="error_msg">
								<?=$error->text?>
							</div>
						</div>
				<?php
					}
					}
				?>
		</div>
		
	</body>
</html>