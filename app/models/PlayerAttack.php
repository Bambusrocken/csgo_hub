<?php

class PlayerAttack extends \Phalcon\Mvc\Model
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
    public $attacker_name;

    /**
     *
     * @var string
     */
    public $attacker_id;

    /**
     *
     * @var string
     */
    public $attacker_team;

    /**
     *
     * @var string
     */
    public $attacked_name;

    /**
     *
     * @var string
     */
    public $attacked_id;

    /**
     *
     * @var string
     */
    public $attacked_team;

    /**
     *
     * @var string
     */
    public $weapon;

    /**
     *
     * @var integer
     */
    public $damage;

    /**
     *
     * @var string
     */
    public $location;

    /**
     *
     * @var string
     */
    public $round_id;

    /**
     *
     * @var string
     */
    public $created_at;

    /**
     *
     * @var string
     */
    public $update_at;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->hasMany('id', 'Round', 'attack_id', array('alias' => 'Round'));  //Added manually
        $this->belongsTo('match_id', 'Matchs', 'id', array('alias' => 'Matchs'));
        $this->belongsTo('attacked_id', 'Players', 'id', array('alias' => 'Players'));
        $this->belongsTo('attacker_id', 'Players', 'id', array('alias' => 'Players'));
        $this->belongsTo('map_id', 'Maps', 'id', array('alias' => 'Maps'));
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return PlayerAttack[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return PlayerAttack
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
        return 'player_attack';
    }

}
