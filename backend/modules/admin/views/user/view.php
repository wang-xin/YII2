<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\modules\admin\components\Helper;

/* @var $this yii\web\View */
/* @var $model backend\modules\admin\models\User */

$this->title = $model->username;
$this->params['breadcrumbs'][] = ['label' => Yii::t('rbac-admin', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$controllerId = $this->context->uniqueId . '/';
?>
<div class="menu-view">

    <div class="box">

        <div class="box-header with-border">
            <h3 class="box-title">
                <?php
                if ($model->status == 0 && Helper::checkRoute($controllerId . 'activate')) {
                    echo Html::a(Yii::t('rbac-admin', 'Activate'), ['activate', 'id' => $model->id], [
                        'class' => 'btn btn-primary',
                        'data'  => [
                            'confirm' => Yii::t('rbac-admin', 'Are you sure you want to activate this user?'),
                            'method'  => 'post',
                        ],
                    ]);
                }
                ?>
                <?php
                if (Helper::checkRoute($controllerId . 'delete')) {
                    echo Html::a(Yii::t('rbac-admin', 'Delete'), ['delete', 'id' => $model->id], [
                        'class' => 'btn btn-danger',
                        'data'  => [
                            'confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
                            'method'  => 'post',
                        ],
                    ]);
                }
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

            <?=
            DetailView::widget([
                'model'      => $model,
                'attributes' => [
                    'username',
                    'email:email',
                    'created_at:date',
                    'status',
                ],
            ])
            ?>

        </div>
    </div>
</div>
