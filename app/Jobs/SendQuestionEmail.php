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

class SendQuestionEmail extends Job implements SelfHandling, ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    protected $question;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Question $question)
    {
        $this->question = $question;
        $this->onQueue('emails');
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Mailer $mailer)
    {
        $question = $this->question;
        $mailer->send(
            ['emails.question.html', 'emails.question.text'],
            ['question' => $question],
            function($message) use ($question) {
                $message->subject('[Cambalacheo]: ¡En horabuena ' . $question->article->user->name . '!, has recibido una pregunta.')
                    ->to('cambalacheo.oficial@gmail.com')
                    ->replyTo(config('app.site_email'));
            }
        );
    }
}
