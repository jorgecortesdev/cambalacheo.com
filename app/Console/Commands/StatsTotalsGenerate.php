<?php

namespace App\Console\Commands;

use App\StatsTotal;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class StatsTotalsGenerate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'stats:totals
        {table  : La tabla a utilizar}
        {column : La columna a utilizar}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Genera estadisticas de los totales';

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
        $table  = $this->argument('table');
        $column = $this->argument('column');

        $stats = DB::table($table)
            ->select($column, DB::raw('count(1) as total'))
            ->groupBy($column)
            ->get();

        StatsTotal::where([
                'table'  => $table,
                'column' => $column
            ])->delete();

        foreach ($stats as $stat) {
            $statistic = StatsTotal::firstOrCreate([
                    'table'  => $table,
                    'column' => $column,
                    'value'  => $stat->{$column}
                ]);
            $statistic->update(['total' => $stat->total]);
        }
    }
}
