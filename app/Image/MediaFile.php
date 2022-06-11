<?php
namespace App\Image;

class MediaFile
{
    protected string $filePath;

    public function __construct(string $filePath)
    {
        $this->filePath=$filePath;
    
    }
    public function getJsonExifInfo()
    {
        $exif=exif_read_data($this->filePath,0,true);
        if($exif===false){
            $result = array(
                'Exif'=>false
            );
        }
        else{
            $result=json_encode($exif);
        }
        if($result===false){
            $result = array('Exif'=>'Convert Error');
            //$this->reloadExif($exif);
        }
        return $result;
    }
    public function reloadExif($exif){
        foreach ($exif as $key => $section) {
            foreach ($section as $name => $val) {

            }
        }
    }
    public function getFileSize(){
         return filesize($this->filePath);
    }
    public function getImageSize(){
        return getImageSize($this->filePath);
    }
}