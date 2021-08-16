<?php

namespace App\Services;

use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class ImageService
{
    public static function save(object $image, string $dir, ?array $sizes = null): Array|String
    {
        $path = self::path($dir);
        self::createDirectory($path);

        //if just is one image(without any sizes)
        if (!$sizes) {
            return self::saveOneImage($image,$path);
        }

        return self::saveMultipleImages($image,$sizes,$path);
    }

    public static function remove(string $path): Void
    {
        $path = public_path($path);
    }

    public static function path(string $dir): String
    {
        $d = DIRECTORY_SEPARATOR;
        $date = jdate()->format('Y') . $d . jdate()->format('d');
        $path = "images/$dir/$date/";

        return str_replace('/', $d, $path);
    }

    public static function createDirectory(string $path): Void
    {
        if (!is_dir(public_path($path))) {
            File::makeDirectory($path, 0755, true);
        }
    }

    public static function saveOneImage(object $image,string $path): String
    {
        $filename = rand(100, 999) . '.' . $image->getClientOriginalExtension();
        $image->move(public_path($path), $filename);
        return $path . $filename;
    }

    public static function saveMultipleImages(object $image,array $sizes,string $path): Array
    {
        $images = [];

        foreach ($sizes as $size) {
            $completePath = $path . rand(100, 999) . "_{$size}." . $image->getClientOriginalExtension();
            $resize = explode('_', $size);

            Image::make($image)->resize($resize[0], $resize[1])->save(public_path($completePath));
            $images[$size] = $completePath;
        }

        return $images;
    }
}
