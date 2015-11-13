<?php

namespace App\Listeners;

use App\Events\OfferStore;
use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\DispatchesJobs;

class SendOfferEmail
{
    use DispatchesJobs;

    protected $mailer;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    /**
     * Handle the event.
     *
     * @param  OfferStore  $event
     * @return void
     */
    public function handle(OfferStore $event)
    {
        $this->dispatch(
            new \App\Jobs\SendOfferEmail($event->offer)
        );
    }
}
