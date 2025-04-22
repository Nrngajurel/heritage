<?php

use App\Settings\GeneralSettings;

if (!function_exists('setting')) {
    function setting()
    {

        return app( GeneralSettings::class);
    }
}


if (!function_exists('formattedNumber')) {
    function formattedNumber($number) {
        $suffixes = ['', 'K', 'M', 'B', 'T'];
        $suffixIndex = 0;
        
        while ($number >= 1000 && $suffixIndex < count($suffixes) - 1) {
            $number /= 1000;
            $suffixIndex++;
        }
        
        return number_format($number, 1) . $suffixes[$suffixIndex];
    }
}