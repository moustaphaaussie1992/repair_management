<?php

namespace app\models;

use mdm\admin\models\form\ChangePassword as BaseChangePassword;
use Yii;
use yii\helpers\ArrayHelper;

class ChangePassword extends BaseChangePassword {

    public function attributeLabels() {
        return ArrayHelper::merge(parent::attributeLabels(), [
                    'role' => Yii::t('user', 'Role'),
                    'password' => Yii::t('user', 'Password'),
                    'actions' => Yii::t('user', 'Actions'),
                    'oldPassword' => Yii::t('user', 'Old Password'),
                    'newPassword' => Yii::t('user', 'New Password'),
                    'retypePassword' => Yii::t('user', 'Retype Password'),
        ]);
    }

}
