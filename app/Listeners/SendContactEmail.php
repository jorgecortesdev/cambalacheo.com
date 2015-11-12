<?php

namespace App\Listeners;

use App\Events\ContactSent;
use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\DispatchesJobs;

class SendContactEmail
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
     * @param  ContactSent  $event
     * @return void
     */
    public function handle(ContactSent $event)
    {
        $this->dispatch(
            new \App\Jobs\SendContactEmail($event->data)
        );
    }
}
