<?php
use yii\helpers\Html;
use common\models\client\LoanAmortization;
use common\models\loan\LedgerTransactionConfig;
use common\models\loan\LedgerHelper;
use nullref\datatable\DataTable;
use yii\helpers\Url;

$this->title = 'Loan Ref: '.$model->reference_number;
$this->params['investment_id'] = $model->id;
//Top Right button
$this->params['topright_button'] = true;
$this->params['topright_button_label'] = 'Download';
$this->params['topright_button_link'] = ['loan/download-payment-history','id'=>$model->id];
$this->params['topright_button_class'] = 'btn-primary pull-right';
?>

<p>
    <?= Html::button('Record Payment', ['class' => 'pull-right btn btn-primary','onclick'=>'makePayment()']) ?>
</p>

    <?php
    echo DataTable::widget([
        'data' => $model->ledgerEntries,
        'tableOptions' => ['class' => 'table table-striped', 'style' => 'width: 100%'],
        'id' => 'payment_history',
        'columns' => [
            ['attribute' => 'checkboxField', 'title' => ''],
            ['attribute' => 'entry_reference', 'title' => 'REF'],
            ['attribute' => 'description', 'title' => 'Description'],
            ['attribute' => 'due_date', 'title' => 'Due Date',],
            ['attribute' => 'transactionDate', 'title' => 'Recorded At',],
            ['attribute' => 'transactionAmount', 'title' => 'Amount'],
            ['attribute' => 'statusButton', 'title' => 'Status'],
        ],
    ]);
    ?>
    <script>
    function getSelectedRows() {
        return $('input:checked').map(function () {
            return this.value;
        }).get();
    }
    
    //Selected Records
    function getSelectedRecords(_keys) {
        let selected_values = [];
        for (i = 0; i < _keys.length; i++) {
            var _value = $('#row' + _keys[i]).val();
            selected_values.push(_value);
        }
        return selected_values;
    }

    /**
    * Make payment
    */
    function makePayment() {
        var keys = getSelectedRows();
        if (keys.length > 0) {
            var id = getSelectedRecords(keys);
            };
            //Remove null values
            var filteredKeys = id.filter(function (el) {
                return el != null;
            });
           return  location.href="<?= Url::to(['loan/make-payment','id'=>$model->id]); ?>&ledger="+filteredKeys;
    }
    </script>