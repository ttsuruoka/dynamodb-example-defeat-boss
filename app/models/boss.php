<?php
class Boss
{
    public $max_hp = 1000;
    public $hp = 1000;

    public static function get($boss_id)
    {
        $boss = new Boss;
        $boss->id = $boss_id;

        $db = Dynamo::conn();
        $r = $db->call('Query', array(
            'TableName' => 'barusu_damage',
            'HashKeyValue' => array('S' => (string)$boss->id),
            'ScanIndexForward' => false,
            'Limit' => 1,
        ));

        if (empty($r['Items'])) {
            $boss->hp = $boss->max_hp;
        } elseif (!isset($r['Items'][0]['hp']['N'])) {
            $boss->hp = $boss->max_hp;
        } else {
            $boss->hp = $r['Items'][0]['hp']['N'];
        }

        return $boss;
    }

    public function getHP()
    {
        return max($this->hp, 0);
    }

    public function isDead()
    {
        return $this->getHP() <= 0;
    }
}
