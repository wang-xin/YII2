<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%news_article}}".
 *
 * @property integer $id
 * @property string $title
 * @property string $summary
 * @property integer $category_id
 * @property string $content
 * @property integer $hits
 * @property integer $created_at
 * @property integer $updated_at
 */
class NewsArticle extends BaseModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%news_article}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category_id', 'hits', 'created_at', 'updated_at'], 'integer'],
            [['content'], 'string'],
            [['title'], 'string', 'max' => 128],
            [['summary'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('backend', 'ID'),
            'title' => Yii::t('backend', 'Title'),
            'summary' => Yii::t('backend', 'Summary'),
            'category_id' => Yii::t('backend', 'Category ID'),
            'thumb_img' => Yii::t('backend', 'Thumb Img'),
            'content' => Yii::t('backend', 'Content'),
            'hits' => Yii::t('backend', 'Hits'),
            'created_at' => Yii::t('backend', 'Created At'),
            'updated_at' => Yii::t('backend', 'Updated At'),
        ];
    }
}
