<?php

namespace App\Services\Stats\Tables\Lacrosse;


use App\Services\Stats\Tables\AbstractTable;
use App\Services\Stats\Traits\GameByGameQueryTrait;

/**
 * Class GameByGameGoalkeeping
 * @package App\Services\Stats\Tables\Lacrosse
 */
class GameByGameGoalkeeping extends AbstractTable
{

    use GameByGameQueryTrait;

    protected function build(): array
    {
        return [
            $this->minutes(),                /* min */
            $this->goalApp(),                /* ga */
            $this->gaAvg(),                  /* gaAvg */
            $this->saves(),                  /* sv */
            $this->shutouts(),               /* sho */
            $this->shots(),                  /* sh */
        ];
    }

    public function minutes(bool $format = true)
    {
        return $this->sum('misc', 'minutes', $format);
    }

    private function goalApp(bool $format = true)
    {
        return $this->sum('goalie', 'ga', $format);
    }

    private function gaAvg()
    {
        $min = $this->minutes(false);
        $ga = $this->goalApp(false);

        return number_format(( (float)$min > 0 ? (($ga * 90) / $min) : 0), 2);
    }

    private function saves()
    {
        return $this->sum('goalie', 'saves');
    }

    private function shutouts()
    {
        return $this->sum('goalie', 'shutout');
    }

    private function shots()
    {
        return $this->sum('shots', 'sh');
    }
}
