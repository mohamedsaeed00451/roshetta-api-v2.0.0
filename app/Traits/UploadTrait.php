<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;

trait UploadTrait
{
    public function deleteImage($folder,$image)
    {
        if (!in_array($image, ['default/0ece90fcb9939d35846m.png', 'default/0ece90fcb9939d35846p.png','default/c565d293abcd20a54b02.jpg'])){
            $exists = Storage::disk('uploads')->exists($folder.'/'.$image);
            if ($exists) {
                Storage::disk('uploads')->delete($folder.'/'.$image);
            }
        }
    }

    public function addImage($folder,$image)
    {
        $path = $image->store($folder,'uploads');
        if ($path) {
            $image_name = explode('/',$path);
            return end($image_name);
        }
        return false;
    }
}
