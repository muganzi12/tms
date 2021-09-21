<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;

$this->title = "Chart of Accounts";
//Page descrition
$this->params['page_description'] = 'Chart of Accounts';
//Top Right button
$this->params['topright_button'] = false;
$this->params['topright_button_label'] = 'New Account';
$this->params['topright_button_link'] = ['account/add-new-account'];
$this->params['topright_button_class'] = 'btn btn-outline-success my-2 my-sm-0';
?>
<div class="row">
    <table class="table table-striped border-bottom mb-0">
        <thead>
            <tr>
                <th style="width: 80px;">Code</th>
                <th>Account Name</th>
                <th>Type</th>
                <th>Description</th>
                <th>&nbsp;</th>
            </tr>
        </thead>
        <tbody class="list" id="products">
            <?php foreach($chart AS $coa){ ?>
                <tr>
                    <td>
                        <div class="badge badge-soft-dark" style='font-size:110%;'><?= $coa->gl_code; ?></div>
                    </td>
                    <td>
                        <?php switch($coa->category){
                            case "ROOT":
                                echo '<span style="color:#000;font-weight:bold;font-size:110%;">'.strtoupper($coa->account_name)."</span>";
                                break;
                            case "HEADER":
                                $icon='<i class="material-icons">folder</i>';
                                echo '<span style="color:#6A6465;font-weight:800;">&nbsp;'.$icon.'&nbsp;'.strtoupper($coa->account_name)."</span>";                               
                                break;
                            case "DETAIL":
                                $icon='<i class="material-icons">remove</i>';
                                $indent= str_repeat('&nbsp;&nbsp;',$coa->level);
                                echo '<div style="color:#0A259B;font-size:100%;">'.$indent.$icon.''.$coa->account_name."</div>";
                                break;   
                            }?>
                    </td>
                    <td>
                        <?= strtoupper($coa->type->name); ?>
                    </td>
                    <td> <?= $coa->description; ?></td>
                    <td>
                        <?php if($coa->category=="DETAIL"){ ?>
                        <a href="<?= Url::to(['account/update','id'=>$coa->id]);?>" class="btn btn-sm btn-primary">EDIT</a>
                        <?php } ?>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>