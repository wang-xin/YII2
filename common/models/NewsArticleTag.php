<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%news_article_tag}}".
 *
 * @property integer $id
 * @property integer $article_id
 * @property integer $tag_id
 */
class NewsArticleTag extends \common\models\BaseModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%news_article_tag}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['article_id', 'tag_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common', 'ID'),
            'article_id' => Yii::t('common', 'Article ID'),
            'tag_id' => Yii::t('common', 'Tag ID'),
        ];
    }
}
