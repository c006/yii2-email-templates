<?php
/** @var  $array */

$array['items'] = (isset($array['items'])) ? $array['items'] : [];
$array['user'] = (isset($array['user'])) ? $array['user'] : '';
$array['note'] = (isset($array['note'])) ? $array['note'] : '';
?>

<p><?= $array['company_name'] ?><?= $array['page_title'] ?></p>


<p><?= $array['user'] ?></p>
<p>  <?= $array['note'] ?></p>

