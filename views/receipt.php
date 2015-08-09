<?php
/** @var  $array */

$array['items'] = (isset($array['items'])) ? $array['items'] : [];

$total = 0;
?>

<p><?= $array['company_name'] ?><?= $array['page_title'] ?></p>

<?php foreach ($array['items'] as $row) : ?>
    <p><?= $row['item'] ?>  (<?= $row['qty'] ?>) $<?= number_format($row['total'] + 0.0000001, 2) ?></p>
    <?php $total += $row['total'] * $row['qty'] ?>
<?php endforeach ?>

<p>Total: $<?= number_format($total, 2) ?></p>

<p></p>
<p>Thank you for your purchase</p>