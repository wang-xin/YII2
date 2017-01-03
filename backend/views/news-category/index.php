<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use common\models\NewsCategory;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\searchs\NewsCategory */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('backend', 'News Categories');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box">

    <div class="box-header with-border">
        <h3 class="box-title">
            <?= Html::a(Yii::t('backend', 'Create News Category'), ['create'], ['class' => 'btn btn-success']) ?>
        </h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
                <i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                <i class="fa fa-times"></i>
            </button>
        </div>
    </div>
    <div class="box-body">
        <?php Pjax::begin(); ?>
        <?= GridView::widget([
            'layout'       => "{items}\n{summary}{pager}",
            'dataProvider' => $dataProvider,
            'filterModel'  => $searchModel,
            'columns'      => [
                ['class' => 'yii\grid\SerialColumn'],

                'id',
                'name',
                'parent_id',
                'sort',
                'created_at',
                [
                    'attribute' => 'status',
                    'value'     => function ($model) {
                        return $model->status == NewsCategory::STATUS_DISABLED ? Yii::t('backend', 'Disabled') : Yii::t('backend', 'Status Enabled');
                    },
                    'filter'    => [
                        NewsCategory::STATUS_DISABLED => Yii::t('backend', 'Status Disabled'),
                        NewsCategory::STATUS_ENABLED  => Yii::t('backend', 'Status Enabled'),
                    ],
                ],
                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]); ?>
        <?php Pjax::end(); ?>
    </div>
</div>
