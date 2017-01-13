<?php

/* @var $this yii\web\View */
/* @var $model common\models\NewsCategory */

$this->title = Yii::t('backend', 'Update {modelClass}: ', [
        'modelClass' => Yii::t('backend', 'News Categories'),
    ]) . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'News Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('backend', 'Update');
?>
<div class="news-category-update">
    <?php if (Yii::$app->session->hasFlash('Warning')): ?>
        <div class="callout callout-danger">
            <h4>Warning!</h4>
            <p><?= Yii::$app->session->getFlash('Warning') ?></p>
        </div>
    <?php endif; ?>

    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title"></h3>
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
            <?= $this->render('_form', [
                'model'      => $model,
                'categories' => $categories,
            ]) ?>
        </div>
    </div>
</div>
