<?php

/*
 * Class	: Ejsplug
 * 
 * Feature	: All Database Functionality
 *  
 * @author Eko Junaidi Salam
 *
 */

class Ejsplug {
    
	function onSave2Dbase($command=null,$filename=null,$arr=null,$newFileName=null) {
		global $config;
        $ejsplug_config = $config['Plugin_ejsplug'];
        $opt_cfg = $config['Plugin_ejsplug']['opt'];
		
		$pPath = $arr->getServerPath().$filename;
		$uPath = $arr->getUrl().$filename;
		$tgl = date('Y-m-d H:i:s');
		
		if(!isset($_SESSION['IDRole']) || is_null($arr)){
			return true;
		}
		
		// Making a connection...
		$mysqli = mysqli_connect($ejsplug_config['dbhost'], $ejsplug_config['dbuser'], $ejsplug_config['dbpass'],$ejsplug_config['dbase']);
		if ($mysqli->connect_error) {
			die("Connection failed: " . $mysqli->connect_error);
		}
		
		$sql = "select username from users where IDRole=?";
		$stmt = $mysqli->prepare($sql);
		$stmt->bind_param('i', intval($_SESSION['IDRole']));
		$stmt->execute();
		$stmt->store_result();
		$stmt->bind_result($usr);
		$stmt->fetch();
		
		/* $fp = fopen("test_connect.txt","w");
	
		$txt = var_export($usr,true);
		$txt .= "\r\r\t";
		$txt .= var_export($ejsplug_config,true);
		$txt .= "\r\r\t";
		$txt .= var_export($stmt,true);
		fwrite($fp,$txt);
		fclose($fp); */
		
		switch($command){
			case 'FileUpload':
			if($arr->getResourceTypeName() == "Images"){
				if($arr->getClientPath() == "/slideshow/"){
					$sql = "INSERT INTO ".$opt_cfg["main_table"]." (foto, keterangan, url_path, physical_path, create_time, create_by) VALUES (?, ?, ?, ?, ?, ?)";					
					$stmt = $mysqli->prepare($sql);
					$stmt->bind_param('ssssss', $filename,$filename,$uPath,$pPath,$tgl,$usr);
				}else{
					$sql = "INSERT INTO ".$opt_cfg["other_table"]." (nama, keterangan, url_path, physical_path, create_time, create_by) VALUES (?, ?, ?, ?, ?, ?)";					
					$stmt = $mysqli->prepare($sql);
					$stmt->bind_param('ssssss', $filename,$filename,$uPath,$pPath,$tgl,$usr);
				}
			}else{
				$sql = "INSERT INTO ".$opt_cfg["other_table"]." (nama, keterangan, url_path, physical_path, create_time, create_by) VALUES (?, ?, ?, ?, ?, ?)";				
				$stmt = $mysqli->prepare($sql);
				$stmt->bind_param('ssssss', $filename,$filename,$uPath,$pPath,$tgl,$usr);
			}
			break;

			case 'QuickUpload':
			break;
			case 'DownloadFile':
			case 'Thumbnail':
			break;
			case 'CopyFiles':
			case 'CreateFolder':
			case 'DeleteFiles':
			if($arr->getResourceTypeName() == "Images"){
				if($arr->getClientPath() == "/slideshow/"){
					$sql = "DELETE FROM ".$opt_cfg["main_table"]." WHERE physical_path =?";					
					$stmt = $mysqli->prepare($sql);
					$stmt->bind_param('s', $pPath);
				}else{
					$sql = "DELETE FROM ".$opt_cfg["other_table"]." WHERE physical_path =?";					
					$stmt = $mysqli->prepare($sql);
					$stmt->bind_param('s', $pPath);
				}
			}else{
				$sql = "DELETE FROM ".$opt_cfg["other_table"]." WHERE physical_path =?";				
				$stmt = $mysqli->prepare($sql);
				$stmt->bind_param('s', $pPath);
			}
			break;
			
			case 'DeleteFolder':
			case 'GetFiles':
			case 'GetFolders':
			case 'Init':
			case 'LoadCookies':
			case 'MoveFiles':
			case 'RenameFile':				
			if($arr->getResourceTypeName() == "Images"){
				$npPath = $arr->getServerPath().$newFileName;
				$nuPath = $arr->getUrl().$newFileName;
				
				if($arr->getClientPath() == "/slideshow/"){
					$sql = "UPDATE ".$opt_cfg["main_table"]." SET foto=?,keterangan=?,url_path=?,physical_path=?,create_by=? WHERE physical_path =?";
					$stmt = $mysqli->prepare($sql);
					$stmt->bind_param('ssssss', $newFileName,$newFileName,$nuPath,$npPath,$usr,$pPath);
				}else{
					$sql = "UPDATE ".$opt_cfg["other_table"]." SET nama=?,keterangan=?,url_path=?,physical_path=?,create_by=? WHERE physical_path =?";
					$stmt = $mysqli->prepare($sql);
					$stmt->bind_param('ssssss', $newFileName,$newFileName,$nuPath,$npPath,$usr,$pPath);
				}
			}else{
				$sql = "UPDATE ".$opt_cfg["other_table"]." SET nama=?,keterangan=?,url_path=?,physical_path=?,create_by=? WHERE physical_path =?";
				$stmt = $mysqli->prepare($sql);
				$stmt->bind_param('ssssss', $newFileName,$newFileName,$nuPath,$npPath,$usr,$pPath);
			}
			break;			
			case 'RenameFolder':
			break;
			default:
			break;
		}
		
		$stmt->execute();
		$stmt->close();
		// Close Connection...
		$mysqli->close();
		return true;
    }
}

$ejs = new Ejsplug();
$config['Hooks']['Save2Dbase'][] = array($ejs, 'onSave2Dbase');
if (empty($config['Plugin_ejsplug'])) {
    $config['Plugin_ejsplug'] = array(
        "dbhost" => "your_host",
        "dbuser" => "your_user",
        "dbpass" => "your_pass",
        "dbase" => "your_database",
		"opt" => array(
			"main_table" => "slideshow",
			"other_table" => "userfiles"
		)
    );
}