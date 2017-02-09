<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\searchs\NewsArticle */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('backend', 'News Articles');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="news-article-index">
    <div class="box">

        <div class="box-header with-border">
            <h3 class="box-title">
                <?= Html::a(Yii::t('backend', 'Create News Article'), ['create'], ['class' => 'btn btn-success']) ?>
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

            <?php Pjax::begin(); ?>
            <?= GridView::widget([
                'layout'       => "{items}\n{summary}{pager}",
                'dataProvider' => $dataProvider,
                'filterModel'  => $searchModel,
                'columns'      => [
                    ['class' => 'yii\grid\SerialColumn'],

                    [
                        'attribute'     => 'id',
                        'headerOptions' => ['width' => '120'],
                    ],
                    'title',
                    [
                        'attribute'     => 'category_id',
                        'label'         => Yii::t('backend', 'Belong To Category'),
                        'value'         => function ($model) {
                            return \common\models\NewsCategory::findOne($model->category_id)->name;
                        },
                        'filter'        => $categories,
                        'headerOptions' => ['width' => '200'],
                    ],
                    [
                        'attribute'     => 'summary',
                        'value'         => function ($model) {
                            return \common\helpers\String::msubstr($model->summary, 0, 45);
                        },
                    ],
                    [
                        'attribute'     => 'hits',
                        'headerOptions' => ['width' => '120'],
                    ],
                    [
                        'attribute' => 'created_at',
                        'value'     => function ($model) {
                            return date('Y-m-d H:i:s', $model->created_at);
                        },
                        'filter'    => \kartik\date\DatePicker::widget([
                            'name'          => 'NewsArticle[created_at]',
                            'type'          => \kartik\date\DatePicker::TYPE_INPUT,
                            'value'         => $searchModel->created_at,
                            'pluginOptions' => [
                                'autoclose' => true,
                                'format'    => 'yyyy-mm-dd',
                            ],
                        ]),
                    ],

                    ['class' => 'backend\widgets\ActionColumn'],
                ],
            ]); ?>
            <?php Pjax::end(); ?>
        </div>
    </div>
</div>
