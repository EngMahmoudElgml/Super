<?php

namespace EngMahmoudElgml\Super\Traits;
use EngMahmoudElgml\Super\Facades\Super;
use Image;
use File;
use Excel;

trait FileTrait
{
    public function uploadImage($file, $imageLocation, $resizeWidth=null, $width=null, $height=null)
    {
        ini_set('upload_max_filesize', '10M');

        $image = $file;

        if($resizeWidth==null && $width==null && $height==null){
            Image::make($image)->save($imageLocation);
        }
        else{
            // Upload Image
            Image::make($image)->resize($width,$height)->save($imageLocation);;
         /*   Image::make($image)->resize($resizeWidth, $height, function ($constraint) {

            })->crop($width, $height)->save($imageLocation);*/
        }


    }

    public function uploadFile($file, $stringPath)
    {
        $file = $file;
        $fileName = time() . Super::randomPin() .  '.' . $file->getClientOriginalExtension();
        $fileLocation = getcwd() . '/' . $stringPath . '/';
        $file->move($fileLocation, $fileName);
        if(!$file){
            return FALSE;
        }
        return $fileName;
    }

    public function uploadFile64($string, $stringPath)
    {
     /*   if (!$this->check_base64_image($string)) {
            return FALSE;
        }*/
        $string = str_replace(['data:image/jpeg;base64,', 'data:image/jpg;base64,', 'data:image/png;base64,'], '', $string);
        $string = str_replace(' ', '+', $string);
        $filename = time() . '.' . 'png'; // file name based on time
        $fileLocation = getcwd() . '/' . $stringPath . '/' . $filename;
        $file = base64_decode($string);
        file_put_contents($fileLocation, $file);
        if(!$file){
            return FALSE;
        }
        return $filename;
    }

    function check_base64_image($base64) {
        $img = @imagecreatefromstring(base64_decode($base64));
        if (!$img) {
            return false;
        }

        imagepng($img, 'tmp.png');
        $info = getimagesize('tmp.png');

        unlink('tmp.png');

        if ($info[0] > 0 && $info[1] > 0 && $info['mime']) {
            return true;
        }

        return false;
    }

    public function uploadMultipleImages64($array, $stringPath){
        $uploadedOnes = [];
        if(is_array($array)){
            foreach ($array as $string){
                $filename = $this->uploadFile64($string, $stringPath);
                $uploadedOnes[] = $filename;
            }
            return $uploadedOnes;
        }
    }

    public function deleteFile($path){
        File::delete( getcwd() . '/' . $path);
    }

    public function exportExcel($sheet){

        $data  = $sheet;

        Excel::create('Report', function($excel) use($data) {

            $excel->sheet('Excel sheet', function($sheet) use($data){

                $sheet->fromArray($data);

                $sheet->setOrientation('portrait');

            });
        })->export('xls');
    }

    public function upload_content_s3($content,$path){
        $name = time() . rand(1111, 9999) . '.pdf';
        $stringPath = 'safqa/'.$path .'/'. $name;
        \Storage::disk('s3')->put($stringPath, $content);
        return $stringPath;
    }

    public function upload_s3($file,$path){
        $name = time() . rand(1111, 9999) .  '.' . $file->getClientOriginalExtension();
        $stringPath = 'safqa/'.$path .'/'. $name;
        \Storage::disk('s3')->put($stringPath, file_get_contents($file));

        return $stringPath;
    }

}
