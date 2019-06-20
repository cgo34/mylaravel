<?php

namespace App\Utils;


use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class FileUtils
{
    const VIDEO_COMPRESSOR = 'VIDEO';
    const PICTURE_COMPRESSOR = 'PICTURE';

    const IMAGE_QUALITY = 30;

    const JPG_EXTENSION = 'jpg';
    const PNG_EXTENSION = 'png';
    const GIF_EXTENSION = 'gif';

    public static function saveFile($path, $filename, $extension, $content, $compressor)
    {
        $filePath = null;
        $dirPath = storage_path('app/' . $path);
        if (!file_exists($dirPath)) {
            mkdir($dirPath, 0777, true);
        }
        $fullPath = $dirPath . '/' . $filename . '.' . $extension;
        switch ($compressor) {
            case self::VIDEO_COMPRESSOR:
                $saved = self::saveVideo($fullPath, $extension, $content);
                break;
            case self::PICTURE_COMPRESSOR:
                $saved = self::savePicture($fullPath, $extension, $content);
                break;
            default:
                Log::info('fullpath');
                Log::info($fullPath);
                $saved = Storage::put($fullPath, $content);
        }
        if ($saved !== null) {
            $filePath = $fullPath;
        }
        return $filePath;
    }

    private static function saveVideo($fullPath, $extension, $content)
    {
//        $tmpPath = $path . '.tmp.' . $extension;
//        Storage::put($tmpPath, $content);

        return Storage::put($fullPath, $content);
    }

    private static function savePicture($fullPath, $extension, $content)
    {
        $newContent = imagecreatefromstring($content);
        if (is_resource($newContent)) {
            switch ($extension) {
                case self::JPG_EXTENSION:
                    return imagejpeg($newContent, $fullPath, self::IMAGE_QUALITY);
                    break;
                case self::PNG_EXTENSION:
                    return imagejpeg($newContent, $fullPath, self::IMAGE_QUALITY);
                    break;
                case self::GIF_EXTENSION:
                    return imagejpeg($newContent, $fullPath, self::IMAGE_QUALITY);
                    break;
            }
        }
        return null;
    }
}
