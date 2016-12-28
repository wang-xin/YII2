<?php

namespace common\models;

use Yii;

/**
 * 新闻分类表数据模型.
 *
 * @property integer $id
 * @property string $name
 * @property integer $parent_id
 * @property string $remark
 * @property integer $sort
 * @property integer $status
 */
class NewsCategory extends BaseModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%news_category}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent_id', 'sort', 'status'], 'integer'],
            [['name'], 'string', 'max' => 32],
            [['remark'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common', 'ID'),
            'name' => Yii::t('common', 'Name'),
            'parent_id' => Yii::t('common', 'Parent ID'),
            'remark' => Yii::t('common', 'Remark'),
            'sort' => Yii::t('common', 'Sort'),
            'status' => Yii::t('common', 'Status'),
        ];
    }
}
