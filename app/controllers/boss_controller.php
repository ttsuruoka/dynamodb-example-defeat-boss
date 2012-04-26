<?php
class BossController extends AppController
{
    const BOSS_ID = 100;

    public function index()
    {
        $boss = Boss::get(Param::get('boss_id', self::BOSS_ID));

        $db = Dynamo::conn();
        $r = $db->call('Query', array(
            'TableName' => 'barusu_damage',
            'HashKeyValue' => array('S' => (string)$boss->id),
            'ScanIndexForward' => false,
            'Limit' => 10,
        ));

        $items = $r['Items'];

        $this->set(get_defined_vars());
    }

    public function attack()
    {
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
            ),
        ));

        $url = APP_URL . '?boss_id=' . $boss->id;
        header('Location: ' . $url);

        $this->set(get_defined_vars());
    }
}
