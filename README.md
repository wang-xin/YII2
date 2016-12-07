##YII2 通用后台
开发说明：  
    1、所有控制器都继承 common\controllers\CoreController，每个应用下面应有一个BaseController控制器，做为该应用的父控制器，方便做一些公共操作；  
    2、所有数据模型都继承 common\models\BaseModel;  
    3、所有表单模型都继承 common\models\BaseForm;  
    4、所有 自定义助手函数都放在 common\helpers 且方法都未static方法；  
    5、公共别名在common/config/bootstarp.php中定义，使用Yii::getAlias()访问；  
    6、