<?php
use yii\helpers\Html;


?>

<p>Dear <?= $model->submittedTo->firstname; ?>,</p></br>
<p> <?= $model->createdBy->fullNames; ?> has assigned  a task to you to perform action on <?= $model->loan->reference_number; ?> Loan application.</p></br>
<p><?= $model->remarks; ?>.</p></br>
<p>Click here <a href='http://localhost:8888/elms/frontend/web/index.php?r=site%2Flogin'> to login to the system </a></p>
