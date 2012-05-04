<?php
class BossController extends AppController
{
    public function index()
    {
        $default_player_name = 'guest' . mt_rand(100, 999);
        $default_boss_id = mt_rand(100, 999);

        $player_name = Param::get('name', $default_player_name);
        $boss = Boss::get(Param::get('boss_id', $default_boss_id));
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
        $recent_damages = $boss->getRecentDamages();
        if ($boss->isDead()) {
            $last_attacker = $boss->getLastAttacker();
        }

        $this->set(get_defined_vars());
        $this->render('index');
    }
}
