<?php
namespace App\Media;

use Exception;

class MediaFile
{
    protected string $filePath;

    public function __construct(string $filePath)
    {
        $this->filePath=$filePath;

    }
    public function getJsonExifInfo(&$takeTime=null)
    {
        try{
            $exif=exif_read_data($this->filePath,0,true);
            //dd($exif);
            $takeTime=$exif['EXIF']['DateTimeOriginal'];
        }
        catch(Exception $e){
            $exif = array(
                'error'=>$e->getMessage()
            );
        }
            //'Incorrect APP1 Exif Identifier Code'
        if($exif===false){
            $result = array(
                'error'=>'None'
            );
        }
        else{
            $result=json_encode($exif,JSON_PARTIAL_OUTPUT_ON_ERROR);
            //dd($result);
        }
        if($result===false){
            $result = array('error'=>json_last_error_msg());
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
    public function getImageSize(&$info=null){
        return getImageSize($this->filePath,$info);
    }
}
