<?php
namespace App\Traits;

use Illuminate\Support\Facades\File;

trait ImageTrait{

    
   public function StoreFiles($photo,$folder){

        $file_extintion=$photo->getClientOriginalExtension();
        $file_name=time().random_int(5,30).'.'.$file_extintion;
        $path=$folder;
        $photo->move($path,$file_name);
        return $path.'/'.$file_name;

    }

    public function deleteFile($folder)
    {
        $path = $folder;

        if (File::exists($path)) {
            File::delete($path);

            return true;
        } else {
            return false;
        }
    }



}
