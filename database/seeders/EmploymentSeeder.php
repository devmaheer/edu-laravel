<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use App\Models\User;
use App\Models\UserDetail;
use App\Helper\Helper;
use Carbon\Carbon;

class EmploymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $employments = [
            [
                'partner_id' => 2,
                'businessunit_id' => 3,
                'branch_id' => 1,
                'name' => 'Ethan Hunt',
                'email' => 'ethan.hunt@kosmo.com',
                'email_verified_at' => now(),
                'password' => Hash::make(env('SYSTEM_ADMIN_PASSWORD')),
                'remember_token' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'partner_id' => 2,
                'businessunit_id' => 3,
                'branch_id' => 2,
                'name' => 'Aishwarya Sharma',
                'email' => 'aishwarya.sharma@kosmo.com',
                'email_verified_at' => now(),
                'password' => Hash::make(env('SYSTEM_ADMIN_PASSWORD')),
                'remember_token' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            // Add more user records...
        ];

        foreach ($employments as $key => $employment) {
            $user = User::create($employment);
            UserDetail::create([
                'user_id' => $user->id,
                'start_date' => Carbon::now()->format('Y-m-d'),
                'contact_number' => Helper::generateRandomPhoneNumber()
            ]);
            Role::find(4)->users()->attach($user);
        }
    }
}
