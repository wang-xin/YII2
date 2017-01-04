<?php
return [
    'adminEmail'                    => 'admin@example.com',
    'supportEmail'                  => 'support@example.com',
    'user.passwordResetTokenExpire' => 3600,
    // 上传地址配置
    'uploadFileUrl'                 => 'http://yii2.dev/upload',  // 访问地址
    'uploadRootPath'                => Yii::getAlias('@frontend') . '/web/upload',    //文件上传目录
    'imagePathFormat'               => '/image/{yyyy}{mm}{dd}/{time}{rand:6}',  // 图片上传保存路径
    'filePathFormat'                => '/file/{yyyy}{mm}{dd}/{time}{rand:6}',  // 图片上传保存路径
];
