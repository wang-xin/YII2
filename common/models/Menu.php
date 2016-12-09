<?php

namespace common\models;

use common\helpers\Debug;
use common\helpers\Tree;
use Yii;

/**
 * 后台菜单数据模型
 *
 * This is the model class for table "{{%menu}}".
 *
 * @property integer $id
 * @property string $name
 * @property integer $parent
 * @property string $route
 * @property integer $order
 * @property resource $data
 *
 * @property Menu $parent0
 * @property Menu[] $menus
 */
class Menu extends BaseModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%menu}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['parent', 'order'], 'integer'],
            [['data'], 'string'],
            [['name'], 'string', 'max' => 128],
            [['route'], 'string', 'max' => 255],
            [['parent'], 'exist', 'skipOnError' => true, 'targetClass' => Menu::className(), 'targetAttribute' => ['parent' => 'id']],
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
            'parent' => Yii::t('common', 'Parent'),
            'route' => Yii::t('common', 'Route'),
            'order' => Yii::t('common', 'Order'),
            'data' => Yii::t('common', 'Data'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParent0()
    {
        return $this->hasOne(Menu::className(), ['id' => 'parent']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMenus()
    {
        return $this->hasMany(Menu::className(), ['parent' => 'id']);
    }


    public static function getLeftMenuList()
    {
        $uid = Yii::$app->user->identity->getId();
        $auth = Yii::$app->authManager;
        $permission = $auth->getPermissionsByUser($uid);

        $rolesList = '';
        foreach ($permission as $v) {
            $rolesList .= "'" . $v->name . "'";
        }
        $rolesList = substr($rolesList, 0, -1);


        // $list = self::find()->where(['in', 'route', $rolesList])->orderBy(['order' => 'ASC'])->asArray()->all();
        $list = self::find()->orderBy(['order' => 'ASC'])->asArray()->all();
        return Tree::list2tree($list, 'id', 'parent');

    }
}
