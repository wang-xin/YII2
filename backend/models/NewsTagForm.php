<?php
/**
 * 标签表单模型.
 * User: King
 * Date: 2017/1/6
 * Time: 19:35
 */

namespace backend\models;


use common\models\NewsTag;

class NewsTagForm extends BaseFormModel
{
    public $id;
    public $tags;           // 标签名称

    public function rules()
    {
        return [
            [['tags'], 'required'],
            [['tags'], 'each', 'rule' => ['string']],
        ];
    }

    /**
     * 保存标签集合
     * @auth King
     */
    public function saveTags()
    {
        $ids = [];
        if (!empty($this->tags)) {
            foreach ($this->tags as $tag) {
                $ids[] = $this->_saveTag($tag);
            }
        }

        return $ids;
    }

    /**
     * 保存标签
     * @auth King
     *
     * @param $tag
     *
     * @return int
     * @throws \Exception
     */
    private function _saveTag($tag)
    {
        $model = new NewsTag();
        // 查询标签是否存在，不存在则新增，存在则关联文章数+1
        $res = $model->find()->where(['name' => $tag])->one();
        if (!$res) {
            $model->name = $tag;
            $model->article_number = 1;
            if (!$model->save()) {
                throw new \Exception(\Yii::t('backend', 'The tags create failure!'));
            }

            return $model->id;
        } else {
            $res->updateCounters(['article_number' => 1]);
        }

        return $res->id;
    }

    public function updateTags($tags)
    {
        if (!empty($tags)) {
            $model = new NewsTag();
            $model->updateAllCounters(['article_number' => -1], ['in' , 'name' , $tags]);
        }
    }
}