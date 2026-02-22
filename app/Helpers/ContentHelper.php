<?php

namespace App\Helpers;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

class ContentHelper
{
    /** Yüklenen dosyayı doğrudan public/uploads altına kaydeder. DirectAdmin'de public_html kullanır: önce UPLOADS_PUBLIC_PATH, yoksa DOCUMENT_ROOT (public_html). */
    public static function saveToPublicUploads(UploadedFile $file, string $folder = ''): string
    {
        $base = config('app.uploads_path', 'uploads');
        $rootDir = config('app.uploads_public_path');
        if (empty($rootDir) && !empty($_SERVER['DOCUMENT_ROOT']) && is_dir($_SERVER['DOCUMENT_ROOT'])) {
            $rootDir = $_SERVER['DOCUMENT_ROOT'];
        }
        if ($rootDir) {
            $rootDir = rtrim(str_replace('\\', '/', $rootDir), '/');
            $dir = $folder === '' ? $rootDir . '/' . $base : $rootDir . '/' . $base . '/' . $folder;
        } else {
            $dir = $folder === '' ? public_path($base) : public_path($base . '/' . $folder);
        }
        if (!is_dir($dir)) {
            mkdir($dir, 0755, true);
        }
        $name = Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
        $file->move($dir, $name);
        return $folder === '' ? $base . '/' . $name : $base . '/' . $folder . '/' . $name;
    }

    /**
     * Görsel path'ini tam URL'e çevirir (domain'de çalışması için APP_URL veya ASSET_URL doğru olmalı).
     * - Zaten tam URL (http/https) ise olduğu gibi döner.
     * - uploads/... → public; production'da HTTPS zorlanır.
     * - img/ veya vendor/ → tema (front/...)
     * - Diğer (eski storage) → asset('storage/'.$value)
     */
    public static function imageUrl(?string $value): string
    {
        if ($value === null || $value === '') {
            return '';
        }
        if (str_starts_with($value, 'http://') || str_starts_with($value, 'https://')) {
            return $value;
        }
        if (str_starts_with($value, 'img/') || str_starts_with($value, 'vendor/')) {
            return asset('front/' . $value);
        }
        if (str_starts_with($value, 'uploads/')) {
            return config('app.env') === 'production' ? \secure_asset($value) : asset($value);
        }
        return asset('storage/' . $value);
    }

    /** Telefon numarasını 0 (555) 555 55 55 formatında gösterir. */
    public static function formatPhone(?string $phone): string
    {
        if ($phone === null || trim($phone) === '') {
            return '';
        }
        $digits = preg_replace('/\D/', '', $phone);
        if (strlen($digits) < 10) {
            return $phone;
        }
        if (strlen($digits) === 10) {
            $digits = '0' . $digits;
        }
        if (strlen($digits) >= 11) {
            return '0 (' . substr($digits, 1, 3) . ') ' . substr($digits, 4, 3) . ' ' . substr($digits, 7, 2) . ' ' . substr($digits, 9, 2);
        }
        return $phone;
    }
}
