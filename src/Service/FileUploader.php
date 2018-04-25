<?php

namespace App\Service;


use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileUploader {
    private $targetDirectory;

    public function __construct($targetDirectory)
    {
        $this->targetDirectory = $targetDirectory;
    }

    public function uploadImage(UploadedFile $file)
    {
        $fileName = md5(uniqid()).'.'.$file->guessExtension();

//        if(!$this->validateImage($fileName)) {
//            return false;
//        }
        //TODO: test if imagejpeg works/ isolate file movement function to test
        $file->move($this->getTargetDirectory(), $this->targetDirectory.'/'.$fileName);

        return $fileName;
    }

    public function validateImage($fileName) {

        // Check if file size is too big
        $fileSize = filesize($fileName);
        if($fileSize >= 1000000000) {
            return false;
        }

        // Check image's MIME type
        if($this->getValidImageMime($fileName) === false) {
            return false;
        }

    }

    // If uploaded file has an image MIME type, return the type; Else return false
    public function getValidImageMime($filePathName ) {
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mtype = finfo_file( $finfo, $filePathName );
        finfo_close( $finfo );

        if($mtype == "image/png") {
            return "png";
        }
        elseif($mtype == "image/jpeg") {
            return "jpg";
        }
        else {
            return FALSE;
        }
    }

    public function removeImage($image) {
        $fileSystem = new Filesystem();
        $path = $this->getTargetDirectory().'/'.$image;
        $fileSystem->remove($path);

    }
    public function getTargetDirectory()
    {
        return $this->targetDirectory;
    }

}