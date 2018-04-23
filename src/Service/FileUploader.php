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

        $file->move($this->getTargetDirectory(), $this->targetDirectory.'/'.$fileName);

        return $fileName;
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