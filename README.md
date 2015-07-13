EJSPlug For CKFinder
	Copyright (C) 2015 Eko Junaidi Salam

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details, see http://www.gnu.org/licenses.
    

# Database Plugin for CKFinder V1
This is a plugin I created to store file information to the database each upload,rename, and delete a file in a CKFinder. Hope this useful to the others CKFinder User.

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
2. Set the configuration as usual, place a library "ckfinder.php" in folder application/libraries.
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

# How to use this DEMO from github subversion ?
1. Create folder in your htdocs ckfinderku and Checkout from trunk folder in https://github.com/ekojs/Database_Plugin4CKFinder/trunk
2. Create database using *.sql from assets/slideshow.sql, assets/userfiles.sql, assets/users.sql.
3. Change the configuration in application/config/database.php file using information from your new database created earlier.
4. Change line 21 in application/controllers/welcome.php file 
```php
    $this->ckfinder->BasePath = '/ckfinderku/assets/ckfinder/'; //change this path based on your need, this line means : http://localhost/ckfinderku/assets/ckfinder
```
5. Change line number 75 and 346-355 in assets/ckfinder/config.php file.
```php
    $baseUrl = 'http://'.$_SERVER['SERVER_NAME'].'/ckfinderku/assets/ckfinder/userfiles/'; //change this line 75 and 346 based on your configuration above
	
	$config['Plugin_ejsplug'] = array(
        "dbhost" => "",
        "dbuser" => "",
        "dbpass" => "",
        "dbase" => "",
        "opt" => array(
            "main_table" => "slideshow",
            "other_table" => "userfiles"
        )
    );
```
6. Run this demo http://localhost/ckfinderku and click "Here"
7. For the first time you run the ckfinder it will create a folder in userfiles/
```php
    assets/ckfinder/userfiles/_thumbs
    assets/ckfinder/userfiles/files
    assets/ckfinder/userfiles/flash
    assets/ckfinder/userfiles/images
```
8. Create folder "slideshow" in assets/ckfinder/userfiles/images
9. Refresh the ckfinder page until you see slideshow child folder in images folder
10. Test upload, rename and delete while you check in slideshow table in database.
