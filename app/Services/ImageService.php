<?php

namespace App\Services;

use App\Repositories\ImageRepository;
use App\Traits\ImageTrait;

class ImageService
{
    use ImageTrait;
    protected $imageRepository;
    
    public function __construct(ImageRepository $imageRepository)
    {
        $this->imageRepository = $imageRepository;
    }

    public function uploadImage($userId, $file)
    {

        $path = $this->StoreFiles($file , 'images');
        $this->imageRepository->upload($userId, $path);
        return  $path;
    }

    public function getImageByUserId($userId)
    {
        return $this->imageRepository->getByUserId($userId);
    }

    public function deleteImageByUserId($userId , $image)
    {
   
        $this->deleteFile($image->path);
        return $this->imageRepository->deleteByUserId($userId);
    }
}