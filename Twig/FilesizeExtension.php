<?php

namespace SPE\FilesizeExtensionBundle\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class FilesizeExtension extends AbstractExtension
{
    /**
     * @param integer $size
     * @param integer $precision
     * @param string  $space
     * @return string
     */
    public function readableFilesize($size, $precision = 2, $space = ' ')
    {
        if( $size <= 0 ) {
            return '0' . $space . 'KB';
        }

        if( $size === 1 ) {
            return '1' . $space . 'byte';
        }

        $mod = 1024;
        $units = array('bytes', 'KB', 'MB', 'GB', 'TB', 'PB');

        for( $i = 0; $size > $mod && $i < count($units) - 1; ++$i ) {
            $size /= $mod;
        }

        return round($size, $precision) . $space . $units[$i];
    }

    /**
     * @return array
     */
    public function getFilters()
    {
        return array(
            new TwigFilter('readable_filesize', array($this, 'readableFilesize')),
        );
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'spe_filesize_extension';
    }
}
