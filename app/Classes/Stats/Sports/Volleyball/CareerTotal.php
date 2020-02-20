<?php

namespace App\Classes\Stats\Sports\Volleyball;

use App\Models\Player;
use App\Models\PlayerValue;

/**
 * Class CareerTotal
 * @package App\Classes\Stats\Sports
 */
class CareerTotal extends Career
{
    /**
     * Career constructor.
     * @param Player $player
     */
    public function __construct(Player $player)
    {
        parent::__construct($player);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function _getQuery()
    {
        $query = PlayerValue::wherePlayerId($this->player->id);

        return $query->get();
    }


}
