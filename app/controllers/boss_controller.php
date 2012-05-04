<?php
class BossController extends AppController
{
    const BOSS_ID = 500;

    public function index()
    {
        $player_name = Param::get('name', 'guest');
        $boss = Boss::get(Param::get('boss_id', self::BOSS_ID));
        $recent_damages = $boss->getRecentDamages();

        if ($boss->isDead()) {
            $last_attacker = $boss->getLastAttacker();
        }

        $this->set(get_defined_vars());
    }

    public function attack()
    {
        $player_name = Param::get('name', 'guest');

        $boss = Boss::get(Param::get('boss_id'));
        $boss->attacked($player_name);

        $url = APP_URL . '?boss_id=' . $boss->id . '&name=' . $player_name;
        header('Location: ' . $url);

        $this->set(get_defined_vars());
    }
}
