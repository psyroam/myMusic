<?php
	class Entry
	{
		//Song Entry
		public static function add($song)
		{
			?>
			<link rel="stylesheet" type="text/css" href="style/myMusic.css">
			<div class=music_div>
				<div class=music_title>
					<table>
						<tr>
							<td>
								<?=$song->title?>
							</td>
							<td>
								<?php
									if(!isset($_GET['album']) && !isset($_GET['interpreter']))
									{
										print($song->interpreter);
									}									
								?>
							</td>
						</tr>
					</table>

				</div>

			</div>
		<?php
		}

		public static function multiple_add($songs)
		{
			foreach($songs as $song)
			{
				Entry::add($song);
			}
		}
	}
?>