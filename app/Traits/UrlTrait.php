<?php

namespace App\Traits;

trait UrlTrait
{
    public function getPath($type, $name)
    {
        if ($type == 'profile') {
            $path = 'images/profile/' . $name;
        }

        if ($type == 'place') {
            $path = 'images/place/' . $name;
        }

        if ($type == 'video') {
            $path = 'videos/' . $name;
        }

        if (file_exists(public_path('/uploads/' . $path))) {
            return url('/public/uploads/' . $path);
        }

        return null;
    }
}
