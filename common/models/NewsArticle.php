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
}
