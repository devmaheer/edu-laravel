<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Patient;
use App\Helper\Helper;
use Carbon\Carbon;

class PatientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $patients = [
            [
                'partner_id' => 2,
                'businessunit_id' => 3,
                'branch_id' => 1,
                'uid' => Helper::getUniqueFormatedId('P-'),
                'first_name' => 'Rahul',
                'last_name' => 'Sharma',
                'dob' => Carbon::parse('1990-01-01')->format('Y-m-d'),
                'blood_group' => 'A+',
                'contact_no' => '1234567890',
                'email' => 'rahul.sharma@example.com',
                'address' => '456 Park Street',
                'state' => 'Maharashtra',
                'country' => 'India',
                'pin_code' => '400001',
                'patient_group' => 'EHS',
                'referral' => 'Direct Walk-in',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'partner_id' => 2,
                'businessunit_id' => 3,
                'branch_id' => 2,
                'uid' => Helper::getUniqueFormatedId('P-'),
                'first_name' => 'Priya',
                'last_name' => 'Patel',
                'dob' => Carbon::parse('1995-05-10')->format('Y-m-d'),
                'blood_group' => 'B-',
                'contact_no' => '9876543210',
                'email' => 'priya.patel@example.com',
                'address' => '789 Garden Lane',
                'state' => 'Gujarat',
                'country' => 'India',
                'pin_code' => '380001',
                'patient_group' => 'Clinic',
                'referral' => 'Other Dentist',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            // Add more patient records...
        ];

        Patient::insert($patients);
    }
}
