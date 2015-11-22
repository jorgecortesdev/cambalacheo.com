<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class FakerSeeder extends Seeder
{
    protected $toTruncate = ['users', 'articles'];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        foreach ($this->toTruncate as $table) {
            DB::table($table)->truncate();
        }

        $this->call(UsersTableSeeder::class);
        $this->call(ArticlesTableSeeder::class);
        $this->call(ImagesTableSeeder::class);

        Model::reguard();
    }
}
