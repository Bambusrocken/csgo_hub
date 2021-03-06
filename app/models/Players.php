<?php

class Players extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var string
     */
    public $id;

    /**
     *
     * @var string
     */
    public $match_id;

    /**
     *
     * @var string
     */
    public $map_id;

    /**
     *
     * @var string
     */
    public $player_key;

    /**
     *
     * @var string
     */
    public $team;

    /**
     *
     * @var string
     */
    public $ip;

    /**
     *
     * @var string
     */
    public $steamid;

    /**
     *
     * @var string
     */
    public $first_side;

    /**
     *
     * @var string
     */
    public $current_side;

    /**
     *
     * @var string
     */
    public $pseudo;

    /**
     *
     * @var string
     */
    public $nb_kill;

    /**
     *
     * @var string
     */
    public $assist;

    /**
     *
     * @var string
     */
    public $death;

    /**
     *
     * @var string
     */
    public $point;

    /**
     *
     * @var string
     */
    public $hs;

    /**
     *
     * @var string
     */
    public $defuse;

    /**
     *
     * @var string
     */
    public $bombe;

    /**
     *
     * @var string
     */
    public $tk;

    /**
     *
     * @var string
     */
    public $nb1;

    /**
     *
     * @var string
     */
    public $nb2;

    /**
     *
     * @var string
     */
    public $nb3;

    /**
     *
     * @var string
     */
    public $nb4;

    /**
     *
     * @var string
     */
    public $nb5;

    /**
     *
     * @var string
     */
    public $nb1kill;

    /**
     *
     * @var string
     */
    public $nb2kill;

    /**
     *
     * @var string
     */
    public $nb3kill;

    /**
     *
     * @var string
     */
    public $nb4kill;

    /**
     *
     * @var string
     */
    public $nb5kill;

    /**
     *
     * @var string
     */
    public $pluskill;

    /**
     *
     * @var string
     */
    public $firstkill;

    /**
     *
     * @var string
     */
    public $created_at;

    /**
     *
     * @var string
     */
    public $updated_at;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->hasMany('id', 'PlayerKill', 'killed_id', array('alias' => 'PlayerKill'));
        $this->hasMany('id', 'PlayerKill', 'killer_id', array('alias' => 'PlayerKill'));
        $this->hasMany('id', 'PlayersHeatmap', 'attacker_id', array('alias' => 'PlayersHeatmap'));
        $this->hasMany('id', 'PlayersHeatmap', 'player_id', array('alias' => 'PlayersHeatmap'));
        $this->hasMany('id', 'PlayersSnapshot', 'player_id', array('alias' => 'PlayersSnapshot'));
        $this->hasMany('id', 'RoundSummary', 'best_killer', array('alias' => 'RoundSummary'));
        $this->belongsTo('map_id', 'Maps', 'id', array('alias' => 'Maps'));
        $this->belongsTo('match_id', 'Matchs', 'id', array('alias' => 'Matchs'));
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Players[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Players
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'players';
    }

}
