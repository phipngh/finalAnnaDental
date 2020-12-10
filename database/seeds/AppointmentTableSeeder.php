<?php

use App\Appointment;
use Illuminate\Database\Seeder;

class AppointmentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Appointment::class,100)->create();
    }
}
