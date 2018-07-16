<?php

use Illuminate\Database\Seeder;
use App\RunPeetyPoint;


class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        RunPeetyPoint::truncate();

        $RunPeetyPointQuantity = 2000;

        factory(RunPeetyPoint::class,$RunPeetyPointQuantity)->create();
    }
}
