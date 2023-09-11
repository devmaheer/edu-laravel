<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Chair;
use App\Helper\Helper;
use Carbon\Carbon;

class ChairSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $chairs = [
            [
                'branch_id' => 1,
                'uid' => Helper::getUniqueId(),
                'type' => 'Regular',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'branch_id' => 2,
                'uid' => Helper::getUniqueId(),
                'type' => 'VIP',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            // Add more chair records...
        ];

        // Insert the chairs into the database
        Chair::insert($chairs);
    }
}
