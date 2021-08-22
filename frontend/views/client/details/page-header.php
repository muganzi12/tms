<?php
use yii\helpers\Url;
/* 
 * Page header for profile pages
 */
?>
     <table class="table" style="margin:0px;">
        <tr>

            <td width="80%" class="text-center">
                <h2><?= $model->firstname . ' ' . $model->lastname; ?></h2>
                <h5><i class="os-icon os-icon-map-pin"></i> <?= $model->reference_number; ?> | <i class="os-icon os-icon-phone-15"></i> <?= $model->telephone; ?> | <i class="os-icon os-icon-email-2-at"></i> <?= $model->email; ?></h5>
                <p style="color:#036;font-size:135%;font-weight:bold;">Address: <?= $model->address; ?></p>
            </td>

        </tr>
    </table>
    