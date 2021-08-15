<?php

use yii\helpers\Html;

//Session
$session = Yii::$app->session;
?>
<?php $this->beginPage() ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=<?= Yii::$app->charset ?>" />
        <title><?= Html::encode($this->title) ?></title>
        <meta name="viewport" content="width=device-width"/>
        <?php $this->head() ?>
    </head>
    <body style='background: #eee;padding-top:30px; font-feature-settings: "kern";
          font-family: "WOL_SL","Segoe UI Semilight","Segoe UI",Tahoma,Helvetica,sans-serif;'>
          <?php $this->beginBody() ?>
        <table class="body" style='
               width:80%;
               margin:0 auto;
               border-radius: 5px;
               border:1px solid #ccc;
               background:#fff;'>
            <tr>
                <td class="center" align="center" valign="top">
                    <center>
                        <table class="row header" style="width:100%;">
                            <tr>
                                <td class="center" align="center">
                                    <center>
                                        <table class="container" style="width:100%;height:40px;">
                                            <tr>
                                                <td class="wrapper last">
                                                    <table style="width:100%;">
                                                        <tr>
                                                            <td class="six sub-columns" colspan="3">
                                                                <div style="clear:both;border-bottom:2px solid #069;">
                                                                    <div style='float:left'>
                                                                        <img src="https://media.kumusoft.com/logo.png" alt="LOGO" style="float:left;height:75px !important;"/>
                                                                    </div>
                                                                    <div style="color:#003;float:right;">
                                                                        <p style="font-size:12px;">
                                                                            <b>Website:</b> www.kumusoft.com<br/>
                                                                            <b>Email:</b> info@kumusoft.com<br/>
                                                                            <b>Tel (Office):</b> +256 393 228 333<br/>
                                                                            <b>Tel (Mobile):</b> 0706515667/0783232462<br/>
                                                                            <b>Date:</b> <?= date('jS F Y'); ?>
                                                                        </p>
                                                                    </div>
                                                                    <div style="clear: both;"></div>
                                                                </div> 
                                                            </td>
                                                        </tr>
                                                    </table>

                                                </td>
                                            </tr>
                                        </table>
                                    </center>
                                </td>
                            </tr>
                        </table>
                        <table style="width:100%;">
                            <tr>
                                <td style='padding:0px;'>
                                    <table style="width:100%;">
                                        <tr>
                                            <td style='padding-left:15px;padding-right: 5px;'>
                                                <?= $content ?>
                                            </td>
                                        </tr>
                                    </table>

                                </td>
                            </tr>
                        </table>
                    </center>
                </td>
            </tr>
        </table>
        <table class="row footer" style="width:80%; margin:0 auto;">
            <tr>        
                <td style="color:#068;text-align:center;">                
                    <p style='color:#999;font-size:13px;'>This email was automatically sent by <a href="https://efris.kumusoft.com">Kumusoft Solutions</a></b>. Please do not reply</p>
                    <p style='font-size: 12px;'>Kumusoft Solutions is a certified software development company. <br/>We are located at Plot 28, Martyrs Way, Ntinda ,Kampala, Uganda.
                    </p>
                </td>
            </tr>
        </table>
        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>