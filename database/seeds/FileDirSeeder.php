<?php

use Illuminate\Database\Seeder;

class FileDirSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 1 ; $i < 131; $i++){
            \File::makeDirectory(public_path()."/storage/files/1/CaseRecord/".$i);
        }
    }
}
