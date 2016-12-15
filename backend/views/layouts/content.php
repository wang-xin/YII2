<?php
/**
 * Created by PhpStorm.
 * User: King
 * Date: 2016/12/15
 * Time: 15:22
 */
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <?php
            if ($this->title !== null) {
                echo \yii\helpers\Html::encode($this->title);
            } else {
                echo \yii\helpers\Inflector::camel2words(
                    \yii\helpers\Inflector::id2camel($this->context->module->id)
                );
                echo ($this->context->module->id !== \Yii::$app->id) ? '<small>Module</small>' : '';
            } ?>
        </h1>

        <?=
        \yii\widgets\Breadcrumbs::widget(
            [
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]
        ) ?>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <?= $content ?>
        <!-- /.box -->
    </section>
    <!-- /.content -->
</div>
