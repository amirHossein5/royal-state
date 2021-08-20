<?php

namespace App\Services;

use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class ImageService
{
    private static $image, $folder, $sizes;

    /**
     * Save Image.
     *
     */
    public static function save(): array|String
    {
        $path = self::path(self::$folder);
        self::createDirectory($path);

        //if just is one image(without any sizes)
        if (!self::$sizes) {
            return self::saveOneImage(self::$image, $path);
        }

        return self::saveMultipleImages(self::$image, self::$sizes, $path);
    }

    /**
     * Set Image.
     *
     */
    public static function make(object $image): ImageService
    {
        self::$image = $image;
        return new static();
    }

    /**
     * Set folder.
     *
     */
    public static function folder(string $folder): ImageService
    {
        self::$folder = $folder;
        return new static();
    }

    /**
     * Set sizes.
     *
     */
    public static function sizes(array $sizes): ImageService
    {
        self::$sizes = $sizes;
        return new static();
    }

    /**
     * remove image or images.
     *
     */
    public static function remove(array|string $path): Void
    {
        foreach ($path as $image) {
            File::delete(public_path($image));
        }
    }

    /**
     * Making path that image is going to be saved.
     *
     */
    private static function path(string $dir): String
    {
        $d = DIRECTORY_SEPARATOR;
        $date = jdate()->format('Y') . "/" . jdate()->format('m') . "/" . jdate()->format('d');
        $path = "images/$dir/$date/";

        return str_replace('/', $d, $path);
    }

    /**
     * Create folder if not exists.
     *
     */
    private static function createDirectory(string $path): Void
    {
        if (!is_dir(public_path($path))) {
            File::makeDirectory($path, 0755, true);
        }
    }

    /**
     * Save Image if it's one.
     *
     */
    private static function saveOneImage(object $image, string $path): String
    {
        $filename = self::time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path($path), $filename);
        return $path . $filename;
    }

    /**
     * Save multiple image.
     *
     */
    private static function saveMultipleImages(object $image, array $sizes, string $path): array
    {
        $images = [];

        foreach ($sizes as $size) {
            $completePath = $path . self::time() . rand(0, 99) . "__{$size}." . $image->getClientOriginalExtension();
            $resize = explode('_', $size);

            Image::make($image)->resize($resize[0], $resize[1])->save(public_path($completePath));
            $images[$size] = $completePath;
        }

        return $images;
    }

    /**
     * Get current date for creating folders by date.
     *
     */
    private static function time(): string
    {
        return now()->format('H_i_');
    }
}
