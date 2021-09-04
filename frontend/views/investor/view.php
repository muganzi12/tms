<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\client\Investor */

$this->title = $model->firstname . ' ' . $model->firstname;
$this->params['breadcrumbs'][] = ['label' => 'Investors', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
//Pass InvestorID to the layout 
$this->params['investor_id'] = $investorId;
\yii\web\YiiAsset::register($this);
?>
<div class="investor-view">


    <?=
    DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'firstname',
            'lastname',
            'othername',
            [
                'attribute' => 'identification_type',
                'value' => function($data) {
                    return $data->identificationType->name;
                },
                'format' => 'raw'
            ],
            'identfication_number',
            'telephone',
            'physical_address',
            'alt_telephone',
            'email:email',
            'date_of_birth',
        //'created_at',
        //'status',
        //'created_by',
        //'updated_at',
        //'updated_by',
        ],
    ])
    ?>

</div>
