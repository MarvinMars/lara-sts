<?php

namespace App\Transformers;

use Illuminate\Support\Collection;
use App\Models\Game;
use Illuminate\Support\Facades\Redis;

trait season
{
    /**
     * @var
     */
    protected $available_values;

    /**
     * @var $game
     *  for calculate values in db
     */
    protected $game;

    /**
     * @var $game
     *  for calculate values in db
     */
    protected $team;

    /**
     * @var $highs
     *  for Game Highs table
     */
    protected $highs = [];

    /**
     * @var $lows
     *  for Game Lows table
     */
    protected $lows = [];

    /**
     * @var $totals
     * for Game-by-Game tables
     */
    protected $totals = [];

    /**
     * @var $data
     */
    protected $data = [];

    /**
     * @var $keys
     *  foreach helper
     */
    protected $keys  = [];

    /**
     * @param string $game_id
     * @param string $team
     * @param array $available_values
     */
    protected function setValues(string $game_id , string $team , array $available_values )
    {
        $this->team = $team;
        $this->available_values = $available_values;
        $this->game = Game::where('gameid',  $game_id )->get()->first();

        if( $this->game ){
            $this->data = $this->game->playerValues->groupBy('group');
        }
    }

    /**
     * @return array
     */
    protected function getTotals() : array
    {
        if(!$this->game){
            return [];
        }

        $redis = Redis::get( $this->team.':totals:'.$this->game->id);

        if( $redis ){
            return json_decode($redis, TRUE);
        } else {
            foreach ($this->data as $key => $category) {
                if( in_array( $key , $this->available_values ) ) {
                    foreach ( $category as $val ){
                        $this->totals[$key][$val['key']] = isset( $this->totals[$key][$val['key']] ) ? (float)$this->totals[$key][$val['key']] + (float)$val['value'] : (float)$val['value'];
                    }
                }
            }

            if(!empty($this->totals)){
                Redis::set(  $this->team.':totals:'.$this->game->id , json_encode($this->totals));
            }

            return $this->highs;
        }

    }

    /**
     * @return array
     */
    protected function getHighs() : array
    {
        if(!$this->game){
            return [];
        }

        $redis = Redis::get(  $this->team.':highs:'.$this->game->id);

        if( $redis ){
            return json_decode($redis , TRUE);
        } else {
            foreach ($this->data as $key => $category) {
                if( in_array( $key , $this->available_values ) ) {
                    foreach ( $category as $val ){
                        if( isset($val->player->team->shortcode ) && $val->player->team->shortcode == $this->team ){
                            if( (!isset( $this->highs[$key][$val['key']]) || (float)$this->highs[$key][$val['key']]['value'] < (float)$val['value']) && (float)$val['value'] != 0 ){
                                $this->highs[$key][$val['key']] = [
                                    'value' => (float)$val['value'],
                                    'opponent' => $val->game->opponent_name ? $val->game->opponent_name : '',
                                    'player' => $val->player->name ? $val->player->name : '',
                                    'date' => $val->game->date ? $val->game->date : '',
                                    'game' => $this->game->id,
                                ];
                            }
                        }
                    }
                }
            }

            if(!empty($this->highs)) {
                Redis::set($this->team . ':highs:' . $this->game->id, json_encode($this->highs));
            }
            return $this->highs;
        }
    }

    /**
     * @return array
     */
    protected function getLows() : array
    {
        if(!$this->game){
            return [];
        }

        $redis = Redis::get(  $this->team.':lows:'.$this->game->id);

        if( $redis ){
            return json_decode($redis , TRUE);
        } else {
            foreach ($this->data as $key => $category) {
                if( in_array( $key , $this->available_values ) ) {
                    foreach ( $category as $val ){
                        if( isset($val->player->team->shortcode ) && $val->player->team->shortcode == $this->team ){
                            if( !isset( $this->lows[$key][$val['key']]) || (float)$this->lows[$key][$val['key']]['value'] > (float)$val['value'] ){
                                $this->lows[$key][$val['key']] = [
                                    'value' => (float)$val['value'],
                                    'opponent' => $val->game->opponent_name ? $val->game->opponent_name : '',
                                    'player' => $val->player->name ? $val->player->name : '',
                                    'date' => $val->game->date ? $val->game->date : '',
                                ];
                            }
                        }
                    }
                }
            }

            if(!empty($this->lows)) {
                Redis::set($this->team . ':lows:' . $this->game->id, json_encode($this->lows));
            }
            return $this->lows;
        }
    }

    /**
     * @return array
     */
    protected function getKeys()
    {
        if (empty($this->keys)) {
            foreach ($this->data as $key => $category) {
                if (in_array($key, $this->available_values)) {
                    foreach ($category as $val) {
                        if (!isset($this->keys[$key]) || !in_array($val['key'], $this->keys[$key])) {
                            $this->keys[$key][] = $val['key'];
                        }
                    }
                    array_unique($this->keys[$key]);
                }
            }
        }

        return $this->keys;
    }
}
