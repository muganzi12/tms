<?php

/* 
 * Email to inform new system users that their account have been created
 */
//Generate Random password
$passwd = Yii::$app->session->get('default_password');
?>
<p>Hello <?= $name; ?>, we are glad to inform you that your admin account has been set up.</p>
<p>Your new password is <?= $passwd ?></p>