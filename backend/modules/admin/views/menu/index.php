<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $searchModel backend\modules\admin\models\searchs\Menu */

$this->title = Yii::t('rbac-admin', 'Menus');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box">

    <div class="box-header with-border">
        <h3 class="box-title">
            <?= Html::a(Yii::t('rbac-admin', 'Create Menu'), ['create'], ['class' => 'btn btn-success']) ?>
        </h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                <i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                <i class="fa fa-times"></i>
            </button>
        </div>
    </div>
    <div class="box-body">
        <?php Pjax::begin(); ?>
        <?= GridView::widget([
                'layout' => "{items}\n{summary}{pager}",
                'dataProvider' => $dataProvider,
                'filterModel'  => $searchModel,
                'columns'      => [
                    ['class' => 'yii\grid\SerialColumn'],
                    'name',
                    [
                        'attribute' => 'menuParent.name',
                        'filter'    => Html::activeTextInput($searchModel, 'parent_name', [
                            'class' => 'form-control', 'id' => null,
                        ]),
                        'label'     => Yii::t('rbac-admin', 'Parent'),
                    ],
                    'route',
                    'order',
                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]);
        ?>
        <?php Pjax::end(); ?>
    </div>
    <!-- /.box-body -->
    <!--<div class="box-footer">
        Footer
    </div>-->
    <!-- /.box-footer-->
</div>
