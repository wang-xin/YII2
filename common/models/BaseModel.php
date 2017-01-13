<?php
/**
 * 公共数据模型.
 * User: King
 * Date: 2016/12/7
 * Time: 14:15
 */

namespace common\models;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

class BaseModel extends ActiveRecord
{
    public function behaviors()
    {
        return [
            'class' => TimestampBehavior::className(),
        ];
    }
}