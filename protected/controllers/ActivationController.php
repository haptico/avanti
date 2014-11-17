<?php

class ActivationController extends Controller {

    public $defaultAction = 'activation';

    /**
     * Activation user account
     */
    public function actionActivation() {
        $email = $_GET['email'];
        $activkey = $_GET['activkey'];
        if ($email && $activkey) {
            $find = User::model()->notsafe()->findByAttributes(array('email' => $email));
            if (isset($find) && $find->status) {
                $this->render('/user/message', array('title' => Yii::t("user", "User activation"), 'content' => Yii::t("user", "You account is active.")));
            } elseif (isset($find->activkey) && ($find->activkey == $activkey)) {
                $find->activkey = User::model()->encrypting(microtime());
                $find->status = 1;
                $find->save();
                $this->render('/user/message', array('title' => Yii::t("user", "User activation"), 'content' => Yii::t("user", "You account is activated.")));
            } else {
                $this->render('/user/message', array('title' => Yii::t("user", "User activation"), 'content' => Yii::t("user", "Incorrect activation URL.")));
            }
        } else {
            $this->render('/user/message', array('title' => Yii::t("user", "User activation"), 'content' => Yii::t("user", "Incorrect activation URL.")));
        }
    }

}
