<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Branch;
use App\Helper\Helper;
use Carbon\Carbon;

class BranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $branches = [
            [
                'partner_id' => 2,
                'businessunit_id' => 3,
                'city_id' => 6,
                'country_id' => null,
                'uid' => Helper::getUniqueId(),
                'ssn' => '123456789',
                'pan' => 'ABCDE1234F',
                'name' => 'Branch 1',
                'name_per_incorporation' => 'Branch 1 (Per Incorporation)',
                'chief' => 'John Doe',
                'email' => 'branch1@example.com',
                'postal_address' => 'Branch 1 Postal Address',
                'building_name' => 'Building 1',
                'locality_or_colony' => 'Locality/Colony 1',
                'state' => 'State 1',
                'cin_number' => 'CIN123456',
                'contact_number' => '1234567890',
                'pin_code' => '123456',
                'door_number' => '1A',
                'plot_number' => '123',
                'road_number' => 'Road 1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'partner_id' => 2,
                'businessunit_id' => 3,
                'city_id' => 7,
                'country_id' => null,
                'uid' => Helper::getUniqueId(),
                'ssn' => '987654321',
                'pan' => 'FGHIJ5678K',
                'name' => 'Branch 2',
                'name_per_incorporation' => 'Branch 2 (Per Incorporation)',
                'chief' => 'Jane Smith',
                'email' => 'branch2@example.com',
                'postal_address' => 'Branch 2 Postal Address',
                'building_name' => 'Building 2',
                'locality_or_colony' => 'Locality/Colony 2',
                'state' => 'State 2',
                'cin_number' => 'CIN654321',
                'contact_number' => '9876543210',
                'pin_code' => '654321',
                'door_number' => '2B',
                'plot_number' => '456',
                'road_number' => 'Road 2',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            // Add more branch records...
        ];

        Branch::insert($branches);
    }
}
