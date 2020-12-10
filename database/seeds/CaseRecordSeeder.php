<?php

use App\CaseRecord;
use Illuminate\Database\Seeder;

class CaseRecordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(CaseRecord::class,100)->create();
    }
}
