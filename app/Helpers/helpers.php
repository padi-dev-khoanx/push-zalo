<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

if (!function_exists('formatDateTime')) {
    function formatDateTime($datetime, $format = 'd/m/Y')
    {
        try {
            return Carbon::parse($datetime)->format($format);
        } catch (\Exception $e) {
            return '';
        }
    }
}

if (!function_exists('asset_admin')) {
    function asset_admin($file = '')
    {
        return asset('assets/' . $file);
    }
}

if (!function_exists('get_path')) {
    function get_path($file = '')
    {
        return empty($file) ? '' : url($file);
    }
}

if (!function_exists('admin_validation')) {
    function admin_validation($message = '')
    {
        return '<span class="error invalid-feedback" style="display:block">' . $message . '</span>';
    }
}

if (!function_exists('upload_file')) {
    function upload_file($file, $folder = 'files')
    {
        if (empty($file)) {
            return false;
        }
        $folder = $folder . '/' . date('Y/m/d');
        $path = Storage::disk('public')->put('upload/' . $folder, $file);

        return Storage::disk('public')->url((string) $path);
    }
}

if (!function_exists('delete_file')) {
    function delete_file($files = [])
    {
        if (empty($files) || !is_array($files)) {
            return false;
        }
        $aws_url = config('filesystems.disks.s3.url');
        foreach ($files as $file) {
            Storage::disk('s3')->delete(str_replace($aws_url, '', $file));
        }

        return true;
    }
}

if (!function_exists('get_file')) {
    function get_file($file = null)
    {
        if (empty($file)) {
            return '';
        }

        return url($file);
    }
}
