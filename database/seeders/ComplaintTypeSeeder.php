<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ComplaintType;
use Carbon\Carbon;
use App\Helper\Helper;

class ComplaintTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = [
            [
                'uid' => Helper::getUniqueID(),
                'name' => 'Tooth Decay',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'uid' => Helper::getUniqueID(),
                'name' => 'Tooth Ache',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'uid' => Helper::getUniqueID(),
                'name' => 'Pus Discharge',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'uid' => Helper::getUniqueID(),
                'name' => 'Bad Breath',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'uid' => Helper::getUniqueID(),
                'name' => 'Irregular Teeth',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'uid' => Helper::getUniqueID(),
                'name' => 'Discolored Teeth',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'uid' => Helper::getUniqueID(),
                'name' => 'Trauma',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
        ];

        ComplaintType::insert($types);
    }
}
