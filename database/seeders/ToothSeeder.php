<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tooth;
use Carbon\Carbon;

class ToothSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $positions = ['Upper Right', 'Upper Left', 'Lower Left', 'Lower Right'];
        $numbers = [1, 2, 3, 4, 5, 6, 7, 8];

        $combinations = [];

        foreach ($positions as $key => $position) {
            foreach ($numbers as $number) {
                $combinations[] = [
                    'position' => $position,
                    'quadrant' => $key + 1,
                    'number' => $number,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ];
            }
        }

        Tooth::insert($combinations);
    }
}
