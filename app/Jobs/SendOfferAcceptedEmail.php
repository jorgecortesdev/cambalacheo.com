<?php

namespace App\Jobs;

use App\Jobs\Job;
use App\Offer;
use App\User;
use App\Article;

use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendOfferAcceptedEmail extends Job implements SelfHandling, ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    protected $offer_owner;
    protected $article_owner;
    protected $article;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Offer $offer)
    {
        $this->article_owner = User::find($offer->article->user_id);
        $this->offer_owner = Offer::with('user')
            ->where('article_id', $offer->article_id)
            ->first()
            ->user;
        $this->article = Article::with('user')->find($offer->article_id);
        $this->onQueue('emails');
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Mailer $mailer)
    {
        $offer_owner   = $this->offer_owner;
        $article_owner = $this->article_owner;
        $article       = $this->article;

        // Sender Email
        $mailer->send(
            ['emails.offer.accepted.sender.html', 'emails.offer.accepted.sender.text'],
            [
                'offer_owner'   => $offer_owner,
                'article_owner' => $article_owner,
                'article'       => $article
            ],
            function($message) use ($offer_owner) {
                $message->subject('[Cambalacheo]: ¡En horabuena ' . $offer_owner->name . '!, han aceptado tu oferta.')
                    ->to('cambalacheo.oficial@gmail.com')
                    ->replyTo(config('app.site_email'));
            }
        );

        // Article owner
        $mailer->send(
            ['emails.offer.accepted.owner.html', 'emails.offer.accepted.owner.text'],
            [
                'offer_owner'   => $offer_owner,
                'article_owner' => $article_owner,
                'article'       => $article
            ],
            function($message) use ($article_owner) {
                $message->subject('[Cambalacheo]: ¡En horabuena ' . $article_owner->name . '!, has aceptado una oferta.')
                    ->to('cambalacheo.oficial@gmail.com')
                    ->replyTo(config('app.site_email'));
            }
        );
    }
}
