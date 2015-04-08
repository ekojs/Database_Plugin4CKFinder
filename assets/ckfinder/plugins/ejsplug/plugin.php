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
	
    function onSave2Dbase($jns=null,$fname=null,$arr=null,$newFileName=null) {
		global $config;
        $ejsplug_config = $config['Plugin_ejsplug'];
        $opt_cfg = $config['Plugin_ejsplug']['opt'];
		
		$Urlpath = $arr->getUrl();
		$Physicalpath = $arr->getServerPath();
		/* $fp = fopen("ekotes_plugin.txt","w");
		
		$txt = $arr->getClientPath()." \r";
		$txt .= $arr->getResourceTypeName()." \r\t";
		$txt .= var_export($arr,true);
		
		fwrite($fp,$txt);
		fclose($fp); */
		
		$link = mysql_connect($ejsplug_config['dbhost'], $ejsplug_config['dbuser'], $ejsplug_config['dbpass'])or die('Could not connect: ' . mysql_error());
		mysql_select_db($ejsplug_config['dbase']) or die('Could not select database');
		
		if(isset($_SESSION['IDRole']) && !is_null($arr)){
			$gid = intval($_SESSION['IDRole']);
			$usr = $this->S_dbase("select username from users where IDRole='".$gid."'");
			$usr = $usr['username'];
			
			switch($jns){
				case 'FileUpload':
				if($arr->getResourceTypeName() == "Images"){
					if($arr->getClientPath() == "/slideshow/"){
						$this->IUD_dbase("INSERT INTO ".$opt_cfg["main_table"]." (foto, keterangan, url_path, physical_path, create_time, create_by) VALUES ('".$fname."', '".$fname."', '".$Urlpath.$fname."', '".$Physicalpath.$fname."', '".date("Y-m-d H:i:s")."', '".$usr."')");
					}
					else{
						$this->IUD_dbase("INSERT INTO ".$opt_cfg["other_table"]." (nama, keterangan, url_path, physical_path, create_time, create_by) VALUES ('".$fname."', '".$fname."', '".$Urlpath.$fname."', '".$Physicalpath.$fname."', '".date('Y-m-d H:i:s')."', '".$usr."')");
					}
				}
				else{
					$this->IUD_dbase("INSERT INTO ".$opt_cfg["other_table"]." (nama, keterangan, url_path, physical_path, create_time, create_by) VALUES ('".$fname."', '".$fname."', '".$Urlpath.$fname."', '".$Physicalpath.$fname."', '".date('Y-m-d H:i:s')."', '".$usr."')");
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
						$this->IUD_dbase("DELETE FROM ".$opt_cfg["main_table"]." WHERE physical_path ='".$Physicalpath.$fname."'");
					}
					else{
						$this->IUD_dbase("DELETE FROM ".$opt_cfg["other_table"]." WHERE physical_path ='".$Physicalpath.$fname."'");
					}
				}
				else{
					$this->IUD_dbase("DELETE FROM ".$opt_cfg["other_table"]." WHERE physical_path ='".$Physicalpath.$fname."'");
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
					if($arr->getClientPath() == "/slideshow/"){
						$this->IUD_dbase("UPDATE ".$opt_cfg["main_table"]." SET foto='".$newFileName."',keterangan='".$newFileName."',url_path='".$Urlpath.$newFileName."',physical_path='".$Physicalpath.$newFileName."',create_by='".$usr."' WHERE physical_path ='".$Physicalpath.$fname."'");
					}
					else{
						$this->IUD_dbase("UPDATE ".$opt_cfg["other_table"]." SET nama='".$newFileName."',keterangan='".$newFileName."',url_path='".$Urlpath.$newFileName."',physical_path='".$Physicalpath.$newFileName."',create_by='".$usr."' WHERE physical_path ='".$Physicalpath.$fname."'");
					}
				}
				else{
					$this->IUD_dbase("UPDATE ".$opt_cfg["other_table"]." SET nama='".$newFileName."',keterangan='".$newFileName."',url_path='".$Urlpath.$newFileName."',physical_path='".$Physicalpath.$newFileName."',create_by='".$usr."' WHERE physical_path ='".$Physicalpath.$fname."'");
				}
				break;
				
				case 'RenameFolder':
				break;

				default:
				break;
			}
		}
		mysql_close($link);
		return true;
    }
	
	private function S_dbase($sql){
		$result = mysql_query($sql) or die('Query failed: ' . mysql_error());
		return mysql_fetch_array($result, MYSQL_ASSOC);
	}
	
	private function IUD_dbase($sql){
		// $result = mysql_query($sql) or die('Query failed: ' . mysql_error());
		mysql_query($sql) or die('Query failed: ' . mysql_error());
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