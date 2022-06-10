<?php
namespace App\Image;

class MediaFile
{
    public function GetJsonExifInfo($filePath)
    {
        
        $exif=exif_read_data($filePath,0,true);
        if($exif===false){
            return array(
                'Exif'=>false
            );
        }
        else{
            $result=json_encode($exif);
        }
        if($result===false){
            $this->reloadExif($exif);
        }
        return $result;
        # code...
    }
    public function reloadExif($exif){
        foreach ($exif as $key => $section) {
            foreach ($section as $name => $val) {

            }
        }
    }
}