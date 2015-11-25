<?php

namespace App\Http\Requests;

use App\Article;
use App\Http\Requests\Request;

class ArticleRequest extends Request
{
    protected $rules;
    protected $messages;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $this->buildRules();
        return $this->rules;
    }

    /**
     * Messages
     *
     * @return array
     */
    public function messages()
    {
        return $this->messages;
    }

    /**
     * Construye las reglas y los mensajes.
     *
     * @return void
     */
    protected function buildRules()
    {
        $this->rules = [
            'title'        => 'required|min:5|max:255',
            'category_id'  => 'required',
            'condition_id' => 'required',
            'description'  => 'required|min:5|max:255',
            'request'      => 'required|min:5|max:255',
        ];

        $this->messages = [
            'required'    => 'Este campo es requerido.',
            'title.max'   => 'No debe ser mayor a :max caracteres.',
            'title.min'   => 'No debe ser menor a :min caracteres.',
            'request.min' => 'No debe ser menor a :min caracteres.',
        ];

        // El request trae imagenes nuevas o va a remover imagenes
        $image_files   = $this->file('image');
        $remove_images = $this->input('remove_images', []);

        $validate_images = true;
        $article_id      = $this->route()->getParameter('article_id');

        if ($article_id) {
            $article         = Article::findOrFail($article_id);
            $validate_images = $article->images->count() < count($remove_images);
        }

        if ($validate_images) {
            foreach (range(0, count($image_files) - 1) as $index) {
                $this->rules['image.' . $index]               = 'required|image';
                $this->messages['image.' . $index . '.image'] = 'Una de las imagenes no es válida.';
            }
        }
    }
}
