<?php

namespace App\Media;

use Imagick;
use ImagickException;
use ImagickPixel;
use App\Media\MediaHandlerInterface;

class ImageHandler implements MediaHandlerInterface
{
    private string $sourceFilePath;
    public function __construct(string $sourceFilePath)
    {
        $this->sourceFilePath=$sourceFilePath;
    }
    public function compress():void
    {

        $imagick = new Imagick();
        
        $imagick->readImage($this->sourceFilePath);
        $w = $imagick->getImageWidth();
        $h = $imagick->getImageHeight();
        $newCQ=$imagick->getImageCompressionQuality() * 0.75;
        $profiles = $imagick->getImageProfiles('icc', true);
        if($newCQ==0){
            $newCQ=75;
        }
        $imagick->setImageCompressionQuality($newCQ);
        $imagick->stripImage();
        if (!empty($profiles)) {
            $imagick->profileImage('icc', $profiles['icc']);
        }

        $imagick->writeImage($destination);
        $imagick->clear();
        $imagick->destroy();
    }
}
