<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VotingStatusSeeder extends Seeder
{
    public function run()
    {
        DB::table('voting_statuses')->insert([
            ['name' => 'registration_open', 'is_active' => true],
            ['name' => 'registration_closed', 'is_active' => false],
        ]);
    }
}