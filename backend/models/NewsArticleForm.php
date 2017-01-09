<?php
/**
 * 文章表单模型.
 * User: King
 * Date: 2017/1/4
 * Time: 11:59
 */

namespace backend\models;

use common\helpers\String;
use common\models\NewsArticleTag;
use Yii;
use common\models\NewsArticle;
use yii\db\Query;

class NewsArticleForm extends BaseFormModel
{
    public $id;             // ID
    public $title;          // 标题
    public $category_id;    // 分类ID
    public $summary;        // 摘要
    public $thumb_img;      // 缩略图
    public $content;        // 内容
    public $tag;            // 标签
    public $is_valid;       // 是否发布

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'category_id'], 'integer'],
            ['content', 'string'],
            ['title', 'string', 'max' => 128],
            ['is_valid', 'in', 'range' => [0, 1]],
            ['tag', 'safe'],
            ['summary', 'string', 'max' => 255],
            [['thumb_img'], 'image'],
        ];
    }

    /**
     * 场景设置
     * @auth King
     * @return array
     */
    public function scenarios()
    {
        $scenarios = [
            self::SCENARIO_CREATE => ['title', 'category_id', 'summary', 'thumb_img', 'content', 'is_valid', 'tag'],
            self::SCENARIO_UPDATE => ['title', 'category_id', 'summary', 'thumb_img', 'content', 'is_valid', 'tag'],
        ];

        return array_merge(parent::scenarios(), $scenarios);
    }

    /**
     * 创建文章
     * @auth King
     * @return bool
     */
    public function create()
    {
        // 开启事务
        $transaction = Yii::$app->db->beginTransaction();
        try {
            $model = new NewsArticle();
            $model->setAttributes($this->attributes);
            $model->author_id = Yii::$app->user->identity->getId();
            $model->summary = $this->_getSummary();
            $model->is_valid = NewsArticle::NO_VALID;
            $model->hits = 0;   // 浏览次数

            if (!$model->save()) {
                throw new \Exception(Yii::t('backend', 'The article create failure!'));
            }
            $this->id = $model->id;

            // 调用事件
            $data = array_merge($this->getAttributes(), $model->getAttributes());
            $this->_eventAfterCreate($data);

            $transaction->commit();     // 提交事务
            return true;
        } catch (\Exception $exception) {
            $transaction->rollBack();   // 回滚
            $this->_lastError = $exception->getMessage();
            echo $this->_lastError;
            return false;
        }
    }

    /**
     * 生成文章摘要
     * @auth King
     *
     * @param int $start
     * @param int $length
     *
     * @return null|string
     */
    private function _getSummary($start = 0, $length = 128)
    {
        if ($this->summary) {
            return $this->summary;
        }

        if (empty($this->content)) {
            return null;
        }

        return String::msubstr(str_replace('&nbsp;', '', strip_tags($this->content)), $start, $length);
    }

    /**
     * 创建文章后触发的事件
     * @auth King
     *
     * @param $data
     */
    private function _eventAfterCreate($data)
    {
        // 添加事件
        $this->on(self::EVENT_AFTER_CREATE, [$this, '_eventAddTag'], $data);
        // 触发事件
        $this->trigger(self::EVENT_AFTER_CREATE);
    }

    /**
     * 添加标签事件
     * @auth King
     *
     * @param $event
     *
     * @throws \Exception
     */
    protected function _eventAddTag($event)
    {
        // 保存标签
        $tagModel = new NewsTagForm();
        $tagModel->tags = $event->data['tag'];

        $tagIds = $tagModel->saveTags();

        // 删除之前关联关系
        NewsArticleTag::deleteAll(['article_id' => $event->data['id']]);

        // 批量保存文章与标签的关联关系
        if (!empty($tagIds)) {
            foreach ($tagIds as $k => $id) {
                $rows[$k] = [
                    'article_id' => $this->id,
                    'tag_id'     => $id,
                ];
            }
            // 批量插入
            $res = (new Query())->createCommand()->batchInsert(NewsArticleTag::tableName(), ['article_id', 'tag_id'], $rows)->execute();

            if (!$res) {
                throw new \Exception(Yii::t('backend', 'Articles and correlation of tag save failed!'));
            }
        }
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'          => Yii::t('backend', 'ID'),
            'title'       => Yii::t('backend', 'Title'),
            'summary'     => Yii::t('backend', 'Summary'),
            'category_id' => Yii::t('backend', 'Category ID'),
            'thumb_img'   => Yii::t('backend', 'Thumb Img'),
            'content'     => Yii::t('backend', 'Content'),
            'hits'        => Yii::t('backend', 'Hits'),
            'tag'         => Yii::t('backend', 'Tag'),
            'is_valid'    => Yii::t('backend', 'Is Valid'),
            'created_at'  => Yii::t('backend', 'Created At'),
            'updated_at'  => Yii::t('backend', 'Updated At'),
        ];
    }
}