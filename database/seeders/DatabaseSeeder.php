<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            ComplaintTypeSeeder::class,
            TreatmentCategorySeeder::class,
            ToothSeeder::class,
            CitySeeder::class,
            RoleSeeder::class,
            ModuleSeeder::class,
            PermissionSeeder::class,
            UserSeeder::class,
            BranchSeeder::class,
            ChairSeeder::class,
            EmploymentSeeder::class,
            PatientSeeder::class,
        ]);
    }
}
