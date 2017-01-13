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
                [
                    'attribute' => 'parent_id',
                    'value' => function($model){
                        return $model->parent_id ? $model->getCategoryById($model->parent_id)->name : Yii::t('backend', 'Top category');
                    },
                    // 'filter' => array_merge([0 => Yii::t('backend', 'Top category')], $categories),
                    'filter' => [0 => Yii::t('backend', 'Top category')] + $categories,
                ],
                'sort',
                [
                    'attribute' => 'created_at',
                    'value'     => function ($model) {
                        return date('Y-m-d H:i:s', $model->created_at);
                    },
                    'filter'    => \kartik\date\DatePicker::widget([
                        'name'          => 'NewsCategory[created_at]',
                        'type'          => \kartik\date\DatePicker::TYPE_INPUT,
                        'value'         => $searchModel->created_at,
                        'pluginOptions' => [
                            'autoclose' => true,
                            'format'    => 'yyyy-mm-dd',
                        ],
                    ]),
                ],
                [
                    'attribute' => 'status',
                    'value'     => function ($model) {
                        return $model->status == NewsCategory::STATUS_DISABLED ?
                            '<span class="label label-danger">' . Yii::t('backend', 'Status Disabled') . '</span>' :
                            '<span class="label label-success">' . Yii::t('backend', 'Status Enabled') . '</span>';
                    },
                    'format'    => 'html',
                    'filter'    => [
                        NewsCategory::STATUS_DISABLED => Yii::t('backend', 'Status Disabled'),
                        NewsCategory::STATUS_ENABLED  => Yii::t('backend', 'Status Enabled'),
                    ],
                ],
                ['class' => 'backend\widgets\ActionColumn'],
            ],
        ]); ?>
        <?php Pjax::end(); ?>
    </div>
</div>
