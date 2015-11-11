<?php

namespace App\Http\Controllers;

use Auth;

use App\Question;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class QuestionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create($article_id)
    {
        $article = \App\Article::find($article_id);
        return view('questions.create', compact('article'));
    }

    public function replay(Request $request)
    {
        $rules = [
            'description' => 'required|min:10|max:255',
        ];
        $validator = \Validator::make($request->all(), $rules);
        if (!$validator->fails()) {
            $question = new Question($request->all());
            $question->user_id = Auth::user()->id;
            $question->save();

            $this->dispatch(new \App\Jobs\SendQuestionReplayEmail($question));
        }
        return redirect('trades/' . $request->article_id);
    }

    public function store(Request $request)
    {
        $messages = [
            'required'        => 'Este campo es requerido.',
            'description.max' => 'No debe ser mayor a :max caracteres.',
            'description.min' => 'No debe ser menor a :min caracteres.',
        ];
        $rules = [
            'description' => 'required|min:10|max:255',
        ];

        $validator = \Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect('/trades/question/' . $request->article_id)
                ->withErrors($validator)
                ->withInput();
        }

        $question = new Question($request->all());
        $question->user_id = Auth::user()->id;
        $question->save();

        $this->dispatch(new \App\Jobs\SendQuestionEmail($question));

        return redirect('trades/' . $question->article_id);
    }
}
