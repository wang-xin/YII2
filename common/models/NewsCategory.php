<?php

namespace common\models;

use Yii;
use yii\web\NotFoundHttpException;

/**
 * 新闻分类表数据模型.
 *
 * @property integer $id
 * @property string  $name
 * @property integer $parent_id
 * @property string  $remark
 * @property integer $sort
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 */
class NewsCategory extends BaseModel
{
    const STATUS_DISABLED = 0;  // 状态 禁用
    const STATUS_ENABLED = 1;   // 状态 可用

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
            [['parent_id'], 'default', 'value' => 0],
            [['remark'], 'string', 'max' => 255],
        ];
    }

    /**
     * getAllCategories
     * @auth King
     */
    public static function getAllCategories()
    {
        $data = self::find()->where(['status' => self::STATUS_ENABLED])->orderBy(['sort' => SORT_ASC])->asArray()->all();

        return $data;
    }

    /**
     * 通过分类ID获取该分类信息
     * @auth King
     * @param $id
     *
     * @return array|null|\yii\db\ActiveRecord
     * @throws NotFoundHttpException
     */
    public function getCategoryById($id)
    {
        if (($data = self::findOne($id)) !== null) {
            return $data;
        } else {
            throw new NotFoundHttpException(Yii::t('common', 'The requested page does not exist.'));
        }
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'         => Yii::t('backend', 'ID'),
            'name'       => Yii::t('backend', 'Category Name'),
            'parent_id'  => Yii::t('backend', 'Belong To Category'),
            'remark'     => Yii::t('backend', 'Remark'),
            'sort'       => Yii::t('backend', 'Sort'),
            'status'     => Yii::t('backend', 'Status'),
            'created_at' => Yii::t('backend', 'Created At'),
            'updated_at' => Yii::t('backend', 'Updated At'),
        ];
    }
}
