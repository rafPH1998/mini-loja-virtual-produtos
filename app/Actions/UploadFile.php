<?php
namespace App\Actions;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class UploadFile 
{
    public function store(UploadedFile $file, string $path): string
    {
        return $file->store($path);
    }

    public function removeFile(string $filePath): bool
    {
        if (Storage::exists($filePath)) {
            return Storage::delete($filePath);
        }

        return true;
    }
}