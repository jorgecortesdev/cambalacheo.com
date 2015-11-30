<?php

namespace App\Console\Commands;

use App\Image;
use App\StatsImage;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class StatsImagesGenerate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'stats:images';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate statistics about images.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $stats = Image::select('file_mime', DB::raw('count(1) as total'))
            ->groupBy('file_mime')
            ->get();

        foreach ($stats as $stat) {
            $stats_image = StatsImage::firstOrCreate(['file_mime' => $stat->file_mime]);
            $stats_image->update(['total' => $stat->total]);
        }
    }
}
