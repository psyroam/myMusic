<?php
	/*define("HOST","localhost");
	define("USERNAME","root");
	define("PASSWORD","");
	define("DB","mymusic");


*/
		
		try{
			$GLOBALS['db'] = new PDO('mysql:host=localhost;dbname=mymusic;charset=utf8', "root", "");
		}
		catch(PDOException $e){
	        print($e->getMessage());
	    }
        
		function getOptionsById($parent)
		{
			if($parent === null)
				return;

			$stmt = $GLOBALS['db']->prepare("SELECT * FROM `option` WHERE `parent` = :parent;");
			$stmt->bindValue(':parent',$parent, PDO::PARAM_INT);
			$stmt->execute();

			$rs = array();
			$i =0;
			foreach($stmt->fetchAll(PDO::FETCH_OBJ) as $row)
			{
				$rs[$i] = $row;
				$i++;
			}

			return $rs;
		}

		function getSiteByLevel($level)
		{
			$stmt = $GLOBALS['db']->prepare("SELECT `id`,`name` FROM `site` WHERE `isHidden` = '0' ORDER BY sequence;");
			$stmt->execute();
			$rs = array();
			$i =0;
			foreach($stmt->fetchAll(PDO::FETCH_OBJ) as $row)
			{
				$rs[$i] = $row;
				$i++;
			}

			return $rs;
		}

		
		function getAlbenByRange($offset,$limit=12)
		{
			$stmt = $GLOBALS['db']->prepare("SELECT DISTINCT * FROM `album` LIMIT :_limit,OFFSET :offset;");
			$stmt->bindValue(':_limit',$limit,PDO::PARAM_INT);
			$stmt->bindValue(':offset',$offset,PDO::PARAM_INT);
			$stmt->execute();
			var_dump($stmt);
			$rs = array();
			$i =0;
			foreach($stmt->fetchAll(PDO::FETCH_OBJ) as $row)
			{
				print_r($row);
				$rs[$i] = $row;
				$i++;
			}

			return $rs;		
		}

		function getHrefById($id)
		{
			$stmt = $GLOBALS['db']->prepare("SELECT `href` FROM `site` WHERE `id` = :id;");
			$stmt->bindValue(':id',$id,PDO::PARAM_INT);
			$stmt->execute();

			return $stmt->fetchColumn();	
		}

		function getRunningState($id)//isUp
		{
			$stmt = $GLOBALS['db']->prepare("SELECT `isUp` FROM `site` WHERE `id` = :id;");
			$stmt->bindValue(':id',$id,PDO::PARAM_INT);
			$stmt->execute();

			return $stmt->fetchColumn();	
		}
		

	
?>