<?php
class Boss
{
    public $max_hp = 1000;
    public $hp = 1000;

    public static function get($boss_id)
    {
        $player_name = Param::get('name', 'guest');

        $boss = new Boss;
        $boss->id = $boss_id;

        $db = Dynamo::conn();
        $r = $db->call('Query', array(
            'TableName' => 'boss_damage',
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

    public function getLastAttacker()
    {
        // boss_damage で、
        // 残 HP 0 以下のレコードを昇順に取得
        // 最初の 1 件目がとどめをさした人


        $db = Dynamo::conn();
        $r = $db->call('Scan', array(
            'TableName' => 'boss_damage',
            'ScanFilter' => array(
                'boss_id' => array(
                    'AttributeValueList' => array(array('S' => (string)$this->id)),
                    'ComparisonOperator' => 'EQ',
                ),
                'hp' => array(
                    'AttributeValueList' => array(array('N' => (string)0)),
                    'ComparisonOperator' => 'LE',
                ),
            ),
            'Limit' => 1000,
        ));

        if (empty($r['Items'])) {
            return null; // とどめをさした人がまだいない
        }

        return $r['Items'][0]; // とどめをさした人のレコード
    }
}
