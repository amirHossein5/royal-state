<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ImageService
{
    private static $image, $folder, $sizes, $name, $type;

    /**
     * Save Image.
     *
     */
    public static function save(): array|String
    {
        $path = self::path(self::$folder);

        //if just is one image(without any sizes)
        if (!self::$sizes) {
            return self::saveImage(self::$image, $path);
        }

        return self::saveImageWithSize(self::$image, self::$sizes, $path);
    }

    /**
     * Set Image.
     *
     */
    public static function make(object|string $image): ImageService
    {
        if (is_string($image)) {
            self::$image = new UploadedFile($image, self::$name, self::$type);
            return new static();
        }

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
            Storage::delete(self::getRemovePath($image));
        }
    }

    /**
     * makes image and returns that or if exists just returns.
     *
     */
    public static function makeIfNotExists(string $path): Object
    {
        self::make($path);

        if (file_exists($path)) {
            return self::get();
        }

        return self::save();
    }

    /**
     * returns image.
     *
     */
    public static function get(): object
    {
        return self::$image;
    }

    /**
     * Making path that image is going to be saved.
     *
     */
    private static function path(string $dir): String
    {
        $date = jdate()->format('Y') . "/" . jdate()->format('m') . "/" . jdate()->format('d');
        $path = "images/$dir/$date/";

        return self::directory_separator($path);
    }

    /**
     * return given path by directory separator.
     *
     */
    private static function directory_separator(string $path): string
    {
        $d = DIRECTORY_SEPARATOR;

        return str_replace('/', $d, $path);
    }

    /**
     * sets image name when making UploadedFile() object.
     *
     */
    public static function name(string $name): ImageService
    {
        self::$name = $name;

        return new static();
    }

    /**
     * sets image type when making UploadedFile() object.
     *
     */
    public static function type(string $type): ImageService
    {
        self::$type = $type;

        return new static();
    }

    /**
     * Save Image if it's one.
     *
     */
    private static function saveImage(object $image, string $path): String
    {
        $filename = self::time() . '.' . $image->getClientOriginalExtension();

        $image->storeAs(self::stick_public($path), $filename);

        return self::stick_storage($path) . $filename;
    }

    /**
     * Save multiple image.
     *
     */
    private static function saveImageWithSize(object $image, array $sizes, string $path): array
    {
        $images = [];
        $extension = $image->extension();

        foreach ($sizes as $size) {
            $fileName = self::time() . rand(0, 99) . "__{$size}.{$extension}";
            $resize = explode('_', $size);

            $image = Image::make($image)->resize($resize[0], $resize[1]);
            Storage::put(self::stick_public($path) . $fileName, $image->encode());

            $images[$size] = self::stick_storage($path) . $fileName;
        }

        return $images;
    }

    /**
     * sticks storage to first of the string.
     *
     */
    private static function stick_storage(string $path): string
    {
        return self::directory_separator("storage/{$path}");
    }

    /**
     * sticks public to first of the string.
     *
     */
    private static function stick_public(string $path): string
    {
        return self::directory_separator("public/{$path}");
    }

    /**
     * returns image remove path.
     *
     */
    private static function getRemovePath(string $imagePath): string
    {
        $imagePath = str_replace('storage/', 'public/', $imagePath);

        return self::directory_separator($imagePath);
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
