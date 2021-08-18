<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\client\Member */

$this->title = $model->firstname . ' ' . $model->lastname;
$this->params['breadcrumbs'][] = ['label' => 'Members', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['page_description'] = '';
\yii\web\YiiAsset::register($this);
?>
<?= $this->render('registration/reg-steps-top-nav', ['model' => $model, 'active' => 'member']); ?>
<div class="row">  
    <div class="col-lg-10" style="padding:0px;">

        <div class="row-fluid" style="margin-top:10px;">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header text-uppercase bg-dark text-white">Client Details</div>
                    <div class="card-body"> 
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <?= $this->render('details/client-details', ['model' => $model]); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row-fluid" style="margin-top:10px;">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header text-uppercase bg-dark text-white">Next of Kin Details</div>
                    <div class="card-body"> 
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <?= $this->render('details/kin-details', ['model' => $model]); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-2" style="padding:0px;">
        <?= $this->render('registration/left-navigation', ['model' => $model, 'active' => 'summary']); ?>            
    </div>
</div>



