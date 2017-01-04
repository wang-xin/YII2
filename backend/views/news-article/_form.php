<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\NewsArticle */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="news-article-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'category_id')->textInput()->label(Yii::t('backend', 'Belong To Category')) ?>

    <?= $form->field($model, 'summary')->textarea(['rows' => 3]) ?>

    <?= $form->field($model, 'thumb_img')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'content')->widget(\common\widgets\ueditor\Ueditor::className(), [
        'options'=>[
            'initialFrameWidth' => '100%',
            'initialFrameHeight' => '500',
        ]
    ]) ?>

    <?= $form->field($model, 'tag')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('backend', 'Create') : Yii::t('backend', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
