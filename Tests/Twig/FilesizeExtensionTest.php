<?php

namespace SPE\FilesizeExtensionBundle\Test\Twig;

use PHPUnit\Framework\TestCase;
use SPE\FilesizeExtensionBundle\Twig\FilesizeExtension;

define('KB', 1024);
define('MB', KB * 1024);
define('GB', MB * 1024);
define('TB', GB * 1024);
define('PB', TB * 1024);

class FilesizeExtensionTest extends TestCase
{
    protected $fse;

    protected function setUp(): void
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
    public function testSuffix()
    {
        $this->assertEquals('12.35 KB', $this->fse->readableFilesize('12.3456 KB'));
        $this->assertEquals('12.35 MB', $this->fse->readableFilesize('12.3456 MB'));
        $this->assertEquals('12.35 GB', $this->fse->readableFilesize('12.3456 GB'));
        $this->assertEquals('12.35 TB', $this->fse->readableFilesize('12.3456 TB'));
        $this->assertEquals('12.35 PB', $this->fse->readableFilesize('12.3456 PB'));
        $this->assertEquals('12.06 GB', $this->fse->readableFilesize(12.06*KB . ' MB'));
        $this->assertEquals('12.34 TB', $this->fse->readableFilesize(12.34/KB . 'PB'));
    }

    public function testVeryBigNumber()
    {
        $this->assertEquals('1.18 PB', $this->fse->readableFilesize('1324567890123456'));
    }
}
