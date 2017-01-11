<?php
/**
 * 文章分类表单模型.
 * User: King
 * Date: 2017/1/10
 * Time: 18:20
 */

namespace backend\models;

use common\models\NewsCategory;
use Yii;

class NewsCategoryForm extends BaseFormModel
{
    public $id;
    public $name;
    public $parent_id;
    public $remark;
    public $sort;
    public $status;

    public function rules()
    {
        return [
            [['name'], 'required'],
            [['parent_id', 'sort', 'status'], 'integer'],
            [['name'], 'string', 'max' => 32],
            [['remark'], 'string', 'max' => 255],
        ];
    }

    public function scenarios()
    {
        $scenarios = [
            self::SCENARIO_CREATE => ['name', 'parent_id', 'sort', 'status', 'remark'],
            self::SCENARIO_UPDATE => ['name', 'parent_id', 'sort', 'status', 'remark'],
        ];

        return array_merge(parent::scenarios(), $scenarios);
    }

    /**
     * 创建分类
     * @auth King
     * @return bool
     */
    public function create()
    {
        try {
            $model = new NewsCategory();
            $model->setAttributes($this->attributes);
            $model->parent_id = $this->parent_id ? $this->parent_id : 0;
            if (!$model->save()) {
                throw new \Exception(Yii::t('backend', 'The category create failure!'));
            }
            $this->id = $model->id;

            return true;
        } catch (\Exception $exception) {
            $this->_lastError = $exception->getMessage();

            return false;
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
            'parent_id'  => Yii::t('backend', 'Parent ID'),
            'remark'     => Yii::t('backend', 'Remark'),
            'sort'       => Yii::t('backend', 'Sort'),
            'status'     => Yii::t('backend', 'Status'),
            'created_at' => Yii::t('backend', 'Created At'),
            'updated_at' => Yii::t('backend', 'Updated At'),
        ];
    }
}