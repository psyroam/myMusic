<?php
	abstract class Error_LVL
	{
		const Positive = 0;
		const Negative = 1;
		const Warning = 2;
	}

	class Error
	{
		public static function get_Errors()
		{
			if(!isset($_SESSION['err_msg']))
			{
				return null;
			}
			else
			{
		 		return unserialize($_SESSION['err_msg']);
            }
		}

		public static function get_Error($i)
		{
			$errors = Error::get_Errors();

			$error = $errors[$i];

			if(isset($error))
			{
				return $error;
			}
			else
				return -1;
		}

		public static function _reset()
		{
			unset($_SESSION['err_msg']);
		}

		public static function get_lvl($level)
		{
			switch($level)
			{
				case 0:
					return "positive";
				break;
				case 1:	
					return "negative";
				break;
				case 2:
					return "warning";
				break;
			}
		}
	}

	class Report
	{
		public $title;
		public $text;
		public $level;
		public static $amount = 0;

		public function __construct($title,$text,$level)
		{
			$this->title = $title;
			$this->text = $text;
			$this->level = $level;
		}

		public static function publish($report)
		{
            if(isset($_SESSION['err_msg']))
            {
				$errors = unserialize($_SESSION['err_msg']);
            }
			else
			{
				$errors = array();	
			}
            $length = sizeof($errors);
			$errors[$length + 1] = $report;
			$_SESSION['err_msg'] = serialize($errors);
		}
	}
?>