<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%news_article}}".
 *
 * @property integer $id
 * @property string  $title
 * @property string  $summary
 * @property integer $category_id
 * @property integer $thumb_img
 * @property string  $content
 * @property integer $hits
 * @property integer $author_id
 * @property integer $is_valid
 * @property integer $created_at
 * @property integer $updated_at
 */
class NewsArticle extends BaseModel
{
    const IS_VALID = 1; // 已发布
    const NO_VALID = 0; // 未发布

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%news_article}}';
    }

    public function getRelate()
    {
        return $this->hasMany(NewsArticleTag::className(), ['article_id' => 'id']);
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'category_id', 'hits', 'author_id', 'is_valid', 'created_at', 'updated_at'], 'integer'],
            [['title'], 'string', 'max' => 128],
            [['summary'], 'string', 'max' => 255],
            [['content'], 'string'],
            [['thumb_img'], 'image'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id'          => Yii::t('common', 'ID'),
            'title'       => Yii::t('common', 'Article Title'),
            'summary'     => Yii::t('common', 'Article Summary'),
            'category_id' => Yii::t('common', 'Article Category'),
            'thumb_img'   => Yii::t('common', 'Article Thumb Img'),
            'content'     => Yii::t('common', 'Article Content'),
            'hits'        => Yii::t('common', 'Hits'),
            'tag'         => Yii::t('common', 'Tag'),
            'is_valid'    => Yii::t('common', 'Is Valid'),
            'created_at'  => Yii::t('common', 'Created At'),
            'updated_at'  => Yii::t('common', 'Updated At'),
        ];
    }

}
