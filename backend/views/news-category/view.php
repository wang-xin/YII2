<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\NewsCategory */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'News Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="news-category-view">
    <div class="box">

        <div class="box-header with-border">
            <h3 class="box-title">
                <?= Html::a(Yii::t('backend', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                <?= Html::a(Yii::t('backend', 'Delete'), ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data'  => [
                        'confirm' => Yii::t('backend', 'Are you sure you want to delete this item?'),
                        'method'  => 'post',
                    ],
                ]) ?>
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

            <?= DetailView::widget([
                'model'      => $model,
                'attributes' => [
                    'id',
                    'name',
                    [
                        'label' => 'parent_id',
                        'value' => $model->parent_id ? $model->getCategoryById($model->parent_id)->name : Yii::t('backend', 'Top category'),
                    ],
                    'remark',
                    'sort',
                    [
                        'label'  => 'status',
                        'value'  => ($model->status == \common\models\NewsCategory::STATUS_ENABLED) ?
                            '<span class="label label-danger">' . Yii::t('backend', 'Status Disabled') . '</span>' :
                            '<span class="label label-success">' . Yii::t('backend', 'Status Enabled') . '</span>',
                        'format' => 'raw',
                    ],
                ],
            ]) ?>

        </div>
    </div>
</div>
