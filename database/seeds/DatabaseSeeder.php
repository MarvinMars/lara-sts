<?php

use App\NcaaTeamsSeed;
use App\SettingsTableSeeder;
use App\SportBlocksSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(SportBlocksSeeder::class);
        $this->call(SettingsTableSeeder::class);
        $this->call(NcaaTeamsSeed::class);
    }
}
