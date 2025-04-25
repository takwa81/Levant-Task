<?php

namespace App\Traits;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

trait ImageHandler
{
    public function storeImage(UploadedFile $image, string $folder): string
    {
        $imagePath = (string) Str::uuid() . '.' . $image->getClientOriginalExtension();
        $image->storeAs($folder, $imagePath, 'private');

        return $imagePath;
    }

    public function updateImage(UploadedFile $image, ?string $oldImagePath, string $folder): string
    {
        if (!empty($oldImagePath) && Storage::disk('private')->exists($folder . '/' . $oldImagePath)) {
            Storage::disk('private')->delete($folder . '/' . $oldImagePath);
        }

        return $this->storeImage($image, $folder);
    }
}