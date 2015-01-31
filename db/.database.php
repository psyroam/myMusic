<?php
	
	class Database
	{
		private $host = "localhost";
		private $username = "root";
		private $password = "";
		private $db = "mymusic";
		private $connection;

		public function __construct()
		{
			$connection = mysql_connect($this->host,$this->username,$this->password);
			mysql_select_db($this->db);
		}

		//interpreter

		public function getIdByInterpreter($int)
		{
			$sql = "SELECT `id` FROM `interpreter` ;
				WHERE `band_name` = '".Sanitize::escape($int)."'  
			  	OR `alias` = '".Sanitize::escape($int)."'";

			$res = mysql_query($sql)or die(mysql_error());

			return mysql_result($res, 0);
		}

		public function getIdByFirstNameAndLastName()
		{
			die("not implemeted #1");
		}

		public function check_if_already_interpreter_exists($interpreter)
		{
			$sql = "SELECT `id` FROM `interpreter` WHERE `alias` = '".Sanitize::escape($interpreter)."' OR `band_name` = '".Sanitize::escape($interpreter)."' ;";
			$res = mysql_query($sql);
			if(mysql_num_rows($res)>0)
				return true;
			else
				return false;
		}

		public function add_interpreter($interpreter)
		{
			if($this->check_if_already_interpreter_exists($interpreter))
			{

				return -1;
			}

			$sql = "INSERT INTO `interpreter` `band_name`,`type` VALUES('".Sanitize::escape($interpreter)."','Band');";
			mysql_query($sql)or die(mysql_error());

			return true;
		}

		//albums

		public function getIdByAlbum($album,$interpreter)
		{
			$interpreter_id = $this->getIdByInterpreter($interpreter);
			$sql = "SELECT `id` FROM `album` WHERE `name`='".Sanitize::escape($album)."' AND `interpreter`='".Sanitize::escape($interpreter_id)."';";
			$res = mysql_query($sql)or die(mysql_error());

			return mysql_result($res, 0);
		}

		public function check_if_already_album_exists($album,$interpreter)
		{
			$interpreter_id = $this->getIdByInterpreter($interpreter);
			$sql = "SELECT `id` FROM `album` WHERE `name`='".Sanitize::escape($album)."' AND `interpreter` = '".Sanitize::escape($interpreter_id)."';";
			$res = mysql_query($sql)or die(mysql_error());

			if(mysql_num_rows($res)>0)
				return true;
			else
				return false;

		}

		public function add_album($name,$interpreter)
		{
			if($this->check_if_already_album_exists($name,$interpreter))
			{
				return -1;
			}

			$sql = "INSERT INTO `album` (`name`,`interpreter`) VALUES('".Sanitize::escape($name)."','".Sanitize::escape($this->getIdByInterpreter($interpreter))."');";
			$res = mysql_query($sql)or die(mysql_error());

			return true;
		}

		public function add_songs($album,$songs,$interpreter)
		{
			foreach($songs as $song)
			{
				$this->add_song($album,$song,$interpreter);
			}
		}

		public function add_song($album,$song,$interpreter)
		{
			$album_id = $this->getIdByAlbum($album,$interpreter);
			$name = explode('\\', $song);
	
			if($name[count($name)-1] === "." || $name[count($name)-1] === "..")
				return;

			$sql = "INSERT INTO `song` (`album`,`name`,`href`) VALUES('".Sanitize::escape($album_id)."','".Sanitize::escape($name[count($name)-1])."','".Sanitize::escape(str_replace('\\', '/', $song))."');";
			mysql_query($sql)or die(mysql_error());
		}

		public function getHrefById($id)
		{
			$sql = "SELECT `href` FROM `site` WHERE `id`='".Sanitize::escape($id)."';";
			$result = mysql_query($sql)or die(mysql_error());

			return mysql_result($result, 0);
		}

		public function getNameById($id)
		{
			die("not implemeted #3");
		}

		public function getSiteByLevel($lvl)
		{
			$sql = "SELECT `id`,`name`,`parent` FROM `site` WHERE `parent` = '".Sanitize::escape($lvl)."' AND `isHidden` = '0' ORDER BY sequence;";
			$res = mysql_query($sql)or die(mysql_error());

			$result = array();
			$i=0;
			while($row = mysql_fetch_object($res))
			{
				$result[$i] = $row;
				$i++;
			}

			return $result;
		}
		
		public function getOptionsById($parent)
		{
			$sql = "SELECT * FROM `option` WHERE `parent`='".Sanitize::escape($parent)."';";
			$res = mysql_query($sql)or die(mysql_error());

			$result = array();
			$i = 0;
			while($row = mysql_fetch_object($res))
			{
				$result[$i] = $row;
				$i++;
			}

			return $result;
		}

		public function getAlbenByRange($limit,$offset)
		{
			$sql = "SELECT DISTINCT * FROM `album` LIMIT $limit OFFSET $offset;";
			$res = mysql_query($sql)or die(mysql_error());
			$result = array();
			
			$i=0;
			while($row = mysql_fetch_object($res))
			{
				$result[$i] = $row;
				$i++;
			}

			return $result;
		}

		public function getSongsByAlben_Id($id)
		{
			$sql = "SELECT * FROM `song` WHERE `album`='".Sanitize::escape($id)."';";
			
			$res = mysql_query($sql)or die(mysql_error());

			$result = array();
			$i =0;
			while($row = mysql_fetch_object($res))
			{
				$result[$i] = $row;
				$i++;
			}

			return $result;
		}

		public function getSongsByInterpreter_Id($id)
		{
			$sql = "SELECT * FROM `song` JOIN `album` ON song.album = album.id WHERE `interpreter`='".Sanitize::escape($id)."';";
			print($sql);
			$res= mysql_query($sql)or die(mysql_error());
			
			$result = array();
			$i = 0;
			while($row = mysql_fetch_object($res))
			{
				$result[$i] = $row;
				$i++;
			}	

			return $result;
		}

		public function getNameByInterpreterId($id)//Name = First + Lastname, Alias or Bandname
		{
			print("not implemented");
		}

		public function interpreter_init($id)
		{
			$sql = "SELECT * FROM `interpret` WHERE `id` = '".Sanitize::escape($id)."';";
			$result = mysql_query($sql)or die(mysql_error());
			while($row = mysql_fetch_object($result))
			{
				return $row;
			}
		}
	}
?>