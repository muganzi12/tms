<?php
/*
 * Details of a file
 */
?>
<div class="row">

    <div class="col-lg-12">
        <table class="table">
            <tr style="border-top:0px solid #eee;">
                <td><b>External ID</b><br/>
                    <?= $model->external_id; ?></td>
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


                <td>
                    <b>Client Type</b><br/>
                    <?= $model->clientType->name; ?>
                </td>
                
                    <td>
                    <b>Classification</b><br/>
                    <?= @$model->classificationStatus->name; ?>
                </td>

            
                 <td>
                    <b>ID Type</b><br/>
                    <?= @$model->identificationType->name; ?>
                </td>
                       <td>
                    <b>ID Number</b><br/>
                    <?= $model->identification_number; ?>
                </td>
            
             

            </tr>
            <tr>
                <td>
                    <b>Telephone</b><br/>
                    <?= $model->telephone; ?>
                </td>
                <td>
                    <b>Alt Telephone</b><br/>
                    <?= $model->telephone; ?>
                </td>
                      <td>
                    <b>Email</b><br/>
                    <?= $model->email; ?>
                </td>
                         <td>
                    <b>Address</b><br/>
                    <?= $model->address; ?>
                </td>
    
            </tr>

            <tr>
                 <td>
                    <b>Account Number</b><br/>
                    <?= $model->account_number; ?>
                </td>
                <td></td>
                            <td>
                    <b>Date of Birth</b><br/>
                    <?= $model->date_of_birth; ?>
                </td>
          
       
                <td>
                    <b>Date recorded</b><br/>
                    <?= Yii::$app->formatter->asDate($model->created_at); ?>
                </td>
            </tr>

        </table>
    </div>
</div>