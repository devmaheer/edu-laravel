<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TreatmentCategory;
use Carbon\Carbon;
use App\Helper\Helper;

class TreatmentCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [
                'uid' => Helper::getUniqueFormatedId('TC-'),
                'name' => 'Diagnosis',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'uid' => Helper::getUniqueFormatedId('TC-'),
                'name' => 'Extraction',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'uid' => Helper::getUniqueFormatedId('TC-'),
                'name' => 'Root Canal',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'uid' => Helper::getUniqueFormatedId('TC-'),
                'name' => 'Impaction',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'uid' => Helper::getUniqueFormatedId('TC-'),
                'name' => 'Restoration',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'uid' => Helper::getUniqueFormatedId('TC-'),
                'name' => 'Gum Care',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'uid' => Helper::getUniqueFormatedId('TC-'),
                'name' => 'Caps/Crowns',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'uid' => Helper::getUniqueFormatedId('TC-'),
                'name' => 'Complete Dentures',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'uid' => Helper::getUniqueFormatedId('TC-'),
                'name' => 'Laser',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'uid' => Helper::getUniqueFormatedId('TC-'),
                'name' => 'Child Care',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        ];

        TreatmentCategory::insert($categories);
    }
}
