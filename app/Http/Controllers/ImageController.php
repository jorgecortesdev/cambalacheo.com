<?php

namespace App\Http\Controllers;

use Storage;
use Image;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class ImageController extends Controller
{
    /**
     * Imagen default.
     *
     * @var string
     */
    protected $defaultImage;

    public function __construct()
    {
        $this->middleware('image.cache.headers');

        $this->defaultImage = public_path('img/default.png');
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
     *
     * @return Intervention\Image\Image
     */
    public function getArticleImage($article_id, $image_id, $image_size)
    {
        $image_filename = $this->buildImagePath($article_id, $image_id);
        return $this->buildImage($image_filename, $image_size);
    }

    /**
     * Regresa la imagen default en el tamaño especificado.
     *
     * @param  string
     *
     * @return Intervention\Image\Image
     */
    public function getDefault($image_size)
    {
        $image_filename = $this->defaultImage;
        return $this->buildImage($image_filename, $image_size);
    }

    /**
     * Construye el path de la imagen dado el articulo y la imagen id.
     *
     * @param  integer
     * @param  integer
     * @return string
     */
    protected function buildImagePath($article_id, $image_id)
    {
        $image_filename = $this->defaultImage;

        $image_path = "articles/images/{$article_id}/{$image_id}";
        if (Storage::exists($image_path)) {
            $image_filename = storage_path("app/{$image_path}");
        }

        return $image_filename;
    }

    /**
     * Redimensiona y corta la imagen dada con el tamaño especificado.
     *
     * @param  Intervention\Image\Image
     * @param  string
     *
     * @return Intervention\Image\Image
     */
    protected function resizeAndCropImage(\Intervention\Image\Image $image, $size)
    {
        switch ($size) {
            case 'thumbnail':
                $image = $image->fit(50, 50, function ($constraint) {
                    $constraint->upsize();
                });
                break;
            case 'list':
                $image = $image->fit(90, 90, function ($constraint) {
                    $constraint->upsize();
                });
                break;
            case 'profile':
                $image = $image->fit(250, 250, function ($constraint) {
                    $constraint->upsize();
                });
                break;
            default:
                $image = $image->fit(600, 600, function ($constraint) {
                    $constraint->upsize();
                });
                break;
        }

        return $image;
    }

    /**
     * Construye la imagen y la attacha a un nuevo response.
     *
     * @param  string
     * @param  string
     * @return Illuminate\Support\Facades\Response
     */
    protected function buildImage($filename, $size)
    {
        $image = Image::make($filename);
        $image = $this->resizeAndCropImage($image, $size);
        $image->encode('png', 90);

        $data   = $image->getEncoded();
        $length = strlen($data);

        $response = \Response::make($data);
        $response->header('Content-Type', 'image/png');
        $response->header('Content-Length', $length);
        $response->header('Last-Modified', gmdate('D, d M Y H:i:s T', filemtime($filename)));

        return $response;
    }
}
