<?php

namespace App;

use Backpack\Settings\app\Models\Setting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingsTableSeeder extends Seeder
{
    /**
     * The settings to add.
     */
    protected $settings = [
        [
            'key' => 'school_codes',
            'name' => 'School Codes',
            'description' => 'All school\'s team codes.',
            'value' => '',
            'field' => '{"name":"codes","label":"Codes","description":"Codes separated with comma","type":"text"}',
            'active' => 1,
        ],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->settings as $index => $setting) {
            $key = $setting['key'];

            if (Setting::where('key', $key)->count()) {
                $this->command->warn(sprintf('Key %s already exists', $key));
                continue;
            }

            $result = DB::table('settings')->insert($setting);

            if (!$result) {
                $this->command->info("Insert failed at record $index.");
                continue;
            }
        }
    }
}
