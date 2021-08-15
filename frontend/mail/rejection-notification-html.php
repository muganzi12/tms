<?php
use yii\helpers\Html;


?>

<p>Dear <?= $loan->loan->client->firstname; ?>,</p></br>
<p> This email is in reference to your loan application dated [<?= $loan->loan->application_date; ?>]. After going through your application, we are sorry to inform you that your application was rejected due to [<?= $loan->remarks; ?>].
    Thank you for considering us. You can reapply the loan after meeting the set conditions.</p>

