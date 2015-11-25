<?php

namespace App\Helpers;

use File;
use Storage;
use App\Image;
use App\Article;
use App\Helpers\ArticleImage;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ArticleImage
{
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
            Image::destroy($image_id);
            $this->deleteImage($article, $image_id);
        }
    }

    /**
     * Guarda fisicamente la imagen del articulo dado.
     *
     * @param  UploadedFile $file
     * @param  Article      $article
     * @param  Image        $image
     * @return App\Helpers\ArticleImage
     */
    public function storeImage(UploadedFile $file, Article $article, Image $image)
    {
        Storage::disk('local')->put(
            'articles/images' . '/' . $article->id . '/' . $image->id,
            File::get($file)
        );
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