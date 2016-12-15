<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\modules\admin\components\RouteRule;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $searchModel backend\modules\admin\models\searchs\AuthItem */
/* @var $context backend\modules\admin\components\ItemController */

$context = $this->context;
$labels = $context->labels();
$this->title = Yii::t('rbac-admin', $labels['Items']);
$this->params['breadcrumbs'][] = $this->title;

$rules = array_keys(Yii::$app->getAuthManager()->getRules());
$rules = array_combine($rules, $rules);
unset($rules[RouteRule::RULE_NAME]);
?>
<div class="box">

    <div class="box-header with-border">
        <h3 class="box-title">
            <?= Html::a(Yii::t('rbac-admin', 'Create ' . $labels['Item']), ['create'], ['class' => 'btn btn-success']) ?>
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
        <?=
        GridView::widget([
            'layout' => "{items}\n{summary}{pager}",
            'dataProvider' => $dataProvider,
            'filterModel'  => $searchModel,
            'columns'      => [
                ['class' => 'yii\grid\SerialColumn'],
                [
                    'attribute' => 'name',
                    'label'     => Yii::t('rbac-admin', 'Name'),
                ],
                [
                    'attribute' => 'ruleName',
                    'label'     => Yii::t('rbac-admin', 'Rule Name'),
                    'filter'    => $rules,
                ],
                [
                    'attribute' => 'description',
                    'label'     => Yii::t('rbac-admin', 'Description'),
                ],
                ['class' => 'yii\grid\ActionColumn',],
            ],
        ])
        ?>
    </div>
</div>
