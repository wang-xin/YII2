<?php

namespace common\models;

use Yii;

/**
 * 文章标签数据模型
 * This is the model class for table "{{%news_tag}}".
 *
 * @property integer $id
 * @property string $name
 * @property integer $article_number
 * @property integer $created_at
 * @property integer $updated_at
 */
class NewsTag extends BaseModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%news_tag}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['article_number', 'created_at', 'updated_at'], 'integer'],
            [['name'], 'string', 'max' => 32],
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
            'number' => Yii::t('common', 'Number'),
        ];
    }
}
