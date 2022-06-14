<?php

namespace App\Media;

use Imagick;
use ImagickException;
use ImagickPixel;
use App\Media\MediaHandlerInterface;
use App\Exceptions\MediaFileOperationException;

class ImageHandler implements MediaHandlerInterface
{
    private string $sourceFilePath;
    private string $path;
    private string $fileName;
    private string $fileExtName;
    public function __construct(string $sourceFilePath)
    {
        $this->sourceFilePath=$sourceFilePath;
        //$file=dirname($sourceFilePath);
        $pathinfo=pathinfo($sourceFilePath);
        //dd($pathinfo);
        $this->fileName=$pathinfo['filename'];
        $this->fileExtName='.'.$pathinfo['extension'];
        $this->path=$pathinfo['dirname'];
        //$originName=$uploadedFile->getClientOriginalName();
    }
    private function autoRotateInternal(Imagick $image): array
	{
		try {
			$success = true;
			$orientation = $image->getImageOrientation();

			switch ($orientation) {
				case Imagick::ORIENTATION_TOPLEFT:
					// nothing to do
					break;
				case Imagick::ORIENTATION_TOPRIGHT:
					$success = $image->flopImage();
					break;
				case Imagick::ORIENTATION_BOTTOMRIGHT:
					$success = $image->rotateImage(new ImagickPixel(), 180);
					break;
				case Imagick::ORIENTATION_BOTTOMLEFT:
					$success = $image->flopImage();
					$success &= $image->rotateImage(new ImagickPixel(), 180);
					break;
				case Imagick::ORIENTATION_LEFTTOP:
					$success = $image->flopImage();
					$success &= $image->rotateImage(new ImagickPixel(), -90);
					break;
				case Imagick::ORIENTATION_RIGHTTOP:
					$success = $image->rotateImage(new ImagickPixel(), 90);
					break;
				case Imagick::ORIENTATION_RIGHTBOTTOM:
					$success = $image->flopImage();
					$success &= $image->rotateImage(new ImagickPixel(), 90);
					break;
				case Imagick::ORIENTATION_LEFTBOTTOM:
					$success = $image->rotateImage(new ImagickPixel(), -90);
					break;
			}

			$success &= $image->setImageOrientation(Imagick::ORIENTATION_TOPLEFT);

			if (!$success) {
				throw new MediaFileOperationException('Failed to rotate image');
			}

			return [
				'width' => $image->getImageWidth(),
				'height' => $image->getImageHeight(),
			];
		} catch (ImagickException $exception) {
			throw new MediaFileOperationException('Failed to rotate image', $exception);
		}
	}
    public function compress():void
    {

        $imagick = new Imagick();
        $imagick->readImage($this->sourceFilePath);
        $this->autoRotateInternal($imagick);
        //$w = $imagick->getImageWidth();
        //$h = $imagick->getImageHeight();
        $newCQ=$imagick->getImageCompressionQuality() * 0.35;
        $profiles = $imagick->getImageProfiles('icc', true);
        if($newCQ==0){
            $newCQ=75;
        }
        $imagick->setImageCompressionQuality($newCQ);
        $imagick->stripImage();
        if (!empty($profiles)) {
            $imagick->profileImage('icc', $profiles['icc']);
        }
        $destination=$this->path.'/'.$this->fileName.'_thumb'.$this->fileExtName;
        $imagick->writeImage($destination);
        $imagick->clear();
        $imagick->destroy();
    }
}
