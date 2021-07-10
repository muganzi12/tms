<?php

use yii\data\ArrayDataProvider;
use yii\helpers\Json;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use common\models\member\Member;
use common\models\member\NextOfKin;
use yii\bootstrap\Modal;
use yii\widgets\Pjax;

$this->title = "Next of Kin";


$data = Json::decode($kin);

$dataProvider = new ArrayDataProvider([
    'allModels' => $data,
    'pagination' => [
        'pageSize' => 10,
    ],
    'sort' => [
        'attributes' => ['id'],
    ],
        ]);
$searchModel = new Member();
$model = new NextOfKin();
//Page descrition
$this->params['page_description'] = 'Members';
?>
<?= $this->render('registration/reg-steps-top-nav',['model'=>$model,'active'=>'kin']); ?>
<br/>
<p>
     <?= Html::a('Add Next of Kin Details', ['new-next-of-kin'], ['class' => 'btn btn-primary']) ?>
    <br/>

  
<div class="box">

    <?php
    echo GridView::widget([
        'dataProvider' => $dataProvider,
        // 'filterModel' => $searchModel,
        'tableOptions' => ['class' => 'table table-striped'],
        'summary' => '',
        'columns' => [
           
            [
                'attribute' => 'firstname',
                'header' => 'First Name',
                'value' => function($data) {
                    return $data['firstname'];
                }
            ],
            [
                'attribute' => 'lastname',
                'header' => 'Last Name',
                'value' => function($data) {
                    return $data['lastname'];
                }
            ],
            [
                'attribute' => 'middle_name',
                'header' => 'Middle Name',
                'value' => function($data) {
                    return $data['middle_name'];
                }
            ],
            [
                'attribute' => 'phone_number',
                'header' => 'Primary Telephone',
                'value' => function($data) {
                    return $data['phone_number'];
                }
            ],
          
            [
                'attribute' => 'gender',
                'header' => 'Gender',
                'value' => function($data) {
                    return $data['gender'];
                }
            ],

            [
                'attribute' => 'date_of_birth',
                'header' => 'Date of Birth',
                'value' => function($data) {
                    return $data['date_of_birth'];
                }
            ],
            [
                'attribute' => 'address',
                'header' => 'Address',
                'value' => function($data) {
                    return $data['address'];
                }
            ],
                    
                    ['class' => 'yii\grid\ActionColumn', 'template' => '{update} {view}'],

        
        ],
    ]);
    ?>

</div>



