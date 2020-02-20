<?php

namespace App\Classes\Stats;

/**
 * Class Stats
 * @package App\Classes\Stats
 *
 * @method highsFootballValues()
 * @method baseballPitchingValues(\App\Models\Player $player, \App\Models\Season $season)
 */
class Stats
{
    protected static $availableClasses = [

        'footballGame' => \App\Classes\Stats\Sports\FootballGame::class,
        'footballTotalCareer' => \App\Classes\Stats\Sports\Football\CareerTotal::class,
        'footballCareer' => \App\Classes\Stats\Sports\Football\Career::class,

        'basketballCareer' => \App\Classes\Stats\Sports\Basketball\Career::class,
        'basketballGame' => \App\Classes\Stats\Sports\BasketballGame::class,

        'soccerGame' => \App\Classes\Stats\Sports\SoccerGame::class,
        'lacrosseGame' => \App\Classes\Stats\Sports\LacrosseGame::class,

        'highs' => \App\Classes\Stats\Sports\Highs::class,
        'career' => \App\Classes\Stats\Sports\Career::class,

        'iceHockeyCareer' => \App\Classes\Stats\Sports\IceHockey\Career::class,

        'volleyballCareer' => \App\Classes\Stats\Sports\Volleyball\Career::class,
        'volleyballTotalCareer' => \App\Classes\Stats\Sports\Volleyball\CareerTotal::class,
        'volleyballGame' => \App\Classes\Stats\Sports\VolleyballGame::class,

//        'baseballTotalCareer' => \App\Classes\Stats\Sports\Baseball\CareerTotal::class,
        'baseballGame' => \App\Classes\Stats\Sports\BaseballGame::class,

//        'softballTotalCareer' => \App\Classes\Stats\Sports\Softball\CareerTotal::class,
        'softballGame' => \App\Classes\Stats\Sports\SoftballGame::class,
    ];

    /**
     * @param $method
     * @param $args
     *
     * @return mixed
     * @throws \Exception
     */
    public function __call($method, $args)
    {
        list($sport, $method) = $this->_parseSport($method);

        if ($sport && $method) {
            return (new $sport(...$args))->get($method);
        } else {
            throw new \Exception("Can not execute method [$method] in [" . self::class . "]", 1);
        }
    }

    /**
     * @param string $method
     *
     * @return array
     */
    private function _parseSport(string $method)
    {
        $class = null;

        foreach (self::$availableClasses as $sport => $availableClass) {
            if (starts_with($method, $sport)) {
                $class = $availableClass;
                $method = camel_case(str_after($method, $sport));
                break;
            }
        }

        return [$class, $method];
    }
}
