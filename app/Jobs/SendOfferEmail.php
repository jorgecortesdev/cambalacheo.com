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

class SendOfferEmail extends Job implements SelfHandling, ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    protected $offer;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Offer $offer)
    {
        $this->offer = $offer;
        $this->onQueue('emails');
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Mailer $mailer)
    {
        $offer = $this->offer;
        $mailer->send(
            ['emails.offer.html', 'emails.offer.text'],
            ['offer' => $offer],
            function($message) use ($offer) {
                $message->subject('[Cambalacheo]: ¡En horabuena ' . $offer->article->user->name . '!, has recibido una oferta.')
                    ->to($offer->article->user->email)
                    ->replyTo(config('app.site_email'));
            }
        );
    }
}
