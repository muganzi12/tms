<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\client\MemberSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Next Of Kin Details';
$this->params['breadcrumbs'][] = $this->title;
$this->params['page_description'] = '';
?>
<?= $this->render('registration/reg-steps-top-nav', ['model' => $model, 'active' => 'kin']); ?>
<div class="row">
    
    <div class="col-lg-10" style="padding:0px;">
 

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        // 'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            //'id',
            'firstname',
            'lastname',
            [
                'attribute' => 'identification_type',
                'value' => function($data) {
                    return $data->identificationType->name;
                },
                'format' => 'raw'
            ],
            'identification_number',
            [
                'attribute' => 'relationship',
                'value' => function($data) {
                    return $data->relationshipType->name;
                },
                'format' => 'raw'
            ],
            'telephone',
            // 'alt_telephone',
            [
                'attribute' => 'gender',
                'value' => function($data) {
                    return $data->genderType->name;
                },
                'format' => 'raw'
            ],
            //'marital_status',
            //'date_of_birth',
            'address',
            'email',
           
            //'membership_type',
            //'person_scenario',
            //'relationship',
            //'related_to',
            //'created_at',
            //'created_by',
            //'updated_at',
            //'updated_by',
            [
                'format' => 'raw',
                'value' => function($data) {
                    return
                    Html::a('<span class="glyphicon glyphicon-pencil"></span> Update', ['update-next-of-kin', 'id' => $data['id'], 'memb' => $data->client->id], ['title' => 'edit', 'class' => 'btn btn-info']);
                },
                'header' => 'OPTIONS'
            ],],
    ]);
    ?>
</div>
   <div class="col-lg-2" style="padding:12px;">
        <?= $this->render('registration/left-navigation', ['model' => $model, 'active' => 'summary']); ?>            
    </div>
</div>
