<?php

namespace App\Services;

use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class CloudinaryService
{
    /**
     * Get optimized image URL from Cloudinary
     */
    public static function getImageUrl($publicId, $options = [])
    {
        if (empty($publicId)) {
            return null;
        }

        $defaultOptions = [
            'quality' => 'auto',
            'fetch_format' => 'auto',
            'width' => 400,
            'height' => 300,
            'crop' => 'fill',
        ];

        $options = array_merge($defaultOptions, $options);

        return Cloudinary::getUrl($publicId, $options);
    }

    /**
     * Get video URL from Cloudinary
     */
    public static function getVideoUrl($publicId, $options = [])
    {
        if (empty($publicId)) {
            return null;
        }

        $defaultOptions = [
            'resource_type' => 'video',
            'quality' => 'auto',
            'width' => 800,
            'height' => 450,
            'crop' => 'fill',
        ];

        $options = array_merge($defaultOptions, $options);

        return Cloudinary::getUrl($publicId, $options);
    }

    /**
     * Get thumbnail for video
     */
    public static function getVideoThumbnail($publicId, $options = [])
    {
        if (empty($publicId)) {
            return null;
        }

        $defaultOptions = [
            'resource_type' => 'video',
            'format' => 'jpg',
            'width' => 400,
            'height' => 300,
            'crop' => 'fill',
        ];

        $options = array_merge($defaultOptions, $options);

        return Cloudinary::getUrl($publicId, $options);
    }

    /**
     * Check if file is video based on extension or format
     */
    public static function isVideo($filePath)
    {
        $videoExtensions = ['mp4', 'avi', 'mov', 'wmv', 'flv', 'webm', 'mkv'];
        $extension = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));
        
        return in_array($extension, $videoExtensions);
    }

    /**
     * Get file type (image or video)
     */
    public static function getFileType($filePath)
    {
        return self::isVideo($filePath) ? 'video' : 'image';
    }
}