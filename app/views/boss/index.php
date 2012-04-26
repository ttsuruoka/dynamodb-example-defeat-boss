<h2>ボス出現!!</h2>

(仮のビュー)

<div>
<?php if ($boss->isDead()): ?>
  <img src="http://dl.dropbox.com/u/154784/demo/boss_nega.jpg" />
<?php else: ?>
  <img src="http://dl.dropbox.com/u/154784/demo/boss.jpg" />
<?php endif ?>
</div>
<div style="font-size:2em;">
HP <?php eh($boss->getHP()) ?>/<?php eh($boss->max_hp) ?>
</div>
<br />

<?php if ($boss->isDead()): ?>
<div>
  <p>ボスを倒した！！</p>
  <p>倒した人：<?php eh($last_attacker['name']['S']) ?>さん</p>
</div>
<?php endif ?>
<br />

<div>
    <a class="btn btn-large" href="<?php eh(url('boss/attack', array('boss_id' => $boss->id, 'name' => $player_name))) ?>">Attack!</a>
</div>
<br />
<br />

<?php if (count($items)): ?>
<h3>最近のダメージ</h3>
<?php endif ?>
<div>
<?php foreach ($items as $v): ?>
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
<?php if (isset($last_attacker)): ?>
<?php /*
<?php $items = $last_attacker['Items'] ?>
<?php foreach ($items as $v): ?>
id=<?php eh($v['boss_id']['S']) ?>,hp=<?php eh($v['hp']['N']) ?><br />
<?php endforeach ?>
 */ ?>
<?php /*
<pre>
<?php eh(var_dump($last_attacker))?>
</pre>
 */ ?>
<?php endif ?>

<br />
<br />

