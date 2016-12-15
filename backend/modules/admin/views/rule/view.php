<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/**
 * @var yii\web\View              $this
 * @var mdm\admin\models\AuthItem $model
 */
$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('rbac-admin', 'Rules'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="menu-view">

    <div class="box">

        <div class="box-header with-border">
            <h3 class="box-title">
                <?= Html::a(Yii::t('rbac-admin', 'Update'), ['update', 'id' => $model->name], ['class' => 'btn btn-primary']) ?>
                <?php
                echo Html::a(Yii::t('rbac-admin', 'Delete'), ['delete', 'id' => $model->name], [
                    'class'        => 'btn btn-danger',
                    'data-confirm' => Yii::t('rbac-admin', 'Are you sure to delete this item?'),
                    'data-method'  => 'post',
                ]);
                ?>
            </h3>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                        title="Collapse">
                    <i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip"
                        title="Remove">
                    <i class="fa fa-times"></i>
                </button>
            </div>
        </div>

        <div class="box-body">
            <?php
            echo DetailView::widget([
                'model'      => $model,
                'attributes' => [
                    'name',
                    'className',
                ],
            ]);
            ?>
        </div>
    </div>
</div>