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
        $realPath=realpath($this->sourceFilePath);
        $imagick->readImage($this->sourceFilePath);

        $w = $imagick->getImageWidth();
        dd($w);
        $h = $imagick->getImageHeight();

    }
}
