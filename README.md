# Database Plugin for CKFinder V1
This is a plugin I created to store file information to the database each upload a file in a CKFinder. Hope this usefel to the others CKFinder User.

I develop this using PHP and CodeIgniter Framework, so if you not using it, try to adjust like you need. I've created it as same as my CI's Structure. I create this from scratch, so it's imperfect not yet. May be we can develop it to be more secure, more dynamic, etc. Hope it.

#Feature Covered
This plugin cover the features to pass an information to the database, such as :

1. 'FileUpload'		: OK
2. 'QuickUpload'	: NOT YET
3. 'DownloadFile'	: NOT YET
4. 'Thumbnail'		: NOT YET
5. 'CopyFiles'		: NOT YET
6. 'CreateFolder'	: NOT YET
7. 'DeleteFiles'	: OK
8. 'DeleteFolder'	: NOT YET
9. 'GetFiles'		: NOT YET
10. 'GetFolders'	: NOT YET
11. 'Init'		: NOT YET
12. 'LoadCookies'	: NOT YET
13. 'MoveFiles'		: NOT YET
14. 'RenameFile'	: OK
15. 'RenameFolder'	: NOT YET

# How to using it ?
1. Download the CKFinder in [this](http://cksource.com/ckfinder/download) download page.
2. Set the configuration as usual, place a library in folder libraries.
3. Place your CKFinder in Assets folder
4. Create folder for your plugin in CKFinder plugin folder in this, i create "ejsplug" for folder name.
5. Create a file called plugin.php
6. Add a configuration in the bottom config.php in CKFinder folder
```php
    include_once "plugins/ejsplug/plugin.php";
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
```
7. Last, you can test it.
8. If you have a problem how to using it, feel free to comment.
