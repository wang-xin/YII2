<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\NewsArticle */

$this->title = Yii::t('backend', 'Update {modelClass}: ', [
        'modelClass' => 'News Article',
    ]) . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'News Articles'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('backend', 'Update');
?>
<div class="news-article-update">

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
                'model' => $model,
            ]) ?>

        </div>
    </div>
</div>