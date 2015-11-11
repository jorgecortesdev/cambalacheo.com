<?php

namespace App\Jobs;

use App\Jobs\Job;
use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendContactEmail extends Job implements SelfHandling, ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    protected $name;
    protected $email;
    protected $message;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->name    = $data['name'];
        $this->email   = $data['email'];
        $this->message = $data['message'];

        $this->onQueue('emails');
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Mailer $mailer)
    {
        $data = [
            'name'  => $this->name,
            'email' => $this->email,
        ];
        $data['umessage'] = explode("\n", $this->message);

        $mailer->send(
            ['emails.contact.html', 'emails.contact.text'],
            $data,
            function($message) use ($data) {
                $message->subject('[Cambalacheo]: Contacto cambalacheo')
                    ->to('cambalacheo.oficial@gmail.com')
                    ->replyTo(config('app.site_email'));
            }
        );
    }
}
