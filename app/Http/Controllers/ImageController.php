<?php

namespace App\Http\Controllers;

use App\Http\Resources\ImagesResource;
use App\Services\ImageService;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    protected $imageService;

    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }

    public function upload(Request $request)
    {
        $request->validate([
            'user_id' => 'required|integer',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate image file
        ]);

        $userId = $request->input('user_id');
        $image = $request->file('image');

        $uploadedImage = $this->imageService->uploadImage($userId, $image);
        if ($uploadedImage) {
            return response()->json([
                'message' => 'تم رفع الصورة بنجاح ',
                'image_path' => asset($uploadedImage)
            ], 201);
        } else {
            return response()->json([
                'message' => 'فشل في رفع الصورة '
            ], 500);
        }
    }

    public function getByUserId($userId)
    {
        $image = $this->imageService->getImageByUserId($userId);
        if($image){
            return response()->json(asset($image->path));
        }
        return response()->json([
            'message' => 'لا يوجد صور'
            ], 404);
        
    }

    public function deleteByUserId($userId)
    {
        $image= $this->imageService->getImageByUserId($userId);
        if($image){
            $deleted = $this->imageService->deleteImageByUserId($userId , $image);
       
        if ($deleted) {
            return response()->json([
                'message' => 'تم حذف الصور بنجاح '
            ], 200);
        } else {
            return response()->json([
                'message' => 'لا توجد صور للحذف'
            ], 200);
        }
        }
    }
}