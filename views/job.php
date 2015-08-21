<?php
/** @var  $array */

$array['items'] = (isset($array['items'])) ? $array['items'] : [];
$array['credits'] = (isset($array['credits'])) ? $array['credits'] : '';
$array['date_due'] = (isset($array['date_due'])) ? $array['date_due'] : '';
$array['overview'] = (isset($array['overview'])) ? $array['overview'] : '';
$array['callback'] = (isset($array['callback'])) ? $array['callback'] : 0;

?>

<p><?= $array['company_name'] ?><?= $array['page_title'] ?></p>

<p>
    Date Due: <?= $array['date_due'] ?>
<div>Credits: <?= $array['credits'] ?></div>
<div>Callback: <?= ($array['callback']) ? 'Yes' : 'No' ?></div>
</p>

<p><?= $array['overview'] ?></p>

<?php foreach ($array['items'] as $item) : ?>
    <p>* <?= $item ?></p>
<?php endforeach ?>


<p></p>
<p>Thank you, I will look over the request.</p>