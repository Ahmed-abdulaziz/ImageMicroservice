<?php

namespace App\Repositories;

use App\Models\Image;

class ImageRepository
{
    protected $image;

    public function __construct(Image $image)
    {
        $this->image = $image;
    }

    public function upload($userId, $path)
    {
        return $this->image->create([
            'user_id' => $userId,
            'path' => $path,
        ]);
    }

    public function getByUserId($userId)
    {
        return $this->image->where('user_id', $userId)->latest()->first();
    }

    public function deleteByUserId($userId)
    {
        return $this->image->where('user_id', $userId)->delete();
    }
}