<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\property\PropertyUnit */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Property Units', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="property-unit-view">


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
        // 'id',
        'name',
        [
            'attribute' => 'property',
            'value' => function ($data) {
                return $data->propertyName->name;
            }, 'format' => 'raw',
        ],
        'unit_number',
        'status',
        [
            'attribute' => 'unit_type',
            'value' => function ($data) {
                return $data->unitType->name;
            }, 'format' => 'raw',
        ],
        'rate',
        'crated_at',
        'created_by',
        'updated_at',
        'updated_by',
    ],
])?>

</div>
