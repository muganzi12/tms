<?php
/*
 * Details of a file
 */
?>
<div class="row">
    <div class="col-lg-3">
        <img src="<?= $model->passportPhoto; ?>" style="width: 90%;height:auto;margin:0 10px 10px 10px;border:1px solid #ccc;border-radius: 7px;"/>      
    </div>
    <div class="col-lg-9">
        <table class="table">
            <tr>
                <td><b>Reference Number</b><br/>
                    <?= $model->reference_number; ?></td>
                <td>
                    <b>First Name</b><br/>
                    <?= $model->firstname; ?>
                </td>
                <td>
                    <b>Last Name</b><br/>
                    <?= $model->lastname; ?>
                </td>
                <td>
                    <b>Other Name</b><br/>
                    <?= $model->othername; ?>
                </td>
            </tr>
            <tr>
                <td><b>Identification Type</b><br/>
                    <?= $model->identificationType->name; ?></td>
                <td>
                    <b>Identification Number</b><br/>
                    <?= $model->identification_number; ?>
                </td>
                <td>
                    <b>Telephone</b><br/>
                    <?= $model->telephone; ?>
                </td>
                <td>
                    <b>Alt Telephone</b><br/>
                    <?= $model->telephone; ?>
                </td>
            </tr>
            <tr>
                <td><b>Gender</b><br/>
                    <?= $model->genderType->name; ?></td>
                <td>
                    <b>Marital Status</b><br/>
                    <?= $model->maritalStatus->name; ?>
                </td>
                <td>
                    <b>Date of Birth</b><br/>
                    <?= $model->date_of_birth; ?>
                </td>
                <td>
                    <b>Email</b><br/>
                    <?= $model->email; ?>
                </td>
            </tr>

            <tr>
                <td>
                    <b>Address</b><br/>
                    <?= $model->address; ?>
                </td>
                <td>
                    <b>Date recorded</b><br/>
                    <?= Yii::$app->formatter->asDate($model->created_at); ?>
                </td>
            </tr>

        </table>
    </div>
</div>