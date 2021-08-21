<?php
use yii\helpers\Url;
use yii\helpers\Html;
//use common\models\client\Loan;

$loan_id = $this->params['loan_id'];

// $loan = Loan::findOne($loan_id);
?>
<?php $this->beginContent('@frontend/views/layouts/main.php'); ?>
<div class="container-fluid page__container">
    <div class="row">
        <div class="col-lg-8"> 
            <?= $content; ?>
        </div>
        <div class="col-lg-4">
        <div class="card card-margin-md-negative-40">
            <ul class="list-group list-group-flush">
                <li class="list-group-item bg-light">
                    <a href="profile.html" class="flex d-flex align-items-center text-body text-underline-0">
                        <span class="avatar mr-3">
                            <img src="<?= Url::base(true);?>/flowdash/assets/images/avatar/demi.png" alt="avatar" class="avatar-img rounded-circle">
                        </span>
                    <span class="flex d-flex flex-column">
                        <strong>Adrian Demian</strong>
                            <small class="text-muted text-uppercase">APPLICANT</small>
                        </span>
                    </a>
                </li>

                <li class="list-group-item">
                    <strong>3872 people</strong> <span class="text-muted">completed this course</span>
                </li>
            </ul>
        </div>

        <ul class="list-group" style="margin-top:20px;margin-bottom:20px;">
            <li class="list-group-item"><b>
                <?= Html::a('<i class="material-icons">create</i> Update loan details',['client/update','id'=>$loan_id], ['class' => '']); ?>
            </b></li>
            <li class="list-group-item"><b>
                <?= Html::a('<i class="material-icons">add_circle</i> Add guarrantor',['client/view','id'=>$loan_id], ['class' => '']); ?>
            </b></li>
            <li class="list-group-item"><b>
                <?= Html::a('<i class="material-icons">attach_file</i> Attach Collateral',['client/view','id'=>$loan_id], ['class' => '']); ?>
            </b></li>
            <li class="list-group-item"><b>
                <?= Html::a('<i class="material-icons">highlight_off</i> Reject Application',['client/view','id'=>$loan_id], ['class' => '']); ?>
            </b></li>
            <li class="list-group-item"><b>
                <?= Html::a('<i class="material-icons">done</i> Approve Application',['client/view','id'=>$loan_id], ['class' => '']); ?>
            </b></li>
            <li class="list-group-item"><b>
                <?= Html::a('<i class="material-icons">query_builder</i> Defer Application',['client/view','id'=>$loan_id], ['class' => '']); ?>
            </b></li>
            <li class="list-group-item"><b>
                <?= Html::a('<i class="material-icons">done_all</i> Disburse Loan',['client/view','id'=>$loan_id], ['class' => '']); ?>
            </b></li>
        </ul>

        <h4>Timeline</h4>
        <div class="card">
                                        <ul class="list-group list-lessons">
                                            <li class="list-group-item d-flex align-items-center active">

                                                <div class="avatar avatar-sm mr-3">
                                                    <span class="avatar-title rounded-circle bg-primary">1</span>
                                                </div>
                                                <div>
                                                    <a href="#">Wireframe</a>
                                                    <div class="text-muted"><i class="material-icons icon-16pt icon-light">watch_later</i> 1:42</div>
                                                </div>
                                                <div class="ml-auto d-flex align-items-center">
                                                    <span class="badge badge-success mr-2"><i class="material-icons icon-16pt">check_circle</i></span>
                                                </div>
                                            </li>
                                            <li class="list-group-item d-flex align-items-center">
                                                <div class="avatar avatar-sm mr-3">
                                                    <span class="avatar-title rounded-circle bg-secondary">2</span>
                                                </div>
                                                <div>
                                                    <a href="#">Design with Sketch</a>
                                                    <div class="text-muted"><i class="material-icons icon-16pt icon-light">watch_later</i> 1:42</div>
                                                </div>

                                            </li>
                                            <li class="list-group-item d-flex align-items-center">
                                                <div class="avatar avatar-sm mr-3">
                                                    <span class="avatar-title rounded-circle bg-secondary">3</span>
                                                </div>
                                                <div>
                                                    <a href="#">Build static HTML/CSS with Bootstrap 4</a>
                                                    <div class="text-muted"><i class="material-icons icon-16pt icon-light">watch_later</i> 1:42</div>
                                                </div>
                                            </li>
                                            <li class="list-group-item d-flex align-items-center">
                                                <div class="avatar avatar-sm mr-3">
                                                    <span class="avatar-title rounded-circle bg-secondary">4</span>
                                                </div>
                                                <div>
                                                    <a href="#">Rails New Application</a>
                                                    <div class="text-muted"><i class="material-icons icon-16pt icon-light">watch_later</i> 1:42</div>
                                                </div>
                                            </li>
                                            <li class="list-group-item d-flex align-items-center">
                                                <div class="avatar avatar-sm mr-3">
                                                    <span class="avatar-title rounded-circle bg-secondary">5</span>
                                                </div>
                                                <div>
                                                    <a href="#">Github and push your first commit.</a>
                                                    <div class="text-muted"><i class="material-icons icon-16pt icon-light">watch_later</i> 1:42</div>
                                                </div>
                                            </li>
                                            <li class="list-group-item d-flex align-items-center">
                                                <div class="avatar avatar-sm mr-3">
                                                    <span class="avatar-title rounded-circle bg-secondary">6</span>
                                                </div>
                                                <div>
                                                    <a href="#">Add Bootstrap 4 to Rails</a>
                                                    <div class="text-muted"><i class="material-icons icon-16pt icon-light">watch_later</i> 1:42</div>
                                                </div>
                                            </li>
                                            <li class="list-group-item d-flex align-items-center">
                                                <div class="avatar avatar-sm mr-3">
                                                    <span class="avatar-title rounded-circle bg-secondary">7</span>
                                                </div>
                                                <div>
                                                    <a href="#">Include Designed SASS assets</a>
                                                    <div class="text-muted"><i class="material-icons icon-16pt icon-light">watch_later</i> 1:42</div>
                                                </div>
                                            </li>
                                            <li class="list-group-item d-flex align-items-center">
                                                <div class="avatar avatar-sm mr-3">
                                                    <span class="avatar-title rounded-circle bg-secondary">8</span>
                                                </div>
                                                <div>
                                                    <a href="#">Basics of Routing</a>
                                                    <div class="text-muted"><i class="material-icons icon-16pt icon-light">watch_later</i> 1:42</div>
                                                </div>
                                            </li>
                                            <li class="list-group-item d-flex align-items-center">
                                                <div class="avatar avatar-sm mr-3">
                                                    <span class="avatar-title rounded-circle bg-secondary">9</span>
                                                </div>
                                                <div>
                                                    <a href="#">Postgres Database</a>
                                                    <div class="text-muted"><i class="material-icons icon-16pt icon-light">watch_later</i> 1:42</div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>

    </div>
</div>
</div>
<?php $this->endContent(); ?>