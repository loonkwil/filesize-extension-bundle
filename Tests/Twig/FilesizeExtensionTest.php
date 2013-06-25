<?php

namespace SPE\FilesizeExtensionBundle\Test\Twig;

use SPE\FilesizeExtensionBundle\Twig\FilesizeExtension;

define('KB', 1024);
define('MB', KB * 1024);
define('GB', MB * 1024);
define('TB', GB * 1024);
define('PB', TB * 1024);

class FilesizeExtensionTest extends \PHPUnit_Framework_TestCase
{
    protected $fse;

    protected function setUp()
    {
        $this->fse = new FilesizeExtension();
    }

    protected function checkToFilesize($out, $size)
    {
        $this->assertEquals($out, $this->fse->readableFilesize($size));
    }


    public function testReadableFilesize()
    {
        $this->checkToFilesize('0 KB', -1);
        $this->checkToFilesize('0 KB', 0);
        $this->checkToFilesize('1 byte', 1);
        $this->checkToFilesize('2 bytes', 2);
        $this->checkToFilesize('2 KB', 2 * KB);
        $this->checkToFilesize('2.51 KB', 2.51 * KB);
        $this->checkToFilesize('2.52 KB', 2.516 * KB);
        $this->checkToFilesize('2 MB', 2 * MB);
        $this->checkToFilesize('2 GB', 2 * GB);
        $this->checkToFilesize('2 TB', 2 * TB);
        $this->checkToFilesize('2 PB', 2 * PB);
    }
}
