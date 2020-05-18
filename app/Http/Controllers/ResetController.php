<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;

/**
 * Class ResetController
 * @package App\Http\Controllers
 */
class ResetController extends Controller
{
    /**
     *
     */
    public function reset()
    {
        Artisan::call('migrate:fresh --seed');

        $folder = 'products';
        Storage::deleteDirectory($folder);
        Storage::makeDirectory($folder);

        session()->flash('success', 'БД пуста');
        return redirect()->route('home');
    }
}
