<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class Helpers
{
    public static function getCustomersArray()
    {
        $directories = Storage::directories('/');
        $customers = [];

        foreach ($directories as $directory) {
            $files = File::files($_SERVER['HOME'] . '/Documents/Customers/' . $directory);
            $customers[] = [
                'name' => basename($directory),
                'files' =>  collect($files)->count()
            ];
        }

        return $customers;
    }

    public static function getCustomers()
    {
        $directories = Storage::directories('/');

        foreach ($directories as $directory) {
            $customers[] = basename($directory);
        }

        return $customers;
    }
}
