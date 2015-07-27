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


    public function testReadableFilesize()
    {
        $this->assertEquals('0 KB', $this->fse->readableFilesize(-1));
        $this->assertEquals('0 KB', $this->fse->readableFilesize(0));
        $this->assertEquals('1 byte', $this->fse->readableFilesize(1));
        $this->assertEquals('2 bytes', $this->fse->readableFilesize(2));
        $this->assertEquals('2 KB', $this->fse->readableFilesize(2 * KB));
        $this->assertEquals('2.51 KB', $this->fse->readableFilesize(2.51 * KB));
        $this->assertEquals('2.52 KB', $this->fse->readableFilesize(2.516 * KB));
        $this->assertEquals('2 MB', $this->fse->readableFilesize(2 * MB));
        $this->assertEquals('2 GB', $this->fse->readableFilesize(2 * GB));
        $this->assertEquals('2 TB', $this->fse->readableFilesize(2 * TB));
        $this->assertEquals('2 PB', $this->fse->readableFilesize(2 * PB));
    }

    public function testPrecision()
    {
        $this->assertEquals(
            '1 KB', $this->fse->readableFilesize(1.2345 * KB, 0)
        );
        $this->assertEquals(
            '1.23 KB', $this->fse->readableFilesize(1.2345 * KB, 2)
        );
        $this->assertEquals(
            '1.235 KB', $this->fse->readableFilesize(1.2345 * KB, 3)
        );
    }

    public function testSeparator()
    {
        $this->assertEquals(
            '2KB', $this->fse->readableFilesize(2 * KB, 0, '')
        );
    }
}
