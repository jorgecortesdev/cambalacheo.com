<?php

namespace App\Jobs;

use App\Jobs\Job;
use App\Offer;
use App\User;
use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendOfferReplayEmail extends Job implements SelfHandling, ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    protected $offer;
    protected $replay;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Offer $replay)
    {
        $this->replay = $replay;
        $this->offer = Offer::with('user')
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
        $replay = $this->replay;
        $offer  = $this->offer;
        $mailer->send(
            ['emails.offer.replay.html', 'emails.offer.replay.text'],
            ['offer' => $offer, 'replay' => $replay],
            function($message) use ($offer) {
                $message->subject('[Cambalacheo]: ¡En horabuena ' . $offer->user->name . '!, has recibido una respuesta.')
                    ->to($offer->user->email)
                    ->replyTo(config('app.site_email'));
            }
        );
    }
}
