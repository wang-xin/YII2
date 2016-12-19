<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\modules\admin\components\Helper;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\admin\models\searchs\User */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('rbac-admin', 'Users');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box">

    <div class="box-header with-border">
        <h3 class="box-title">
            <?= Html::a(Yii::t('rbac-admin', 'Signup'), ['signup'], ['class' => 'btn btn-success']) ?>
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
            'layout'       => "{items}\n{summary}{pager}",
            'dataProvider' => $dataProvider,
            'filterModel'  => $searchModel,
            'columns'      => [
                ['class' => 'yii\grid\SerialColumn'],
                'username',
                'email:email',
                'created_at:date',
                [
                    'attribute' => 'status',
                    'value'     => function ($model) {
                        return $model->status == 0 ? Yii::t('rbac-admin', 'Inactive') : Yii::t('rbac-admin', 'Active');
                    },
                    'filter'    => [
                        0  => Yii::t('rbac-admin', 'Inactive'),
                        10 => Yii::t('rbac-admin', 'Active'),
                    ],
                ],
                [
                    'class'    => 'yii\grid\ActionColumn',
                    'template' => Helper::filterActionColumn(['view', 'activate', 'delete']),
                    'buttons'  => [
                        'activate' => function ($url, $model) {
                            if ($model->status == 10) {
                                return '';
                            }
                            $options = [
                                'title'        => Yii::t('rbac-admin', 'Activate'),
                                'aria-label'   => Yii::t('rbac-admin', 'Activate'),
                                'data-confirm' => Yii::t('rbac-admin', 'Are you sure you want to activate this user?'),
                                'data-method'  => 'post',
                                'data-pjax'    => '0',
                            ];

                            return Html::a('<span class="glyphicon glyphicon-ok"></span>', $url, $options);
                        },
                    ],
                ],
            ],
        ]);
        ?>
    </div>
</div>
