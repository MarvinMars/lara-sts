<?php

namespace App\Classes\Stats\Sports\VolleyballGame;


use App\Classes\Stats\Sports\Abstracts\AbstractGame;

/*
 * Note for stats
 * – GP: the number of games played in the match by each player.
 * – K: An attack is a player sending the ball over the net in an attempt to score. A kill is recorded whenever an attack is unreturnable. A kill always results in point.
 * – E: An error is recorded when an attack attempt gives the opposition a point. Examples of an attack error include an opponent blocking the attack for a point or a player hitting the ball out of bounds. An attack error always results in a point for the other team.
 * – TA: Total attempts simply equals the total numbers of kills, errors, and zero attacks (a zero attack is when when the opposition keeps the ball in play after an attack – these are not listed separately in the box score).
 * – PCT: Hitting percentage is derived from this formula:(KILLS – ERRORS) / TOTAL ATTEMPTS = HITTING PERCENTAGE.
 * – A: An assist assist is given when a player sends the ball (via a set, dig, or pass) to a teammate who then gets a kill.
 * – SA: A service ace is awarded when a serve can not be returned and results in a point, or when a serve leads to a violation by the opponent that results in a point.
 * – SE: A service error is charged when the serve is unsuccessful. Examples include: when the serve does not clear the net or lands out of bounds, or when the server commits an error, such as foot faulting.
 * – RE: A reception error is when a player receiving the serve messes up. This could be by making an unplayable pass after receiving the serve, letting the serve hit the floor nearby or committing an infraction while taking the serve. The reception error is charged to the team if the serve lands between two players who could have taken it or if the receiving team is out of rotation. It is important to note that any time an ace is recorded by the serving team, a reception error must be charged to the receiving team.
 * – DIG: A statistical dig is given anytime an attack is successfully defended. The dig can be passed to another player or sent back over the net. A dig that is not kept in play is not awarded in the stats.
 * – BS: A block solo is given when a player successfully blocks an attack attempt for a score by themselves.
 * – BA: If more than one player goes up to block, even if only one of the players touches the ball, and the block results in a point then each player receives a block assist.
 * – BE: A blocking error occurs when the blocker commits an error that causes the referee to whistle the play dead. Note that a blocked ball going out of bounds or into the net is not a blocking error. Blocking errors include a blocker: reaching over the net, going into the net, throwing the ball, etc. A blocking error results in a kill for the attacker.
 * – BHE: Ball handling errors include double hits, lifted balls, and thrown balls unless they fall under the reception errors, attack errors, or blocking errors listed above.
 * The last stat to note is the total team blocks. It is calculated using this formula: BLOCK SOLOS + (1/2 x BLOCK ASSISTS) = TOTAL TEAM BLOCKS
*/
/**
 * Class GameByGame
 * @package App\Classes\Stats\Sports\VolleyballGame
 */

class GameByGame extends AbstractGame
{

    public function gp()
    {
        return $this->_getQuery('player', 'gp');
    }

    public function k()
    {
        $total = $this->gp();
        $atc_k = $this->_getQuery('attack', 'k');

//        if ($total>0) return  ( number_format($atc_k/$total,2) );

        return $atc_k;
    }

    public function attack_e()
    {
        return $this->_getQuery('attack', 'e');
    }

    public function ta()
    {
        return $this->_getQuery('attack', 'ta');
    }

    public function pct()
    {
        return $this->_getQuery('attack', 'pct');
    }

    public function ast()
    {
        $total = $this->gp();
        $set_a = $this->_getQuery('set', 'a');

//        if ($total>0) return ( number_format($set_a/$total,2) );

        return $set_a;

    }

    public function set_e()
    {
        return $this->_getQuery('set', 'e');
    }

    public function sa()
    {
        $total = $this->gp();
        $serve_sa = $this->_getQuery('serve', 'sa');

//        if ($total>0) return ( number_format($serve_sa/$total,2) );

        return $serve_sa;
    }

    public function se()
    {
        return $this->_getQuery('serve', 'se');
    }

    public function re()
    {
        return $this->_getQuery('defense', 're');
    }

    public function dig()
    {
        $total = $this->gp();
        $defense_dig = $this->_getQuery('defense', 'dig');

//        if ($total>0) return ( number_format($defense_dig/$total,2) );

        return $defense_dig;
    }

    public function bs()
    {
        return $this->_getQuery('block', 'bs');
    }

    public function ba()
    {
        return $this->_getQuery('block', 'ba');
    }

    public function be()
    {
        return $this->_getQuery('block', 'be');
    }

    public function tb()
    {
        $total = $this->gp();
        $block_tb = $this->_getQuery('block', 'tb');

//        if ($total>0) return ( number_format($block_tb/$total,2) );

        return $block_tb;
    }

    public function bhe()
    {
        return $this->_getQuery('misc', 'bhe');
    }

    public function pts()
    {
        return $this->_getQuery('misc', 'pts');
    }

    public function getValues()
    {
        // TODO: Implement getValues() method.
    }
}
