<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use backend\modules\admin\AnimateAsset;
use yii\web\YiiAsset;

/* @var $this yii\web\View */
/* @var $model backend\modules\admin\models\Assignment */
/* @var $fullnameField string */

$userName = $model->{$usernameField};
if (!empty($fullnameField)) {
    $userName .= ' (' . ArrayHelper::getValue($model, $fullnameField) . ')';
}
$userName = Html::encode($userName);

$this->title = Yii::t('rbac-admin', 'Assignment') . ' : ' . $userName;

$this->params['breadcrumbs'][] = ['label' => Yii::t('rbac-admin', 'Assignments'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $userName;

AnimateAsset::register($this);
YiiAsset::register($this);
$opts = Json::htmlEncode([
    'items' => $model->getItems(),
]);
$this->registerJs("var _opts = {$opts};");
$this->registerJs($this->render('_script.js'));
$animateIcon = ' <i class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></i>';
?>

<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">
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
        <div class="row" style="margin-top: 20px">
            <div class="col-sm-5">
                <input class="form-control search" data-target="avaliable"
                       placeholder="<?= Yii::t('rbac-admin', 'Search for avaliable') ?>">
                <select multiple size="20" class="form-control list" data-target="avaliable">
                </select>
            </div>
            <div class="col-sm-1">
                <br><br>
                <?= Html::a('&gt;&gt;' . $animateIcon, ['assign', 'id' => (string)$model->id], [
                    'class'       => 'btn btn-success btn-assign',
                    'data-target' => 'avaliable',
                    'title'       => Yii::t('rbac-admin', 'Assign'),
                ]) ?><br><br>
                <?= Html::a('&lt;&lt;' . $animateIcon, ['revoke', 'id' => (string)$model->id], [
                    'class'       => 'btn btn-danger btn-assign',
                    'data-target' => 'assigned',
                    'title'       => Yii::t('rbac-admin', 'Remove'),
                ]) ?>
            </div>
            <div class="col-sm-5">
                <input class="form-control search" data-target="assigned"
                       placeholder="<?= Yii::t('rbac-admin', 'Search for assigned') ?>">
                <select multiple size="20" class="form-control list" data-target="assigned">
                </select>
            </div>
        </div>
    </div>
</div>
