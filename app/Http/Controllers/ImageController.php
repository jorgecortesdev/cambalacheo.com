<?php

namespace App\Http\Controllers;

use Storage;
use Image;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class ImageController extends Controller
{

    public function getArticleImage($image_id, $image_size, $number = null)
    {
        $image_filename = public_path('img/default.gif');
        $number = empty($number) ? 1 : $number;

        if (Storage::exists($image_id . "-{$number}")) {
            $image_filename = storage_path('app/' . $image_id . "-{$number}");
        }

        $img = Image::make($image_filename);

        switch ($image_size) {
            case 'thumbnail':
                $img = $img->fit(50, 50, function ($constraint) {
                    $constraint->upsize();
                });
                break;
            case 'list':
                $img = $img->fit(115, 115, function ($constraint) {
                    $constraint->upsize();
                });
                break;                
            case 'profile':
                $img = $img->fit(250, 250, function ($constraint) {
                    $constraint->upsize();
                }); 
                break;        
            case 'carousel':
                $img = $img->fit(125, 125, function ($constraint) {
                    $constraint->upsize();
                });
                break;  
            default:
                # code...
                break;
        }

        return $img->response();
    }
}
