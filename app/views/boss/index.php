<h2>ボス出現!!</h2>

<div>
<?php if ($boss->isDead()): ?>
  <img src="http://dl.dropbox.com/u/154784/demo/boss_nega.jpg" />
<?php else: ?>
  <?php if ($boss->getHP() < 300): ?>
  <img src="http://dl.dropbox.com/u/154784/demo/boss_damaged_1.jpg" />
  <?php else: ?>
  <img src="http://dl.dropbox.com/u/154784/demo/boss.jpg" />
  <?php endif ?>
<?php endif ?>
</div>

<div style="font-size:2em;line-height:1.2em;">
HP <?php eh($boss->getHP()) ?>/<?php eh($boss->max_hp) ?>
</div>

<?php if ($boss->isDead()): ?>
<div>
  <p>
    ボスを倒した！！<br />
    倒した人：<?php eh($last_attacker['name']['S']) ?>さん
  </p>
</div>
<?php endif ?>
<br />

<div>
    <a class="btn btn-large" href="<?php eh(url('boss/attack', array('boss_id' => $boss->id, 'name' => $player_name))) ?>">Attack!</a>
</div>
<br />
<br />

<?php if (count($recent_damages)): ?>
<h3>最近のダメージ</h3>
<?php endif ?>
<div>
<?php foreach ($recent_damages as $v): ?>
  <div>
    <?php eh(date('Y-m-d H:i:s', $v['date_damaged']['N'])) ?> に
    <?php eh($v['name']['S']) ?>さんが
    <?php eh($v['damage']['N']) ?> を与えた！
  </div>
<?php endforeach ?>
</div>

<br />
<div>
    <a class="btn btn-large" href="<?php eh(url('boss/index', array('boss_id' => mt_rand(100, 1000), 'name' => $player_name))) ?>">新しいボスを探しに行く</a>
</div>

<br />
<br />

