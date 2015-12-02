<?php

namespace App\Console\Commands;

use App\User;
use App\StatsUsersProvider;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class StatsUsersProvidersGenerate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'stats:users-providers';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate statistics for users by provider';

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
        $stats = User::select('provider', DB::raw('count(1) as total'))
            ->groupBy('provider')
            ->get();

        foreach ($stats as $stat) {
            $stats_users = StatsUsersProvider::firstOrCreate(['provider' => $stat->provider]);
            $stats_users->update(['total' => $stat->total]);
        }
    }
}
