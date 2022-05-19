<?php
/*
 * Profile page of the Logged in User
 */
$this->title = Yii::$app->member->fullnames;
$this->params['breadcrumbs'][] = 'System Settings';
$this->params['breadcrumbs'][] = $this->title;
//Pass CLientID to the layout 
$this->params['user_id'] = $userId;
?>
<div class="row">

    <div class="col-lg-9">
        <h3>My Details</h3>
        <table class="table">
            <tr>
                <td>
                    <b>Firstname</b><br/>
                    <?= Yii::$app->member->firstname; ?>
                </td>
                <td>
                    <b>Lastname</b><br/>
                    <?= Yii::$app->member->lastname; ?>
                </td>
                <td>
                    <b>Username</b><br/>
                    <?= Yii::$app->member->username; ?>       
                </td>
            </tr>
            <tr>
                <td>
                  <b>Primary Email</b><br/>
                    <?= Yii::$app->member->email; ?>  
                </td>
            
            </tr>
        </table>
     
    </div>
</div>