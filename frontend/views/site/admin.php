<?php
use yii\helpers\Url;
$this->title="System Administration";
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
                                            <a href="<?= Url::to(['account/index']); ?>" class="text-dark">
                                                <strong>Chart of Accounts</strong>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-4 card-group-row__col">
                                    <div class="card card-group-row__card">
                                        <div class="p-2 d-flex flex-row align-items-center">
                                            <div class="avatar avatar-xs mr-2">
                                                <span class="avatar-title rounded-circle text-center">
                                                    <i class="material-icons text-white icon-18pt">person_add</i>
                                                </span>
                                            </div>
                                            <a href="<?= Url::to(['loan-product/index']);?>" class="text-dark">
                                                <strong>Loan Products</strong>
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
                                            <a href="<?= Url::to(['branch/index']);?>" class="text-dark">
                                                <strong>Branches</strong>
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
                                            <a href="<?= Url::to(['user/index']);?>" class="text-dark">
                                                <strong>System User Accounts</strong>
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
                                            <a href="<?= Url::to(['user/user-groups']);?>" class="text-dark">
                                                <strong>User Groups</strong>
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
                                                <strong>Access Levels</strong>
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
                                            <a href="#" class="text-dark">
                                                <strong>Transaction Accounts Configurations</strong>
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
                                                <strong>Fees and Rates</strong>
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
                                            <a href="<?= Url::to(['account/index']); ?>" class="text-dark">
                                                <strong>Chart of Accounts</strong>
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
                                            <a href="<?= Url::to(['ledger-config/index']);?>" class="text-dark">
                                                <strong>Transaction Accounts Configurations</strong>
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
                                            <a href="<?= Url::to(['transaction-type/index']);?>" class="text-dark">
                                                <strong>Transaction Types</strong>
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
                                            <a href="<?= Url::to(['user/index']);?>" class="text-dark">
                                                <strong>System User Accounts</strong>
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
                                            <a href="<?= Url::to(['master-data/index','tbl'=>'status']); ?>" class="text-dark">
                                                <strong>Record Status</strong>
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
                                            <a href="<?= Url::to(['master-data/index','tbl'=>'identification_type']); ?>" class="text-dark">
                                                <strong>Identification Category</strong>
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
                                            <a href="<?= Url::to(['master-data/index','tbl'=>'sex']); ?>" class="text-dark">
                                                <strong>Gender</strong>
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
                                            <a href="<?= Url::to(['master-data/index','tbl'=>'marital_status']); ?>" class="text-dark">
                                                <strong>Marital Status</strong>
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
                                            <a href="<?= Url::to(['master-data/index','tbl'=>'membership_type']); ?>" class="text-dark">
                                                <strong>Membership Type</strong>
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
                                            <a href="<?= Url::to(['master-data/index','tbl'=>'relationship']); ?>" class="text-dark">
                                                <strong>Relationship Type</strong>
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
                                            <a href="<?= Url::to(['master-data/index','tbl'=>'relationship']); ?>" class="text-dark">
                                                <strong>Relationship</strong>
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
                                            <a href="<?= Url::to(['master-data/index','tbl'=>'account_type']); ?>" class="text-dark">
                                                <strong>Account Type</strong>
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
                                            <a href="<?= Url::to(['master-data/index','tbl'=>'currency']); ?>" class="text-dark">
                                                <strong>Currency</strong>
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
                                            <a href="<?= Url::to(['master-data/index','tbl'=>'currency']); ?>" class="text-dark">
                                                <strong>Type of Collateral</strong>
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
                                            <a href="<?= Url::to(['master-data/index','tbl'=>'client_type']); ?>" class="text-dark">
                                                <strong>Client Type</strong>
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
                                            <a href="<?= Url::to(['master-data/index','tbl'=>'amortization_method']); ?>" class="text-dark">
                                                <strong>Armortization Method</strong>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>