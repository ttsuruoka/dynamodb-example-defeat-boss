<?php
class BossController extends AppController
{
    const BOSS_ID = 200;

    public function index()
    {
        $player_name = Param::get('name', 'guest');
        $boss = Boss::get(Param::get('boss_id', self::BOSS_ID));

        $db = Dynamo::conn();
        $r = $db->call('Query', array(
            'TableName' => 'barusu_damage',
            'HashKeyValue' => array('S' => (string)$boss->id),
            'ScanIndexForward' => false,
            'Limit' => 10,
        ));

        if ($boss->isDead()) {
            $last_attacker = $boss->getLastAttacker();
        }

        $items = $r['Items'];

        $this->set(get_defined_vars());
    }

    public function attack()
    {
        $player_name = Param::get('name', 'guest');

        // TODO: ボスにダメージを与える
        $db = Dynamo::conn();

        $boss = Boss::get(Param::get('boss_id'));
        $date_damaged = Time::unix();
        $damage = mt_rand(50, 200);
        $boss->hp -= $damage; // ダメージを与える

        $r = $db->call('PutItem', array(
            'TableName' => 'barusu_damage',
            'Item' => array(
                'boss_id'      => array('S' => (string)$boss->id),
                'date_damaged'   => array('N' => (string)$date_damaged),
                'hp'      => array('N' => (string)$boss->hp),
                'damage' => array('N' => (string)$damage),
                'name' => array('S' => (string)$player_name),
            ),
        ));

        $url = APP_URL . '?boss_id=' . $boss->id . '&name=' . $player_name;
        header('Location: ' . $url);

        $this->set(get_defined_vars());
    }
}
