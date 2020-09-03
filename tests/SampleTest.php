<?php

use PHPUnit\Framework\TestCase;
use Resource\Helpers;

class SampleTest extends TestCase
{


    /**
     * @test
     */
    public function testMkdirWorksAsExpected()
    {
        $tmp_dir = 'disc/mkDirTest';

        if (is_dir($tmp_dir)) {
            @rmdir($tmp_dir);
        }
        @mkdir($tmp_dir, 0755, true);
        var_dump($tmp_dir);
        $this->assertTrue(is_dir($tmp_dir));
        @rmdir($tmp_dir);
    }

    /**
     * @test
     */
    public function testFunctionCreateFolder()
    {
        $expect = 'disc/mkDirTest/';
        $create = 'mkDirTest';
        $helper = new Helpers();

        if (is_dir($expect)) {
            @rmdir($expect);
        }
        $helper->createFolder($create);
        $this->assertTrue(is_dir($expect));
        @rmdir($expect);
    }

    /**
     * @test
     */
    public function testRmdirWorksAsExpected()
    {
        $tmp_dir = 'disc/mkDirTest';

        if (!is_dir($tmp_dir)) {
            @mkdir($tmp_dir, 0755, true);
        }
        @rmdir($tmp_dir);
        $this->assertFalse(is_dir($tmp_dir));

    }

    /**
     * @test
     */
    public function testFunctionDeleteFolder()
    {
        $expect = 'disc/mkDirTest/';
        $delete = 'mkDirTest';
        $helper = new Helpers();

        if (!is_dir($expect)) {
            @mkdir($expect, 0755, true);
        }
        $helper->deleteDir($delete);
        $this->assertFalse(is_dir($expect));

    }






}