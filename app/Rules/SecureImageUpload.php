<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Http\UploadedFile;

class SecureImageUpload implements ValidationRule
{
    /**
     * Run the validation rule.
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!$value instanceof UploadedFile) {
            $fail('The :attribute must be a valid file.');
            return;
        }

        // Validate file extension
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'webp'];
        $extension = strtolower($value->getClientOriginalExtension());
        
        if (!in_array($extension, $allowedExtensions)) {
            $fail('The :attribute must be an image file (JPG, PNG, or WEBP).');
            return;
        }

        // Validate MIME type
        $allowedMimeTypes = ['image/jpeg', 'image/png', 'image/webp'];
        $mimeType = $value->getMimeType();
        
        if (!in_array($mimeType, $allowedMimeTypes)) {
            $fail('The :attribute must be a valid image file.');
            return;
        }

        // Validate file size (2MB max)
        $maxSize = 2 * 1024 * 1024; // 2MB in bytes
        if ($value->getSize() > $maxSize) {
            $fail('The :attribute must not exceed 2MB.');
            return;
        }

        // Validate that it's actually an image by checking dimensions
        $imageInfo = @getimagesize($value->getRealPath());
        if ($imageInfo === false) {
            $fail('The :attribute must be a valid image file.');
            return;
        }
    }
}
