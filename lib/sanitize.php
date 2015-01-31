<?php
	class Sanitize
	{
		public static function htmlspecialchars($raw)
		{
			return htmlspecialchars($raw);
		}

		public static function htmlentities($raw)
		{
			return htmlentities($raw);
		}

		public static function urlencode($raw)
		{
			return urlencode($raw);
		}

		public static function urldecode($safe)
		{
			return urldecode($safe);
		}

		public static function json_encode($raw)
		{
			return json_encode($raw);
		}

		public static function json_decode($safe)
		{
			return json_decode($safe);
		}

		public static function escape($raw)
		{
			return mysql_escape_string($raw);
		}

		public static function addslashes($raw)
		{
			return addslashes($raw);
		}
	}
?>