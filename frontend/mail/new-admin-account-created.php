<?php

/* 
 * Email to inform new system users that their account have been created
 */
//Generate Random password
$passwd = Yii::$app->session->get('default_password');
?>
<p>Dear <?= $name; ?>,</p></br>
<p>We are glad to inform you that your super admin account has been created successfully with the following details.</p>
<p>Username is <?= $username ?></p>
<p>Password is <?= $passwd ?></p>
<p>Click here <a href='#'> to login to the system </a></p>