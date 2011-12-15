<style>
li {
  margin-bottom: 10px;
}
</style>

<h2>Paul's Pet Projects - Newest to Oldest</h2>
 
<ul>
<?php
require_once('spyc.php');
$ppp = Spyc::YAMLLoad('ppp.yaml');
foreach ($ppp as $row) {
  print <<<END
<li>
  <iframe src="https://www.facebook.com/plugins/like.php?href={$row['href']}&amp;layout=button_count&amp;show_faces=false&amp;width=90&amp;height=21" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:90px; height:21px; vertical-align: top; margin-top: 3px" allowTransparency="true"></iframe>
  <a href="{$row['href']}">{$row['name']}</a>
  &mdash;
  <span class="desc">
    {$row['desc']}
  </span>
</li>
END;
}
?>

</ul>
