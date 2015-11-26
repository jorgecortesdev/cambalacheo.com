<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Helpers\ArticleImage;
use App\Http\Controllers\Controller;

class ImageController extends Controller
{
    public function __construct()
    {
        $this->middleware('image.cache.headers');
    }

    /**
     * Devuelve la image de un articulo para el $article_id proporcionado.
     *
     * Ya que el articulo tiene varias imagenes asociadas, se puede especificar
     * que imagen se ocupa regresar mediante el parametro $image_id.
     *
     * Ademas las imagenes pueden tener distintos tamaños, esto puede indicarse
     * por medio del parametro $image_size.
     *
     * @param  integer
     * @param  integer
     * @param  string
     * @param  App\Helpers\ArticleImage
     * @return Intervention\Image\Image
     */
    public function getArticleImage($article_id, $image_id, $image_size, ArticleImage $articleImage)
    {
        $image_filename = $articleImage->buildImagePath($article_id, $image_id);
        return $articleImage->buildImage($image_filename, $image_size);
    }

    /**
     * Regresa la imagen default en el tamaño especificado.
     *
     * @param  string
     * @param  App\Helpers\ArticleImage
     * @return Intervention\Image\Image
     */
    public function getDefault($image_size, ArticleImage $articleImage)
    {
        $image_filename = $articleImage->getDefaultImagePath();
        return $articleImage->buildImage($image_filename, $image_size);
    }
}
