<?php

namespace App\Helpers;

use File;
use Image;
use Storage;
use App\Image as AppImage;
use App\Article;
use App\Helpers\ArticleImage;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ArticleImage
{
    /**
     * Imagen default.
     *
     * @var string
     */
    protected $defaultImagePath;

    public function __construct()
    {
        $this->defaultImagePath = public_path('img/default.png');
    }

    /**
     * Regresa el path de la imagen default.
     *
     * @return string
     */
    public function getDefaultImagePath()
    {
        return $this->defaultImagePath;
    }

    /**
     * Construye el path de la imagen dado el articulo y la imagen id.
     *
     * @param  integer
     * @param  integer
     * @return string
     */
    public function buildImagePath($article_id, $image_id)
    {
        $image_filename = $this->defaultImagePath;

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
    public function resizeAndCropImage(\Intervention\Image\Image $image, $size)
    {
        $width = 0;

        switch ($size) {
            case 'thumbnail': $width = 50;   break;
            case 'list':      $width = 90;   break;
            case 'profile':   $width = 250;  break;
            case 'slider':    $width = 600;  break;
            case 'zoom':      $width = 1200; break;
        }

        if ($width) {
            $image = $image->fit($width, $width, function ($constraint) {
                $constraint->upsize();
            });
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
    public function buildImage($filename, $size)
    {
        $image = Image::make($filename)->orientate();
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

    /**
     * Procesa un arrigle de imagenes subidas.
     *
     * @param  Article          $article
     * @param  UploadedFile[]   $files
     * @return App\Helpers\ArticleImage
     */
    public function processUploadImages(Article $article, array $files)
    {
        foreach($files as $file) {
            if (empty($file)) {
               continue;
            }
            $this->create($article, $file);
        }
        return $this;
    }

    /**
     * Crea una nueva imagen al articulo dado y la guarda en el sistema
     * de archivos.
     *
     * @param  Article      $article
     * @param  UploadedFile $file
     * @return App\Helpers\ArticleImage
     */
    public function create(Article $article, UploadedFile $file)
    {
        $image = $article->images()->create([
            'article_id' => $article->id,
            'file_size'  => $file->getClientSize(),
            'file_mime'  => $file->getClientMimeType(),
            'user_id'    => $article->user_id,
        ]);
        $this->storeImage($file, $article, $image);
    }

    /**
     * Destruye una imagen de la base de datos y la borra del sistema
     * de archivos.
     *
     * @param  Article $article
     * @param  array   $images
     * @return App\Helpers\ArticleImage
     */
    public function destroy(Article $article, array $images)
    {
        foreach ($images as $image_id) {
            if (empty($image_id)) {
               continue;
            }
            AppImage::destroy($image_id);
            $this->deleteImage($article, $image_id);
        }
    }

    /**
     * Guarda fisicamente la imagen del articulo dado.
     *
     * @param  Symfony\Component\HttpFoundation\File\UploadedFile $file
     * @param  App\Article  $article
     * @param  App\Image    $image
     * @return App\Helpers\ArticleImage
     */
    public function storeImage(UploadedFile $file, Article $article, AppImage $image)
    {
        $imagePath = 'articles/images' . '/' . $article->id . '/' . $image->id;
        Storage::disk('local')->put($imagePath, File::get($file));
        $this->resizeImage(storage_path() . '/app/' . $imagePath, 2048, 2048);
    }

    /**
     * Redimensiona la imagen proporcionada al tamano especificado,
     * matiene el ratio y evita que si la imagen es mas pequena se agrande.
     *
     * @param  string $file
     * @param  integer $width
     * @param  integer $height
     * @return void
     */
    public function resizeImage($file, $width, $height)
    {
        Image::make($file)->orientate()
            ->resize($width, $height, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })
            ->save($file);
    }

    /**
     * Borra fisicamente la imagen del articulo.
     *
     * @param  Article $article
     * @param  integer $image_id
     * @return App\Helpers\ArticleImage
     */
    public function deleteImage(Article $article, $image_id)
    {
        Storage::delete(
            'articles/images' . '/' . $article->id . '/' . $image_id
        );
    }
}