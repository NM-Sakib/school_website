<?php

use Carbon\Carbon;

if (!function_exists('langExtension')) {
  function langExtension($name, $lang)
  {
    $extensions = [
      'en' => ' English',
      'bn' => ' Bangla',
    ];

    return $name . ($extensions[$lang] ?? '');
  }
}

if (!function_exists('getBaseURL')) {
  function getBaseURL()
  {
    $root = '//' . $_SERVER['HTTP_HOST'];
    $root .= str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']);

    return $root;
  }
}


if (!function_exists('getFileBaseURL')) {
  function getFileBaseURL()
  {
    if (env('FILESYSTEM_DRIVER') == 's3') {
      return env('AWS_URL') . '/';
    } else {
      return getBaseURL();
    }
  }
}

if (!function_exists('convertToBanglaDate')) {
  function convertToBanglaDate(string $date, string $format = 'F j, Y'): string
  {
    Carbon::setLocale('bn');

    $carbonDate = Carbon::parse($date);
    $formatted = $carbonDate->translatedFormat($format);

    $banglaDigits = ['০', '১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯'];
    return str_replace(range(0, 9), $banglaDigits, $formatted);
  }
}

//return file uploaded via uploader
if (!function_exists('uploaded_asset')) {
  function uploaded_asset($id)
  {
    if (($asset = \App\Models\Upload::find($id)) != null) {
      return asset($asset->file_name);
    }
    return null;
  }
}

if (!function_exists('formatBytes')) {
  function formatBytes($bytes, $precision = 2)
  {
    $units = array('B', 'KB', 'MB', 'GB', 'TB');

    $bytes = max($bytes, 0);
    $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
    $pow = min($pow, count($units) - 1);

    // Uncomment one of the following alternatives
    $bytes /= pow(1024, $pow);
    // $bytes /= (1 << (10 * $pow));

    return round($bytes, $precision) . ' ' . $units[$pow];
  }
}
