<?php

namespace App;

use App\Models\Team;
use Illuminate\Database\Seeder;

class NcaaTeamsSeed extends Seeder
{
    const FILE = 'ncaa_data/ncaa_codes.csv';

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $storage = \Storage::disk('local');

        $file = fopen($storage->path(self::FILE), "r");

        while (!feof($file)) {
            $teamData = fgetcsv($file);

            if (!is_array($teamData) || count($teamData) !== 2) {
                $this->command->warn(sprintf('Wrong team data.'));
                continue;
            }

            $teamModel = Team::where('code', '=', $teamData[0])->first();

            if (!$teamModel) {
                $teamModel = new Team();
            }


            $teamModel->code = $teamData[0];
            $teamModel->title = $teamData[1];

            if ($teamModel->save()) {
                $this->command->info(sprintf('Team %s [%s] saved with id [%d]', $teamModel->title, $teamModel->code,
                    $teamModel->id));
            }
        }

        fclose($file);
    }
}
