<?php
namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class FileUploadService
{
    
    public function upload(UploadedFile $file): array
    {
        // تشخیص نوع فایل
        $fileType = $this->detectFileType($file);

        // تعیین پوشه مقصد بر اساس نوع فایل
        $folder = match ($fileType) {
            'image' => 'Ticket/images',
            'pdf' => 'Ticket/pdfs',
            'zip' => 'Ticket/zips',
            default => throw new \Exception('نوع فایل پشتیبانی نمی‌شود.'),
        };

        // ساخت نام یکتا برای فایل
        $fileName = time() . '_' . $file->getClientOriginalName();

        // ذخیره فایل در پوشه مربوطه
        $filePath = $file->storeAs($folder, $fileName, 'public');

        // برگرداندن اطلاعات فایل
        return [
            'path' => $filePath, // مسیر نسبی (مثلاً images/123_file.jpg)
            'url' => Storage::url($filePath), // لینک کامل (مثلاً /storage/images/123_file.jpg)
            'size' => $file->getSize(), // اندازه فایل به بایت
            'type' => $file->getClientMimeType(), // نوع MIME (مثلاً image/jpeg)
        ];
    }

    /**
     * تشخیص نوع فایل
     */
    private function detectFileType(UploadedFile $file): string
    {
        $mimeType = $file->getClientMimeType();

        return match (true) {
            str_starts_with($mimeType, 'image/') => 'image',
            $mimeType === 'application/pdf' => 'pdf',
            $mimeType === 'application/zip' || $mimeType === 'application/x-zip-compressed' => 'zip',
            default => throw new \Exception('نوع فایل نامعتبر است.'),
        };
    }
}