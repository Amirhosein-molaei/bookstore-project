<?php

namespace App\Http\Controllers\Admin\Content;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ImageBannerController extends Controller
{
    public function upload($image)
    {
        $fileNameImage = generateFileName($image->getClientOriginalName());
        $image->move(public_path(env('BANNER_IMAGE')),$fileNameImage);
        return [ 'fileNameImage' => $fileNameImage];
    }
}
