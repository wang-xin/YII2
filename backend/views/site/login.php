<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use backend\assets\AppAsset;

AppAsset::register($this);

AppAsset::addCss($this, 'statics/plugins/iCheck/square/blue.css');
AppAsset::addScript($this, 'statics/plugins/iCheck/icheck.js');

$this->title = Yii::t('common', 'Login');

$fieldOptions1 = [
    'options'       => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-envelope form-control-feedback'></span>",
];
$fieldOptions2 = [
    'options'       => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-lock form-control-feedback'></span>",
];

$this->registerCss('.checkbox label{padding-left:0}');
?>
<div class="login-box-body">

    <?php $form = \yii\bootstrap\ActiveForm::begin(); ?>

    <?= $form->field($model, 'username', $fieldOptions1)->label(false)->textInput(['placeholder' => $model->getAttributeLabel('username')]) ?>

    <?= $form->field($model, 'password', $fieldOptions2)->label(false)->passwordInput(['placeholder' => $model->getAttributeLabel('password')]) ?>

    <div class="row">
        <div class="col-xs-8">
            <?= $form->field($model, 'rememberMe')->checkbox() ?>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
            <?= \yii\helpers\Html::submitButton(Yii::t('common', 'Sign In'), ['class' => 'btn btn-primary btn-block btn-flat']) ?>
        </div>
        <!-- /.col -->
    </div>
    <?php \yii\bootstrap\ActiveForm::end(); ?>

</div>
<!-- /.login-box-body -->

<?php $this->beginBlock("iCheck") ?>
$(function () {
    $('input').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
        increaseArea: '20%'
    });
});
<?php $this->endBlock() ?>

<?php $this->registerJs($this->blocks["iCheck"], \yii\web\View::POS_END); ?>
