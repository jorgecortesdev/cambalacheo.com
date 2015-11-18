<?php

namespace App\Jobs;

use App\Jobs\Job;
use App\Question;
use App\User;
use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendQuestionReplayEmail extends Job implements SelfHandling, ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    protected $question;
    protected $replay;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Question $replay)
    {
        $this->replay   = $replay;
        $this->question = Question::with('user')
            ->where('article_id', $replay->article_id)
            ->orderBy('id', 'desc')
            ->skip(1)
            ->take(1)
            ->first();
        $this->onQueue('emails');
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Mailer $mailer)
    {
        $replay   = $this->replay;
        $question = $this->question;
        $mailer->send(
            ['emails.question.replay.html', 'emails.question.replay.text'],
            ['question' => $question, 'replay' => $replay],
            function($message) use ($question) {
                $message->subject('[Cambalacheo]: ¡En horabuena ' . $question->user->name . '!, has recibido una respuesta.')
                    ->to($question->user->email)
                    ->replyTo(config('app.site_email'));
            }
        );
    }
}
