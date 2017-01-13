<?php
/**
 * 公共表单模型.
 * User: King
 * Date: 2017/1/6
 * Time: 10:43
 */

namespace backend\models;


use yii\base\Model;
use yii\behaviors\TimestampBehavior;

class BaseFormModel extends Model
{
    /**
     * 定义场景
     *
     * SCENARIO_CREATE  创建
     * SCENARIO_UPDATE  更新
     */
    const SCENARIO_CREATE = 'create';
    const SCENARIO_UPDATE = 'update';

    /**
     * 定义事件
     *
     * EVENT_AFTER_CREATE   创建后的事件
     * EVENT_AFTER_UPDATE   更新后的事件
     * EVENT_AFTER_DELETE   删除后的事件
     */
    const EVENT_AFTER_CREATE = 'eventAfterCreate';
    const EVENT_AFTER_UPDATE = 'eventAfterUpdate';
    const EVENT_AFTER_DELETE = 'eventAfterDelete';

    public $_lastError;     // 错误信息

    public $isNewRecord = true;     // 是否是新记录


    /**
     * 时间行为类
     * @auth King
     * @return array
     */
    public function behaviors()
    {
        return [
            'class' => TimestampBehavior::className(),
        ];
    }
}