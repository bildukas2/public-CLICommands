#!/usr/bin/env php
<?php

// open Command-line interface and start start.php no extensions was used
require_once "resource/Helpers.php";


$helper = new resource\Helpers();

echo "Are you sure? 'yes': ";

$input = $helper->handleUserInput();

if(trim($input) != 'yes'){
    echo "ABORTING!\n";
    exit;
}

echo "\n";
echo "List of commands 'list'\n";

// this case as simple as possible and made in my opinion
// fastest way just to show the idea of my thinking it can be expanded and flexible
// limits only imagination :)

while (true){
$input = $helper->handleUserInput();
	switch ($input) {
		case "list":
			echo "here your list: \n";
			echo "showDir (show dir tree) \n";
			echo "createDir (make dir) \n";
			echo "deleteDir (remove dir) \n";
			echo "copyFile (copy file) \n";
			echo "cutFile (move file) \n";
			echo "backup (move all files to ftp server) \n";
			break;
		case "showDir":
			echo "Dir List : \n";
			print_r($helper->showFoldersAndFilesInArrayTree());
			break;
		case "createDir":
			echo "enter foldername/foldername/ to create \n";
			$input = $helper->handleUserInput();
            $helper->createFolder($input);
			break;
		case "deleteDir":
			echo "enter foldername or file to delete \n";
			$input = $helper->handleUserInput();
            $helper->deleteDir($input);
			break;
		case "copyFile":
			echo "enther what to move? \n";
			$what = $helper->handleUserInput();
			echo "enther where to move? empty will place to root folder\n";
			$where = $helper->handleUserInput();
            $helper->copyCutFile($what, $where);
			break;
		case "cutFile":
			echo "enther what to move? \n";
			$what = $helper->handleUserInput();
			echo "enther where to move? empty will place to root folder\n";
			$where = $helper->handleUserInput();
            $helper->copyCutFile($what, $where, "cut");
			break;
		case "backup":
			echo "ftp server? \n";
			$ftpServer = $helper->handleUserInput();
			echo "ftp user? \n";
			$ftpUser = $helper->handleUserInput();
			echo "ftp pass? \n";
			$ftpPass = $helper->handleUserInput();
			echo "The remote file path.? \n";
			$remotePath = $helper->handleUserInput();
            $helper->uploadToFTPFolder($ftpServer, $ftpUser, $ftpPass, $remotePath);
			break;
		default: 
			echo "em what ? \n \n";
			break;
	}
}


?>