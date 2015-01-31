<?php
	class Site_Ctrl
	{
		public static function getHrefById($id)
		{
			//return DB->getHrefById($id);
			return getHrefById($id);
		}

		public static function getNameById($id)
		{
			
		}

		public static function getSiteByLevel($lvl)
		{
			//return DB->getSiteByLevel($lvl);
			return getSiteByLevel($lvl);
		}

		public static function getOptionsById($parent)
		{
			return getOptionsById($parent);
			//return ->getOptionsById($parent);
		}
	}
?>