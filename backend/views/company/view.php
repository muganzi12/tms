
<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\DetailView;

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Clients', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['page_description'] = 'View Client Details';
\yii\web\YiiAsset::register($this);
?>
<?= $this->render('registration/reg-steps-top-nav', ['model' => $model, 'active' => 'inst',]); ?>


<div class="az-dashboard-nav"> 
    <nav class="nav">

    </nav>
</div>
<div class="efris-client-view">
    <div class="col-lg-9">
        <?=
        DetailView::widget([
            'model' => $model,
            'attributes' => [
                'name',
                'brn',
                'code',
                'contact_person',
                'office_telephone',
                'mobile_tephone',
                'email:email',
                'website',
                'address',
                [
                    'attribute' => 'status',
                    'format' => 'raw',
                    'value' => function($data) {
                        return '<a href="#" class="badge badge-block badge-' . $data->clientStatus->css_class . '">' . $data->clientStatus->name . '</a>';
                    },
                    'format' => 'raw'
                ],
            ],
        ])
        ?>
    </div>
    <div class="col-lg-3">
        <?= Html::a('Update Company details', ['update', 'id' => $model->id], ['class' => 'btn btn-primary btn-block']) ?>
        <?= Html::a('New company admin', ['user/new-admin', 'id' => $model->id], ['class' => 'btn btn-info btn-block']) ?>
        <?= Html::a('Upload Logo', ['update'], ['class' => 'btn btn-secondary btn-block']) ?>

    </div>
</div>
