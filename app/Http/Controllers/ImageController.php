<?php

namespace App\Http\Controllers;

use Storage;
use Image;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class ImageController extends Controller
{
    public function __construct()
    {
        $this->middleware('image.cache.headers');
    }

    public function getArticleImage($article_id, $image_id, $image_size)
    {
        $image_filename = public_path('img/default.gif');

        $images_path = "articles/images/{$article_id}/{$image_id}";

        if (Storage::exists("articles/images/{$article_id}/{$image_id}")) {
            $image_filename = storage_path("app/articles/images/{$article_id}/{$image_id}");
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
                $img = $img->fit(600, 600, function ($constraint) {
                    $constraint->upsize();
                });
                break;
        }

        $img->encode('png', 90);

        $data   = $img->getEncoded();
        $length = strlen($data);

        $response = \Response::make($data);
        $response->header('Content-Type', 'image/png');
        $response->header('Content-Length', $length);
        $response->header('Last-Modified', gmdate('D, d M Y H:i:s T', filemtime($image_filename)));

        return $response;
    }

    public function getDefault($image_size)
    {
        $image_filename = public_path('img/default.gif');

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
