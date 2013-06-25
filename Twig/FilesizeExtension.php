<?php

namespace SPE\FilesizeExtensionBundle\Twig;

class FilesizeExtension
{
    /**
     * @param integer $size
     * @return string
     */
    public function readableFilesize($size)
    {
        if( $size <= 0 ) {
            return '0 KB';
        }

        if( $size === 1 ) {
            return '1 byte';
        }

        $mod = 1024;
        $units = array('bytes', 'KB', 'MB', 'GB', 'TB', 'PB');

        for( $i = 0; $size > $mod && $i < count($units) - 1; ++$i ) {
            $size /= $mod;
        }

        return round($size, 2) . ' ' . $units[$i];
    }

    /**
     * @return array
     */
    public function getFilters()
    {
        return array(
            'readable_filesize' => new \Twig_Filter_Method(
                $this, 'readableFilesize'
            ),
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
