<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Json;
use backend\modules\admin\AnimateAsset;
use yii\web\YiiAsset;

/* @var $this yii\web\View */
/* @var $model mdm\admin\models\AuthItem */
/* @var $context mdm\admin\components\ItemController */

$context = $this->context;
$labels = $context->labels();
$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('rbac-admin', $labels['Items']), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

AnimateAsset::register($this);
YiiAsset::register($this);
$opts = Json::htmlEncode([
    'items' => $model->getItems(),
]);
$this->registerJs("var _opts = {$opts};");
$this->registerJs($this->render('_script.js'));
$animateIcon = ' <i class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></i>';
?>
<div class="menu-view">

    <div class="box">

        <div class="box-header with-border">
            <h3 class="box-title">
                <?= Html::a(Yii::t('rbac-admin', 'Update'), ['update', 'id' => $model->name], ['class' => 'btn btn-primary']) ?>
                <?= Html::a(Yii::t('rbac-admin', 'Delete'), ['delete', 'id' => $model->name], [
                    'class'        => 'btn btn-danger',
                    'data-confirm' => Yii::t('rbac-admin', 'Are you sure to delete this item?'),
                    'data-method'  => 'post',
                ]); ?>
                <?= Html::a(Yii::t('rbac-admin', 'Create'), ['create'], ['class' => 'btn btn-success']) ?>
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
            <div class="row">
                <div class="col-sm-11">
                    <?=
                    DetailView::widget([
                        'model'      => $model,
                        'attributes' => [
                            'name',
                            'description:ntext',
                            'ruleName',
                            'data:ntext',
                        ],
                        'template'   => '<tr><th style="width:25%">{label}</th><td>{value}</td></tr>',
                    ]);
                    ?>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-5">
                    <input class="form-control search" data-target="avaliable"
                           placeholder="<?= Yii::t('rbac-admin', 'Search for avaliable') ?>">
                    <select multiple size="20" class="form-control list" data-target="avaliable"></select>
                </div>
                <div class="col-sm-1">
                    <br><br>
                    <?= Html::a('&gt;&gt;' . $animateIcon, ['assign', 'id' => $model->name], [
                        'class'       => 'btn btn-success btn-assign',
                        'data-target' => 'avaliable',
                        'title'       => Yii::t('rbac-admin', 'Assign'),
                    ]) ?><br><br>
                    <?= Html::a('&lt;&lt;' . $animateIcon, ['remove', 'id' => $model->name], [
                        'class'       => 'btn btn-danger btn-assign',
                        'data-target' => 'assigned',
                        'title'       => Yii::t('rbac-admin', 'Remove'),
                    ]) ?>
                </div>
                <div class="col-sm-5">
                    <input class="form-control search" data-target="assigned"
                           placeholder="<?= Yii::t('rbac-admin', 'Search for assigned') ?>">
                    <select multiple size="20" class="form-control list" data-target="assigned"></select>
                </div>
            </div>
        </div>
    </div>
</div>