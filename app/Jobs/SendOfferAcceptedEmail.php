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

class SendOfferAcceptedEmail extends Job implements SelfHandling, ShouldQueue
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
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Mailer $mailer)
    {
        $mailer->send(
            'emails.offer_accepted',
            ['offer' => $this->offer],
            function($message) {
                $message->subject('Contacto cambalacheo')
                    ->to('cambalacheo.oficial@gmail.com')
                    ->replyTo('noreplay@cambalacheo.com');
            }
        );
    }
}
