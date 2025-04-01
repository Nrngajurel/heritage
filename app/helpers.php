<?php

use App\Settings\GeneralSettings;

if (!function_exists('setting')) {
    function setting()
    {

        return app( GeneralSettings::class);
    }
}
