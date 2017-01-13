<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\NewsArticle */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'News Articles'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="news-article-view">
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
                    'title',
                    'summary',
                    [
                        'label' => Yii::t('backend', 'Belong To Category'),
                        'value' => \common\models\NewsCategory::findOne($model->category_id)->name,
                    ],
                    [
                        'label'  => Yii::t('backend', 'Thumb Img'),
                        'value'  => Yii::$app->params['uploadFileUrl'] . $model->thumb_img,
                        'format' => [
                            'image',
                            [
                                // 'width'  => '84',
                                'height' => '50%',
                            ],
                        ],
                    ],
                    'hits',
                    'content:html',
                    [
                        'label' => Yii::t('backend', 'Tag'),
                        'value' => implode(', ', $model->tag),
                    ],
                    [
                        'label' => Yii::t('backend', 'Is Valid'),
                        'value' => ($model->is_valid == \common\models\NewsArticle::IS_VALID) ? Yii::t('backend', 'Publish') : Yii::t('backend', 'Unpublish'),
                    ],
                    'created_at:datetime',
                    'updated_at:datetime',
                ],
            ]) ?>

        </div>
    </div>
</div>