<?php

use App\Subcrible;
use Illuminate\Database\Seeder;

class SubcribleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Subcrible::class,30)->create();
    }
}
