<?php
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\depdrop\DepDrop;
use yii\helpers\Url;
?>
<div class="ledger-transaction-config-form">
    <?php $form = ActiveForm::begin(); ?>
<table class="table">
    <tr>
        <td colspan="2">
        <?php echo $form->field($model, 'transaction_name')->textInput(['maxlength' => true]); ?>
        </td>
</tr>
<tr>
    <td>
     <?php echo $form->field($model, 'is_primary')->textInput(); ?>        
    </td>
    <td>
     <?php echo $form->field($model, 'parent_id')->textInput(); ?>        
    </td>
</tr>
<tr>
    <td>
    <?php
                echo $form->field($model, 'debit_account')->widget(Select2::classname(), [
                    'value' => '',
                    'theme' => Select2::THEME_CLASSIC,
                    'data' => ArrayHelper::map($chartofaccounts, 'gl_code', 'fullAccountName', 'type.name'),
                    'options' => [
                        'placeholder' => 'Select Debit Account',
                        'class' => 'form-control',
                        'multiple' => false,
                        'required' => true,
                    ],
                ]);
                ?>
</td>
<td>
<?php
                echo $form->field($model, 'credit_account')->widget(Select2::classname(), [
                    'value' => '',
                    'theme' => Select2::THEME_CLASSIC,
                    'data' => ArrayHelper::map($chartofaccounts, 'gl_code', 'fullAccountName', 'type.name'),
                    'options' => [
                        'placeholder' => 'Select Credit Account',
                        'class' => 'form-control',
                        'multiple' => false,
                        'required' => true,
                    ],
                ]);
                ?>
</td>
</tr>
<tr>
    <td>
 <?php echo $form->field($model, 'product_type')->dropDownList(
     ['LOAN' => 'Loans',
      'INVESTMENT' => 'Investments',
      'ADMIN' => 'Company Administration'
    ], 
       ['prompt' => 'Select Product Type','id'=>'config_product_type']); ?>
   </td>
    <td>
        <?php
        echo $form->field($model, 'product_id')->widget(DepDrop::classname(), [
           'pluginOptions'=>[
                'depends'=>['config_product_type'],
                'placeholder'=>'Select...',
                'url'=>Url::to(['/ledger-config/products'])
            ]
        ]);
    ?>
    </td>
</tr>
<tr>
    <td>
            <?php echo $form->field($model, 'amount_rule')->dropDownList(['FLEXIBLE' => 'FLEXIBLE', 'FIXED' => 'FIXED', 'PERCENTAGE' => 'PERCENTAGE'], ['prompt' => '']); ?>
            </td>
            <td>
                  <?php echo $form->field($model, 'amount')->textInput(['maxlength' => true]); ?>
            </td>
            </tr>
            <tr>
                <td colspan='2'>
                <?php echo $form->field($model, 'description')->textArea(['rows' => 2]); ?>
                </td>
            </tr>
            <tr>
                <td>
    <?php echo Html::submitButton('Save', ['class' => 'btn btn-success btn-block']); ?>
                </td>
                <td>
    <?php echo $form->field($model, 'created_at')->hiddenInput()->label(false); ?>
    <?php echo $form->field($model, 'created_by')->hiddenInput()->label(false); ?>
    <?php echo $form->field($model, 'updated_by')->hiddenInput()->label(false); ?>
    <?php echo $form->field($model, 'updated_at')->hiddenInput()->label(false); ?>
            </td>
            </tr>
</table>
    <?php ActiveForm::end(); ?>
</div>
