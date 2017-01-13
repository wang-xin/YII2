<?php

namespace backend\controllers;

use backend\models\NewsArticleForm;
use backend\models\NewsCategoryForm;
use common\helpers\Tree;
use common\models\NewsCategory;
use Yii;
use common\models\NewsArticle;
use backend\models\searchs\NewsArticle as NewsArticleSearch;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * NewsArticleController implements the CRUD actions for NewsArticle model.
 */
class NewsArticleController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class'   => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'ueditor' => [
                'class'  => 'common\widgets\ueditor\UeditorAction',
                'config' => [
                    //上传图片配置
                    'imageUrlPrefix'  => Yii::$app->params['uploadFileUrl'],   /* 图片访问路径前缀 */
                    'uploadFilePath'  => Yii::$app->params['uploadRootPath'],  /* 文件上传目录 */
                    'imagePathFormat' => Yii::$app->params['imagePathFormat'], /* 上传图片保存路径 */
                    'filePathFormat'  => Yii::$app->params['filePathFormat'],  /* 上传文件保存路径 */
                ],
            ],
            'upload'  => [
                'class'  => 'common\widgets\file_upload\UploadAction',
                'config' => [
                    'uploadFilePath'  => Yii::$app->params['uploadRootPath'],  /* 文件上传目录 */
                    'imagePathFormat' => Yii::$app->params['imagePathFormat'],
                ],
            ],
        ];
    }

    /**
     * Lists all NewsArticle models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new NewsArticleSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $data = NewsCategory::getAllCategories();
        $categoriesForLevel = Tree::unLimitedForLevel($data);
        $categories = [];
        foreach ($categoriesForLevel as $value) {
            $categories[$value['id']] = $value['html'] . $value['name'];
        }

        return $this->render('index', [
            'searchModel'  => $searchModel,
            'dataProvider' => $dataProvider,
            'categories'   => $categories,
        ]);
    }

    /**
     * Displays a single NewsArticle model.
     *
     * @param integer $id
     *
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new NewsArticle model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $categoryLists = NewsCategory::getAllCategories();
        $categoriesForLevel = Tree::unLimitedForLevel($categoryLists);
        foreach ($categoriesForLevel as $key => $value) {
            $categoriesForLevel[$key]['name'] = $value['html'] . $value['name'];
        }
        $categories = ArrayHelper::map($categoriesForLevel, 'id', 'name');

        $model = new NewsArticleForm();
        $model->scenarios(NewsArticleForm::SCENARIO_CREATE);

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if (!$model->create()) {
                Yii::$app->session->setFlash('Warning', $model->_lastError);
            } else {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('create', [
            'model'      => $model,
            'categories' => $categories,
        ]);
    }

    /**
     * Updates an existing NewsArticle model.
     * If update is successful, the browser will be redirected to the 'view' page.
     *
     * @param integer $id
     *
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->scenarios(NewsArticleForm::SCENARIO_UPDATE);
        $model->isNewRecord = false;    // 更新

        // 文章分类数据
        $categoryLists = NewsCategory::getAllCategories();
        $categoriesForLevel = Tree::unLimitedForLevel($categoryLists);
        foreach ($categoriesForLevel as $key => $value) {
            $categoriesForLevel[$key]['name'] = $value['html'] . $value['name'];
        }
        $categories = ArrayHelper::map($categoriesForLevel, 'id', 'name');

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if (!$model->update()) {
                Yii::$app->session->setFlash('Warning', $model->_lastError);
            } else {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('update', [
            'model'      => $model,
            'categories' => $categories,
        ]);
    }

    /**
     * Deletes an existing NewsArticle model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     *
     * @param integer $id
     *
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        if (!$model->delete()) {
            Yii::$app->session->setFlash('Warning', $model->_lastError);
        } else {
            return $this->redirect(['index']);
        }
    }

    /**
     * Finds the NewsArticle model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     *
     * @param integer $id
     *
     * @return NewsArticle the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        $model = new NewsArticleForm();

        $result = NewsArticle::find()->with(['relate.tag'])->where(['id' => $id])->asArray()->one();
        if (!$result) {
            throw new NotFoundHttpException(Yii::t('common', 'The requested page does not exist.'));
        }

        // 处理标签
        $result['tag'] = [];
        if (isset($result['relate']) && !empty($result['relate'])) {
            foreach ($result['relate'] as $list) {
                $result['tag'][] = $list['tag']['name'];
            }
            unset($result['relate']);
        }
        $model->setAttributes($result);

        return $model;
    }
}
