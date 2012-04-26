<h2>ボス出現!!</h2>

(仮のビュー)

<div>
    <a class="btn btn-large" href="<?php eh(url('boss/index', array('boss_id' => mt_rand(100, 1000)))) ?>">新しいボスを探しに行く</a>
</div>


<?php /*
</pre>
<?php eh(var_dump($r))?>
<pre>
 */ ?>
<br />
<br />

<div>
  <img src="http://dl.dropbox.com/u/154784/demo/boss.jpg" / >
</div>
<div style="font-size:2em;">
HP <?php eh($boss->getHP()) ?>/<?php eh($boss->max_hp) ?>
</div>
<br />

<?php if ($boss->isDead()): ?>
<div>
  <p>ボスを倒した！！</p>
  <p>倒した人：○○さん</p>
</div>
<?php endif ?>
<br />
<br />

<div>
    <a class="btn btn-large" href="<?php eh(url('boss/attack', array('boss_id' => $boss->id))) ?>">Attack!</a>
</div>
<br />
<br />

<h3>最近のダメージ</h3>
<div>
<?php foreach ($items as $v): ?>
  <div>
    <?php eh(date('Y-m-d H:i:s', $v['date_damaged']['N'])) ?> に
    ○○さんが
    <?php eh($v['damage']['N']) ?> を与えた！
  </div>
<?php endforeach ?>
</div>

