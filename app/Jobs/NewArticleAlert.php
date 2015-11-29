<?php

namespace App\Jobs;

use App\Article;
use App\Jobs\Job;
use Cambalacheo\Social\Facebook\Alert;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewArticleAlert extends Job implements SelfHandling, ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    protected $article;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Article $article, $queue)
    {
        $this->article = $article;
        $this->onQueue($queue);
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Alert $alert)
    {
        $alert->send($this->article);
    }
}
