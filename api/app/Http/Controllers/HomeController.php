<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class HomeController extends Controller
{
    //
    public function index()
    {

        $url = public_path() . '/images';
        $photos = collect([]);
        $files = File::allFiles($url);

        foreach ($files as $file) {
            $photos->push($file->getFilename());
        }

        return view('welcome', ['photos' => $photos]);
    }
}
