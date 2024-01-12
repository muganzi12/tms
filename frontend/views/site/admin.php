<?php
use yii\helpers\Url;
$this->title = "System Administration";
?>
<div class="container-fluid page__container">
                            <div class="row card-group-row">
                                <div class="col-lg-3 col-md-4 card-group-row__col">
                                    <div class="card card-group-row__card">
                                        <div class="p-2 d-flex flex-row align-items-center">
                                            <div class="avatar avatar-xs mr-2">
                                                <span class="avatar-title rounded-circle text-center bg-primary">
                                                    <i class="material-icons text-white icon-18pt">business</i>
                                                </span>
                                            </div>
                                            <a href="<?=Url::to(['account/index']);?>" class="text-dark">
                                                <span>Chart of Accounts</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-4 card-group-row__col">
                                    <div class="card card-group-row__card">
                                        <div class="p-2 d-flex flex-row align-items-center">

                                            <div class="avatar avatar-xs mr-2">
                                                <span class="avatar-title rounded-circle text-center bg-primary">
                                                    <i class="material-icons text-white icon-18pt">account_balance</i>
                                                </span>
                                            </div>
                                            <a href="<?=Url::to(['property-unit/index']);?>" class="text-dark">
                                                <span>Property Units</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-4 card-group-row__col">
                                    <div class="card card-group-row__card">
                                        <div class="p-2 d-flex flex-row align-items-center">
                                            <div class="avatar avatar-xs mr-2">
                                                <span class="avatar-title rounded-circle text-center bg-success">
                                                    <i class="material-icons text-white icon-18pt">receipt</i>
                                                </span>
                                            </div>
                                            <a href="<?=Url::to(['property-type/index']);?>" class="text-dark">
                                                <span>Property Type</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-4 card-group-row__col">
                                    <div class="card card-group-row__card">
                                        <div class="p-2 d-flex flex-row align-items-center">
                                            <div class="avatar avatar-xs mr-2">
                                                <span class="avatar-title rounded-circle text-center bg-info">
                                                    <i class="material-icons text-white icon-18pt">monetization_on</i>
                                                </span>
                                            </div>
                                            <a href="<?=Url::to(['user/index']);?>" class="text-dark">
                                                <span>System User Accounts</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-4 card-group-row__col">
                                    <div class="card card-group-row__card">
                                        <div class="p-2 d-flex flex-row align-items-center">
                                            <div class="avatar avatar-xs mr-2">
                                                <span class="avatar-title rounded-circle text-center bg-blue">
                                                    <i class="material-icons text-white icon-18pt">shop</i>
                                                </span>
                                            </div>
                                            <a href="<?=Url::to(['user/user-groups']);?>" class="text-dark">
                                                <span>User Groups</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-4 card-group-row__col">
                                    <div class="card card-group-row__card">
                                        <div class="p-2 d-flex flex-row align-items-center">
                                            <div class="avatar avatar-xs mr-2">
                                                <span class="avatar-title rounded-circle text-center bg-warning">
                                                    <i class="material-icons text-white icon-18pt">account_balance</i>
                                                </span>
                                            </div>
                                            <a href="#" class="text-dark">
                                                <span>Access Levels</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-4 card-group-row__col">
                                    <div class="card card-group-row__card">
                                        <div class="p-2 d-flex flex-row align-items-center">
                                            <div class="avatar avatar-xs mr-2">
                                                <span class="avatar-title rounded-circle text-center bg-primary">
                                                    <i class="material-icons text-white icon-18pt">assignment</i>
                                                </span>
                                            </div>
                                            <a href="<?=Url::to(['property/index']);?>" class="text-dark">
                                                <span>Properties</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-4 card-group-row__col">
                                    <div class="card card-group-row__card">
                                        <div class="p-2 d-flex flex-row align-items-center">
                                            <div class="avatar avatar-xs mr-2">
                                                <span class="avatar-title rounded-circle text-center bg-danger">
                                                    <i class="material-icons text-white icon-18pt">phone</i>
                                                </span>
                                            </div>
                                            <a href="#" class="text-dark">
                                                <span>Fees and Rates</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
</div>

                                <h2 style="border-bottom:3px solid #ccc;margin-bottom:10px;">Chart of accounts and Ledger Transactions</h2>
                                <div class="row card-group-row">
                                <div class="col-lg-3 col-md-4 card-group-row__col">
                                    <div class="card card-group-row__card">
                                        <div class="p-2 d-flex flex-row align-items-center">
                                            <div class="avatar avatar-xs mr-2">
                                                <span class="avatar-title rounded-circle text-center bg-primary">
                                                    <i class="material-icons text-white icon-18pt">business</i>
                                                </span>
                                            </div>
                                            <a href="<?=Url::to(['account/index']);?>" class="text-dark">
                                                <span>Chart of Accounts</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-4 card-group-row__col">
                                    <div class="card card-group-row__card">
                                        <div class="p-2 d-flex flex-row align-items-center">
                                            <div class="avatar avatar-xs mr-2">
                                                <span class="avatar-title rounded-circle text-center bg-primary">
                                                    <i class="material-icons text-white icon-18pt">assignment</i>
                                                </span>
                                            </div>
                                            <a href="<?=Url::to(['ledger-config/index']);?>" class="text-dark">
                                                <span>Transaction Accounts Configurations</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-4 card-group-row__col">
                                    <div class="card card-group-row__card">
                                        <div class="p-2 d-flex flex-row align-items-center">
                                            <div class="avatar avatar-xs mr-2">
                                                <span class="avatar-title rounded-circle text-center bg-success">
                                                    <i class="material-icons text-white icon-18pt">receipt</i>
                                                </span>
                                            </div>
                                            <a href="<?=Url::to(['transaction-type/index']);?>" class="text-dark">
                                                <span>Transaction Types</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-4 card-group-row__col">
                                    <div class="card card-group-row__card">
                                        <div class="p-2 d-flex flex-row align-items-center">
                                            <div class="avatar avatar-xs mr-2">
                                                <span class="avatar-title rounded-circle text-center bg-info">
                                                    <i class="material-icons text-white icon-18pt">monetization_on</i>
                                                </span>
                                            </div>
                                            <a href="<?=Url::to(['user/index']);?>" class="text-dark">
                                                <span>System User Accounts</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
</div>
                                <h2 style="border-bottom:3px solid #ccc;margin-bottom:10px;">Master Data</h2>
                                <div class="row card-group-row">
                                <div class="col-lg-3 col-md-4 card-group-row__col">
                                    <div class="card card-group-row__card">
                                        <div class="p-2 d-flex flex-row align-items-center">
                                            <div class="avatar avatar-xs mr-2">
                                                <span class="avatar-title rounded-circle text-center bg-primary">
                                                    <i class="material-icons text-white icon-18pt">settings_applications</i>
                                                </span>
                                            </div>
                                            <a href="<?=Url::to(['district/index']);?>" class="text-dark">
                                                <span>Districts</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-4 card-group-row__col">
                                    <div class="card card-group-row__card">
                                        <div class="p-2 d-flex flex-row align-items-center">
                                            <div class="avatar avatar-xs mr-2">
                                                <span class="avatar-title rounded-circle text-center bg-primary">
                                                    <i class="material-icons text-white icon-18pt">settings_applications</i>
                                                </span>
                                            </div>
                                            <a href="<?=Url::to(['division/index']);?>" class="text-dark">
                                                <span>Divisions</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-4 card-group-row__col">
                                    <div class="card card-group-row__card">
                                        <div class="p-2 d-flex flex-row align-items-center">
                                            <div class="avatar avatar-xs mr-2">
                                                <span class="avatar-title rounded-circle text-center bg-success">
                                                    <i class="material-icons text-white icon-18pt">settings_applications</i>
                                                </span>
                                            </div>
                                            <a href="<?=Url::to(['parish/index']);?>" class="text-dark">
                                                <span>Parishes</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-4 card-group-row__col">
                                    <div class="card card-group-row__card">
                                        <div class="p-2 d-flex flex-row align-items-center">
                                            <div class="avatar avatar-xs mr-2">
                                                <span class="avatar-title rounded-circle text-center bg-info">
                                                    <i class="material-icons text-white icon-18pt">settings_applications</i>
                                                </span>
                                            </div>
                                            <a href="<?=Url::to(['village/index']);?>" class="text-dark">
                                                <span>Villages</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-4 card-group-row__col">
                                    <div class="card card-group-row__card">
                                        <div class="p-2 d-flex flex-row align-items-center">
                                            <div class="avatar avatar-xs mr-2">
                                                <span class="avatar-title rounded-circle text-center bg-info">
                                                    <i class="material-icons text-white icon-18pt">settings_applications</i>
                                                </span>
                                            </div>
                                            <a href="<?=Url::to(['street/index']);?>" class="text-dark">
                                                <span>Streets</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-4 card-group-row__col">
                                    <div class="card card-group-row__card">
                                        <div class="p-2 d-flex flex-row align-items-center">
                                            <div class="avatar avatar-xs mr-2">
                                                <span class="avatar-title rounded-circle text-center bg-info">
                                                    <i class="material-icons text-white icon-18pt">settings_applications</i>
                                                </span>
                                            </div>
                                            <a href="<?=Url::to(['master-data/index', 'tbl' => 'relationship']);?>" class="text-dark">
                                                <span>Relationship Type</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-4 card-group-row__col">
                                    <div class="card card-group-row__card">
                                        <div class="p-2 d-flex flex-row align-items-center">
                                            <div class="avatar avatar-xs mr-2">
                                                <span class="avatar-title rounded-circle text-center bg-info">
                                                    <i class="material-icons text-white icon-18pt">settings_applications</i>
                                                </span>
                                            </div>
                                            <a href="<?=Url::to(['master-data/index', 'tbl' => 'relationship']);?>" class="text-dark">
                                                <span>Relationship</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-4 card-group-row__col">
                                    <div class="card card-group-row__card">
                                        <div class="p-2 d-flex flex-row align-items-center">
                                            <div class="avatar avatar-xs mr-2">
                                                <span class="avatar-title rounded-circle text-center bg-info">
                                                    <i class="material-icons text-white icon-18pt">settings_applications</i>
                                                </span>
                                            </div>
                                            <a href="<?=Url::to(['master-data/index', 'tbl' => 'account_type']);?>" class="text-dark">
                                                <span>Account Type</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-4 card-group-row__col">
                                    <div class="card card-group-row__card">
                                        <div class="p-2 d-flex flex-row align-items-center">
                                            <div class="avatar avatar-xs mr-2">
                                                <span class="avatar-title rounded-circle text-center bg-info">
                                                    <i class="material-icons text-white icon-18pt">settings_applications</i>
                                                </span>
                                            </div>
                                            <a href="<?=Url::to(['master-data/index', 'tbl' => 'currency']);?>" class="text-dark">
                                                <span>Currency</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-4 card-group-row__col">
                                    <div class="card card-group-row__card">
                                        <div class="p-2 d-flex flex-row align-items-center">
                                            <div class="avatar avatar-xs mr-2">
                                                <span class="avatar-title rounded-circle text-center bg-info">
                                                    <i class="material-icons text-white icon-18pt">settings_applications</i>
                                                </span>
                                            </div>
                                            <a href="<?=Url::to(['master-data/index', 'tbl' => 'currency']);?>" class="text-dark">
                                                <span>Property Type</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-4 card-group-row__col">
                                    <div class="card card-group-row__card">
                                        <div class="p-2 d-flex flex-row align-items-center">
                                            <div class="avatar avatar-xs mr-2">
                                                <span class="avatar-title rounded-circle text-center bg-info">
                                                    <i class="material-icons text-white icon-18pt">settings_applications</i>
                                                </span>
                                            </div>
                                            <a href="<?=Url::to(['master-data/index', 'tbl' => 'client_type']);?>" class="text-dark">
                                                <span>Client Type</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-4 card-group-row__col">
                                    <div class="card card-group-row__card">
                                        <div class="p-2 d-flex flex-row align-items-center">
                                            <div class="avatar avatar-xs mr-2">
                                                <span class="avatar-title rounded-circle text-center bg-info">
                                                    <i class="material-icons text-white icon-18pt">settings_applications</i>
                                                </span>
                                            </div>
                                            <a href="<?=Url::to(['master-data/index', 'tbl' => 'issue_type']);?>" class="text-dark">
                                                <span>Issue Type</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>