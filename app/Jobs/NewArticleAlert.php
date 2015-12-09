<?php

namespace App\Jobs;

use App\Article;
use App\Jobs\Job;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Queue\ShouldQueue;

abstract class NewArticleAlert extends Job implements SelfHandling, ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    protected $article;
    protected $alert;

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

    abstract function setup();

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->setup();
        $this->alert->send($this->article);
    }
}
