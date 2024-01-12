<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\property\Property */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Properties', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="property-view">

    <p>
        <?=Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary'])?>
        <?=Html::a('Delete', ['delete', 'id' => $model->id], [
    'class' => 'btn btn-danger',
    'data' => [
        'confirm' => 'Are you sure you want to delete this item?',
        'method' => 'post',
    ],
])?>
    </p>

    <?=DetailView::widget([
    'model' => $model,
    'attributes' => [
        'id',
        'name',
        'type',
        'description:ntext',
        [
            'attribute' => 'municipality',
            'value' => function ($data) {
                return $data->municipalityName->name;
            }, 'format' => 'raw',
        ],
        [
            'attribute' => 'division',
            'value' => function ($data) {
                return $data->divisionName->name;
            }, 'format' => 'raw',
        ],
        [
            'attribute' => 'parish',
            'value' => function ($data) {
                return $data->parishName->name;
            }, 'format' => 'raw',
        ],
        [
            'attribute' => 'village',
            'value' => function ($data) {
                return $data->villageName->name;
            }, 'format' => 'raw',
        ],
        [
            'attribute' => 'street',
            'value' => function ($data) {
                return $data->streetName->name;
            }, 'format' => 'raw',
        ],
        'plot_number',
        'house_number',
        'attachment',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
    ],
])?>

</div>
