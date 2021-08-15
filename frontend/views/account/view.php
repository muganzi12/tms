<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\client\ChartOfAccounts */

$this->title = $model->account_name;
$this->params['breadcrumbs'][] = ['label' => 'Chart Of Accounts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<?= $this->render('registration/reg-steps-top-nav', ['model' => $model, 'active' => 'header']); ?>

<div class="row">  
    <div class="col-lg-10" style="padding:0px;"> 

        <?=
        DetailView::widget([
            'model' => $model,
            'attributes' => [
                // 'id',
                'gl_code',
                'account_name',
                [
                    'attribute' => 'account_type',
                    'value' => function($data) {
                        return $data->type->name;
                    },
                    'format' => 'raw'
                ],
                'description',
//                'created_at',
//                'created_by',
            ],
        ])
        ?>
    </div>
    <div class="col-lg-2" style="padding:12px;">
<?= $this->render('registration/left-navigation', ['model' => $model, 'active' => 'summary']); ?>            
    </div>
</div>
