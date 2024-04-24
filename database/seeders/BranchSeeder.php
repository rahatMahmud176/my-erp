<?php

namespace Database\Seeders;

use App\Models\Backend\Branch;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Branch::updateOrCreate([
            'name' => 'Main Branch',
            'slug' => 'main-branch'
        ]);
        Branch::updateOrCreate([
            'name' => 'Jamuna Branch',
            'slug' => 'jamuna-branch'
        ]);
    }
}
