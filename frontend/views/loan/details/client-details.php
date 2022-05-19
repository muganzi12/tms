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
                    <?= $model->client->external_id; ?></td>
                <td>
                    <b>First Name</b><br/>
                    <?= $model->client->firstname; ?>
                </td>
                <td>
                    <b>Last Name</b><br/>
                    <?= $model->client->lastname; ?>
                </td>
                <td>
                    <b>Other Name</b><br/>
                    <?= $model->client->othername; ?>
                </td>
            </tr>
            <tr>


                <td>
                    <b>Client Type</b><br/>
                    <?= $model->client->clientType->name; ?>
                </td>
                
                    <td>
                    <b>Classification</b><br/>
                    <?= @$model->client->classificationStatus->name; ?>
                </td>

            
                 <td>
                    <b>ID Type</b><br/>
                    <?= @$model->client->identificationType->name; ?>
                </td>
                       <td>
                    <b>ID Number</b><br/>
                    <?= $model->client->identification_number; ?>
                </td>
            
             

            </tr>
            <tr>
                <td>
                    <b>Telephone</b><br/>
                    <?= $model->client->telephone; ?>
                </td>
                <td>
                    <b>Alt Telephone</b><br/>
                    <?= $model->client->telephone; ?>
                </td>
                      <td>
                    <b>Email</b><br/>
                    <?= $model->client->email; ?>
                </td>
                         <td>
                    <b>Address</b><br/>
                    <?= $model->client->address; ?>
                </td>
    
            </tr>

            <tr>
                 <td>
                    <b>Account Number</b><br/>
                    <?= $model->client->account_number; ?>
                </td>
                <td></td>
                            <td>
                    <b>Date of Birth</b><br/>
                    <?= $model->client->date_of_birth; ?>
                </td>
          
       
                <td>
                    <b>Date recorded</b><br/>
                    <?= Yii::$app->formatter->asDate($model->client->created_at); ?>
                </td>
            </tr>

        </table>
    </div>
</div>