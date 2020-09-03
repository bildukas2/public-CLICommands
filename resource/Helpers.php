<?php

namespace Resource;

class Helpers
{

    private $startDir = "disc/";

    public function handleUserInput():string {
        $handle = fopen ("php://stdin","r");
        $line = fgets($handle);
        return trim($line);
    }

    public function createFolder($path) {

        if ( is_dir($this->startDir.$path)) {
            print "all ready exist \n";
            return;
        };
        $ret = @mkdir($this->startDir.$path, 0755, true);
        if ($ret === true ) print "created \n";

    }

    public function deleteDir($path) {
        if (empty($path)) {
            print "nothing to deleted \n";
            return;
        }

        $path = $this->startDir.$path;

        if (is_file($path)){
            unlink($path);
        }else{
            rmdir($path);
        }
        print "deleted \n";

    }


    public function showFoldersAndFilesInArrayTree($dir="disc/") {

        $result = array();

        $directory = @scandir($dir);
        if (is_array($directory)){
            foreach ($directory as $key => $value)
            {
                if (!in_array($value,array(".","..")))
                {
                    if (is_dir($dir . DIRECTORY_SEPARATOR . $value))
                    {
                        $result[$value] = $this->showFoldersAndFilesInArrayTree($dir . DIRECTORY_SEPARATOR . $value);
                    }
                    else
                    {
                        $result[] = $value;
                    }
                }
            }
        }
        return ($result);
    }

    public function copyCutFile($src, $dst, $action="copy") {
        //if (file_exists($dst)) rmdir($dst);
        $src_parts = pathinfo($src);
        $dst_parts = pathinfo($dst);

        $path = (isset($dst_parts['extension']))? $this->startDir.$dst : $this->startDir.$dst."/".$src_parts['basename'];
        if (file_exists($src)){
            if ($action =="copy"){
                copy($src, $path);
                print "coped to: " .$path ;
                print "\n";
            }else{
                copy($src, $path);
                unlink($src);
                print "cut to: " .$path ;
                print "\n";
            }
        }else{
            print "can't finde file! \n\n";
        }

    }

    public function uploadToFTPFolder($ftpServer, $ftpUser, $ftpPass, $remotePath = null)
    {
        $conn_id = ftp_connect($ftpServer);

        ftp_login($conn_id, $ftpUser, $ftpPass);
        $startDir = $remotePath;
        $dh = opendir($this->startDir.$startDir) ;
        while ($file = readdir($dh)) {
            if ($file != '.' and $file != '..') {
                print ($startDir.$file."\n");
                if(!is_dir($this->startDir.$startDir.$file)) {
                    ftp_put($conn_id, $startDir.$file , $this->startDir.$startDir.$file, FTP_BINARY);
                } else {
                    ftp_mkdir($conn_id, $file);
                    self::uploadToFTPFolder($ftpServer, $ftpUser, $ftpPass, $startDir.$file."/");
                }
            }
        }
        ftp_close($conn_id);
    }


}